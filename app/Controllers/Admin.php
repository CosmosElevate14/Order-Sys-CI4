<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\ProductsModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\CustomerInformationModel;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use App\Models\NotificationModel;
use App\Models\UserAccountModel;

class Admin extends Controller
{
    public function dashboard() {
        $session = session();
        $orderModel = new OrderModel();
        if (!$session->get('username')) {
            return redirect()->to('/admin'); // Adjust login route accordingly
        }

        $db = \Config\Database::connect();

        // Pending orders count
        $pendingOrders = 0;
        try {
            $query = $db->table('orders')->where('payment_status', 'Pending')->countAllResults();
            $pendingOrders = $query;
        } catch (DatabaseException $e) {
            // handle error if needed
        }

        // Total feedback count
        $totalFeedback = 0;
        try {
            $query = $db->table('feedback')->countAllResults();
            $totalFeedback = $query;
        } catch (DatabaseException $e) {
 
        }

        $data = [
            'pendingOrders' => $pendingOrders,
            'totalSales' => $orderModel->getTotalSales(),
            'totalFeedback' => $totalFeedback,
        ];

        return view('layout/header', $data) .
                view('layout/navbar') .
                view('layout/sidebar') .
                view('admin/dashboard') .
                view('layout/footer');
    }
    
    public function products(){
        $session = session();
        if (!$session->get('username')) {
            return redirect()->to('/admin'); 
        }

        helper('url');
        $productsModel = new ProductsModel();
        $categoryModel = new CategoryModel();


        if ($this->request->getMethod() === 'POST') {
            $category = $this->request->getPost('category');
            return redirect()->to('/admin/products' . ($category ? '?category=' . $category : ''));
        }
        $category = $this->request->getGet('category');

        $data = [
            'category' => $categoryModel->getAllCategory(),
            'products' => $productsModel->getAllProducts($category !== 'all' ? $category : false),
            'selectedCategory' => $category, 
        ];

        return view('layout/header', $data) .
                view('layout/navbar') .
                view('layout/sidebar') .
                view('admin/products') .
                view('layout/footer');
    }

    public function addProduct() {
        $session = session();
        helper(['form']);
        $productModel = new ProductsModel();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'ProductName' => 'required',
                'Price' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                $session->setFlashdata('error', 'Validation failed.');
                return redirect()->to('/admin/products')->withInput();
            }

            
            $data = [
                'ProductName' => $this->request->getPost('ProductName'),
                'Price' => $this->request->getPost('Price'),
                'CategoryID' => $this->request->getPost('categoryID')
            ];

            $file = $this->request->getFile('ImagePath');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $filename = $file->getClientName();
                $file->move('uploads/', $filename);
                $data['ImagePath'] = 'uploads/' . $filename;
            }

            $productModel->save($data);
            $session->setFlashdata('success', 'Product added successfully.');
        }

        return redirect()->to('/admin/products');
    }

    public function editProduct($id) {
        $session = session();
        helper(['form']);
        $productModel = new ProductsModel();
        $product = $productModel->find($id);

        if (!$product) {
            $session->setFlashdata('error', 'Product not found.');
            return redirect()->to('/admin/products');
        }

        $file = $this->request->getFile('ImagePath');

        $productName = $this->request->getPost('ProductName');
        $price = $this->request->getPost('Price');
        $category = $this->request->getPost('category');
        $data = [
            'ProductName' => $productName,
            'Price' => $price,
            'CategoryID' => $category,
     
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getClientName();
            $file->move('uploads/', $filename);
            $data['ImagePath'] = 'uploads/' . $filename;
        }

        if (!empty($data)) {
            $productModel->update($id, $data);
            $session->setFlashdata('success', 'Product updated successfully.');
        } else {
            $session->setFlashdata('error', 'No changes detected.');
        }

        return redirect()->to('/admin/products');
    }
    
    public function deleteProduct($id) {
        $session = session();
        $productModel = new ProductsModel();
        $productModel->delete($id);
        
        $session->setFlashdata('success', 'Product deleted successfully.');
        return redirect()->to('/admin/products');
    }

    public function addCategory(){
        $session = session();
        $model = new CategoryModel();
        $data = ['CategoryName' => $this->request->getPost('CategoryName')];
        $model->save($data);
        
        $session->setFlashdata('success', 'Category added successfully.');
        
        return redirect()->to('/admin/category');
    }
    
    public function editCategory($id){
        $session = session();
        $model = new CategoryModel();
        $data = ['CategoryName' => $this->request->getPost('CategoryName')];
        $model->update($id, $data);
        
        $session->setFlashdata('success', 'Category updated successfully.');
        return redirect()->to('/admin/category');
    }

    public function deleteCategory($id){
        $session = session();
        $model = new CategoryModel();
        $model->delete($id);


        $session->setFlashdata('success', 'Category deleted successfully.');
        return redirect()->to('/admin/category');
    }
    
    public function category(){
        $session = session();
        if (!$session->get('username')) {
            return redirect()->to('/admin'); 
        }
        $categoryModel = new CategoryModel();

        $data = [
            'category' => $categoryModel->getAllCategory(),
        ];
        return view('layout/header', $data) .
                view('layout/navbar') .
                view('layout/sidebar') .
                view('admin/category') .
                view('layout/footer');
    }

    public function orders($status) {
        $session = session();
        if (!$session->get('username')) {
            return redirect()->to('/admin'); 
        }
        $orderModel = new OrderModel();
        $customerModel = new CustomerInformationModel();
        $orderDetailsModel = new OrderDetailsModel();
        $productModel = new ProductsModel();
        
        $query = $orderModel
        ->where('payment_status', $status)
        ->where('order_status !=', 'Done');

        // ✅ If Confirmed and date is provided in GET
        if (strtolower($status) == 'confirmed' && $this->request->getGet('filterDate')) {
            $date = $this->request->getGet('filterDate');
            $query->where('desired_date', $date); 
        } elseif (strtolower($status) == 'pending' && $this->request->getGet('searchGcash')) {
            $search = $this->request->getGet('searchGcash');
            $query->like('transaction_id', $search);
        }

        $orders = $query->findAll();
        log_message('debug', 'Order Status ' . $status);
        foreach ($orders as &$order) {
            $order['customer'] = $customerModel->find($order['customer_id']);
            $details = $orderDetailsModel->where('order_id', $order['id'])->findAll();
            foreach ($details as &$detail) {
                $product = $productModel->find($detail['product_id']);
                $detail['product_name'] = $product['ProductName'] ?? '';
                $detail['product_image'] = $product['ImagePath'] ?? '';
            }
            $order['details'] = $details;
        }

        $data = [
            'orders' => $orders
        ];

        if ($status == 'Pending') {
            $data['status'] = 'Pending';
        } elseif ($status == 'Declined') {
            $data['status'] = 'Declined';
        } else {
            $data['status'] = 'Confirmed';
        };

        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('admin/orders')
            . view('layout/footer');
    }

    public function confirmOrder($orderId) {
        $orderModel = new OrderModel();
        $customerModel = new CustomerInformationModel();

        $order = $orderModel->find($orderId);
        $customer = $customerModel->find($order['customer_id']);

        $email = \Config\Services::email();
        $email->setFrom('coconuts1403@gmail.com', 'Apollo XIII');
        $email->setTo($customer['email']);
        $email->setSubject('Order Confirmed');
        $email->setMessage('Dear ' . esc($customer['first_name']) . ',<br>Your order #' . $orderId . ' has been <b>confirmed</b>.');

        if ($email->send()) {
            $orderModel->update($orderId, ['payment_status' => 'Confirmed']);
            session()->setFlashdata('success', 'Order confirmed and email sent.');
        } else {
            $debugInfo = $email->printDebugger(['headers', 'subject', 'body']);
            log_message('error', 'Email failed to send: ' . $debugInfo);
            session()->setFlashdata('error', 'Email failed to send.');
            return redirect()->to('/admin/orders/Pending');
        }

        return redirect()->to('/admin/orders/Confirmed');
    }

    public function declineOrder($orderId){
        $orderModel = new OrderModel();
        $customerModel = new CustomerInformationModel();

        $order = $orderModel->find($orderId);
        $customer = $customerModel->find($order['customer_id']);

        $email = \Config\Services::email();
        $email->setFrom('coconuts1403@gmail.com', 'Apollo XIII');
        $email->setTo($customer['email']);
        $email->setSubject('Order Declined');
        $email->setMessage('Dear ' . esc($customer['first_name']) . ',<br>Your order #' . $orderId . ' has been <b>declined</b>.');

        if ($email->send()) {
            $orderModel->update($orderId, ['payment_status' => 'Declined']);
            session()->setFlashdata('success', 'Order declined and email sent.');
        } else {
            $debugInfo = $email->printDebugger(['headers', 'subject', 'body']);
            log_message('error', 'Email failed to send: ' . $debugInfo);
            session()->setFlashdata('error', 'Email failed to send.');
        }

        return redirect()->to('/admin/orders/Declined');
    }

    public function orderReady($orderId) {
        $session = session();
        $orderModel = new OrderModel();
        $db = \Config\Database::connect();
        $email = \Config\Services::email();

        $order = $db->table('orders o')
            ->select('o.id, o.order_type, o.customer_id, o.order_status, c.email, c.first_name')
            ->join('customer_information c', 'c.id = o.customer_id')
            ->where('o.id', $orderId)
            ->get()
            ->getRowArray();

        if (!$order) {
            $session->setFlashdata('error', 'Order not found.');
            return redirect()->to('/admin/orders/pending');
        }

        $subject = '';
        $message = '';
        $orderModel->update($orderId, ['order_status' => 'Ready']);
        if ($order['order_type'] === 'pickup') {
            $subject = 'Your Order is Ready for Pickup';
            $message = "Hi {$order['first_name']},<br><br>Your order (Order ID: {$order['id']}) is now ready for pickup. Please proceed to the pickup area at your convenience.";
        } elseif ($order['order_type'] === 'delivery') {
            $subject = 'Rider is on the Way';
            $message = "Hi {$order['first_name']},<br><br>Your order (Order ID: {$order['id']}) is out for delivery. Our rider is on the way!";
        }

        $email->setTo($order['email']);
        $email->setFrom('coconuts1403@gmail.com', 'Apollo XIII');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            $session->setFlashdata('success', 'Customer has been notified.');
        } else {
            $session->setFlashdata('error', 'Failed to send email to customer.');
        }

        return redirect()->to('/admin/orders/confirmed');
    }

    public function payOrder($orderID){
        $session = session();
        $orderModel = new OrderModel();

        $order = $orderModel->find($orderID);
        if (!$order) {
            $session->setFlashdata('error', 'Order not found.');
            return redirect()->back();
        }
        
        $orderModel->update($orderID, ['payment_status' => 'Paid']);
        
        $session->setFlashdata('success', 'Payment marked as Complete.');
        return redirect()->back();
    }

    public function unpaidOrder($orderID) {
        $session = session();
        $orderModel = new OrderModel();

        $order = $orderModel->find($orderID);
        if (!$order) {
            $session->setFlashdata('error', 'Order not found.');
            return redirect()->back();
        }
        
        $orderModel->update($orderID, ['payment_status' => 'Not Paid']);
        
        $session->setFlashdata('success', 'Payment marked as Not Paid.');
        return redirect()->back();
    }

    public function completeOrder($orderID) {
        $session = session();
        $orderModel = new OrderModel();

        $order = $orderModel->find($orderID);
        if (!$order) {
            $session->setFlashdata('error', 'Order not found.');
            return redirect()->back();
        }
        
        $orderModel->update($orderID, ['order_status' => 'Done']);
        
        $session->setFlashdata('success', 'Order marked as Done.');
        return redirect()->back();
    }

    public function customers(){
        $session = session();
        $customers = new UserAccountModel();


        $data = [
            'customers' => $customers->getCustomersData(),
        ];

        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('admin/customers')
            . view('layout/footer');
    }

    public function sales(){
        helper('url');
        $session = session();
        $orderModel = new OrderModel();
        $customerModel = new CustomerInformationModel();
        $orderDetailsModel = new OrderDetailsModel();
        $productModel = new ProductsModel();

        if ($this->request->getMethod() === 'POST') {
            $date = $this->request->getPost('date');

            return redirect()->to('admin/sales' . ($date ? '?date=' . $date : ''));
        }

        $date = $this->request->getGet('date');

        if (!empty($date)) {
            $orders = $orderModel
                ->where('payment_status', 'Confirmed')
                ->where('DATE(created_at)', $date) // MySQL DATE() function
                ->findAll();
        } else {
            $orders = $orderModel
                ->where('payment_status', 'Confirmed')
                ->findAll();
        }

        foreach ($orders as &$order) {
            $order['customer'] = $customerModel->find($order['customer_id']);
            $details = $orderDetailsModel->where('order_id', $order['id'])->findAll();
            foreach ($details as &$detail) {
                $product = $productModel->find($detail['product_id']);
                $detail['product_name'] = $product['ProductName'] ?? '';
                $detail['product_image'] = $product['ImagePath'] ?? '';
            }
            $order['details'] = $details;
        }

        $data = [
            'orders' => $orders,
            'date' => $date
        ];

        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('admin/sales')
            . view('layout/footer');
    }
}
