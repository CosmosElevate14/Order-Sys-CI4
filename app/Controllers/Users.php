<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\CustomerInformationModel;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use App\Models\NotificationModel;
use App\Models\UserAccountModel;

class Users extends BaseController
{
    public function index(){
        return view('users/index');
    }

    public function profile() {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Please login first.');
            return redirect()->to('/home');
        }
        $user_id = $session->get('user_id');
        $userModel = new UserAccountModel();
        $cartModel = new CartModel();
        $notificationModel = new NotificationModel();

        if ($this->request->getMethod() === 'POST'){
            $data = [
            'first_name' => $this->request->getPost('firstname'),
            'last_name'  => $this->request->getPost('lastname'),
            'email'     => $this->request->getPost('email'),
            'contact_number'   => $this->request->getPost('contact'),
            'address'   => $this->request->getPost('address'),
        ];
            $password = $this->request->getPost('password');

            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $userModel->update($user_id, $data);

            session()->setFlashdata('success', 'Profile updated successfully.');
            return redirect()->to('/profile');
        }

        $user = $userModel->find($user_id);

        
        $data = [
            'user' => $user,
            'countItems' => $cartModel->countItems($user_id),
            'notificationCount' => $notificationModel->countUnreadNotification($user_id),
        ];

        return view('layout/users/header', $data)
            . view('layout/users/nav')
            . view('users/profile') . 
            view('layout/users/footer');
    }

    public function home() {
        helper('url');
        $session = session();
        $user_id = $session->get('user_id');
        $productsModel = new ProductsModel();
        $categoryModel = new CategoryModel();
        $cartModel = new CartModel();
        $notificationModel = new NotificationModel();


        if ($this->request->getMethod() === 'POST') {
            $category = $this->request->getPost('category');
            return redirect()->to('/home' . ($category ? '?category=' . $category : ''));
        }

        $category = $this->request->getGet('category');

        $data = [
            'category' => $categoryModel->getAllCategory(),
            'countItems' => $cartModel->countItems($user_id),
            'products' => $productsModel->getAllProducts($category !== 'all' ? $category : false),
            'notificationCount' => $notificationModel->countUnreadNotification($user_id),
            'selectedCategory' => $category,
        ];

        return view('layout/users/header', $data)
            . view('layout/users/nav')
            . view('users/home') . 
            view('layout/users/footer');
    }

    public function cart() {
        $session = session();
        
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Please login first.');
            return redirect()->to('/home');
        }

        $user_id = $session->get('user_id'); 
        $cartModel = new CartModel();
        $notificationModel = new NotificationModel();
        $grandTotal = 0;
        $cartItems = $cartModel->getAllItems($user_id);

        foreach ($cartItems as $item) {
            $grandTotal += $item['total'];
        }

        $data = [
            'countItems' => $cartModel->countItems($user_id),
            'cartItems' => $cartItems,
            'grandTotal' => $grandTotal,
            'notificationCount' => $notificationModel->countUnreadNotification($user_id),
        ];


        return view('layout/users/header', $data) .
            view('layout/users/nav') .
            view('users/cart') . 
            view('layout/users/footer');
    }

    public function addToCart(){
        $session = session();
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Please login first.');
            return redirect()->to('/home');
        }
        helper(['form']);
        $user_id = $session->get('user_id');

        // Get POST data
        $productID = $this->request->getPost('product_id');
        $productName = $this->request->getPost('product_name');
        $quantity = (float) $this->request->getPost('quantity');
        $price = (float) $this->request->getPost('product_price');
        $total = number_format($quantity * $price, 2, '.', '');

        if (!$productID) {
            $session->setFlashdata('error', 'Product ID is missing.');
            return redirect()->to('/home');
        }

        if (!$quantity) {
            $session->setFlashdata('error', 'Quantity is required.');
            return redirect()->to('/home');
        }

        if (!$productName) {
            $session->setFlashdata('error', 'Product name is missing.');
            return redirect()->to('/home');
        }

        if (!$price) {
            $session->setFlashdata('error', 'Price is missing.');
            return redirect()->to('/home');
        }

        $cartModel = new CartModel();

        $data = [
            'product_id' => $productID,
            'item_name' => $productName,
            'quantity'   => $quantity,
            'total' => $total,
            'user_id' => $user_id
            
        ];

        $cartModel->insert($data);
        $session->setFlashdata('success', 'Product added to cart successfully.');

        return redirect()->to('/home');
    
    }

    public function updateQuantity(){
        $session = session();
        $cartModel = new \App\Models\CartModel();

        $itemId = $this->request->getPost('item_id');
        $newQty = (int) $this->request->getPost('quantity');

        if (!$itemId || $newQty < 1) {
            $session->setFlashdata('error', 'Invalid quantity or item.');
            return redirect()->to('/cart');
        }

        $item = $cartModel->find($itemId);
        if (!$item) {
            $session->setFlashdata('error', 'Item not found.');
            return redirect()->to('/cart');
        }

        $newTotal = number_format($item['total'] / $item['quantity'] * $newQty, 2, '.', '');

        $cartModel->update($itemId, [
            'quantity' => $newQty,
            'total'    => $newTotal
        ]);

        $session->setFlashdata('success', 'Quantity updated successfully.');
        return redirect()->to('/cart');
    }

    public function removeItem($id = null){
        $session = session();
        $cartModel = new \App\Models\CartModel();

        if (!$id || !$cartModel->find($id)) {
            $session->setFlashdata('error', 'Item not found.');
            return redirect()->to('/cart');
        }

        $cartModel->delete($id);

        $session->setFlashdata('success', 'Item removed from cart.');
        return redirect()->to('/cart');
    }

    public function checkout() {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            $session = session();
            if (!$session->get('isLoggedIn')) {
                $session->setFlashdata('error', 'Please login first.');
                return redirect()->to('/home');
            }
            $user_id = $session->get('user_id');
            $firstName = $session->get('first_name');
            $lastName = $session->get('last_name');
            $email = $session->get('email');
            
            
            
            $cartModel = new CartModel();
            $orderModel = new OrderModel();
            $orderDetailsModel = new OrderDetailsModel();
            $customerInformationModel = new CustomerInformationModel();
            $notificationModel = new NotificationModel();
            
            $cartItems  = $cartModel->getAllItems($user_id);
            
            // $firstName = $request->getPost('first_name');
            // $lastName = $request->getPost('last_name');
            // $email = $request->getPost('email');
            // $address = $orderType === 'delivery' ? $request->getPost('address') : null;
            $orderType = $request->getPost('order_type');
            $address = $orderType === 'delivery' ? $request->getPost('address') : null;
            $desiredDate = $request->getPost('desired_date');
            $desiredTime = $request->getPost('desired_time');
            $transactionId = $request->getPost('transaction_id');


            if ($orderType === 'delivery' && empty($address)) {
                $session->setFlashdata('error', 'Please provide delivery address.');
                return redirect()->to('/cart');
            }

            if (empty($desiredDate) || empty($desiredTime)) {
                $session->setFlashdata('error', 'Please select a valid date and time.');
                return redirect()->to('/cart');
            }
            
            $validTimes = [
                '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
                '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM'
            ];

            if (!in_array($desiredTime, $validTimes)) {
                $session->setFlashdata('error', 'Invalid time selected. Please choose a time between 9:00 AM and 5:00 PM.');
                return redirect()->to('/cart');
            }
            
            if (empty($transactionId)) {
                $session->setFlashdata('error', 'Please enter your GCash Transaction ID.');
                return redirect()->to('/cart');
            }

            if (empty($cartItems)) {
                $session->setFlashdata('error', 'You have empty cart.');
                return redirect()->to('/home');
            }

            $total = 0;
            $totalQuantity = 0;
            foreach ($cartItems as $item) {
                $total += $item['total'];
                $totalQuantity += $item['quantity'];
            }
            $db->transBegin();

            try{
                $customerInformationModel->insert([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'address' => $orderType === 'delivery' ? $address : null
                ]);

                $customerID = $customerInformationModel->getInsertID();


                $orderModel->insert([
                    'customer_id' => $customerID,
                    'order_type' => $orderType,
                    'created_at' => date('Y-m-d H:i:s'),
                    'quantity' => $totalQuantity,
                    'total' => $total,
                    'desired_date' => $desiredDate,
                    'desired_time' => $desiredTime,
                    'transaction_id' => $transactionId
                ]);
                $orderID = $orderModel->getInsertID();

                foreach ($cartItems as $item) {
                    $orderDetailsModel->insert([
                        'order_id' => $orderID,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['total'] / $item['quantity'],
                        'subtotal' => $item['total']
                    ]);
                }

                $notificationModel->insert([
                    'type' => 'Placed Order',
                    'message' => "New order placed by {$firstName} {$lastName}.",
                    'reference_id' => $user_id,
                    'reference_table' => 'users'
                ]);

                $cartModel->where('user_id', $user_id)->delete();

                $db->transCommit();

                $session->setFlashdata('success', 'Order placed successfully! An email will be sent to your email.');
                return redirect()->to('/home');

            }  catch (\Exception $e) {
                $db->transRollback();
                $session->setFlashdata('error', 'An error occur ' . $e->getMessage());
                return redirect()->to('/cart');
            }
    }

    public function notification() {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Please login first.');
            return redirect()->to('/home');
        }
        $cartModel = new CartModel();
        $notificationModel = new NotificationModel();
        $user_id = $session->get('user_id');

        $notificationModel->readAllNotifications($user_id);
        $data = [
            'countItems' => $cartModel->countItems($user_id),
            'cartItems' => $cartModel->getAllItems($user_id),
            'notificationCount' => $notificationModel->countUnreadNotification($user_id),
            'notifications' => $notificationModel->getAllNotification($user_id)
        ];

        return view('layout/users/header', $data) .
            view('layout/users/nav') .
            view('users/notification') . 
            view('layout/users/footer');
    }
}
