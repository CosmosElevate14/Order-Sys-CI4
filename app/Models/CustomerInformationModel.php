<?php namespace App\Models;

use CodeIgniter\Model;

class CustomerInformationModel extends Model
{
    protected $table = 'customer_information';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'address', 'email'];
    
    public function getCustomerOrdersWithProducts($customerId, $status)
    {
        $db = \Config\Database::connect();
        return $db->table('orders o')
            ->select('o.*, od.quantity, od.price, od.subtotal, p.ProductName as product_name, p.ImagePath as product_image')
            ->join('order_details od', 'od.order_id = o.id')
            ->join('products p', 'p.ProductID = od.product_id')
            ->where('o.customer_id', $customerId)
            ->where('o.order_status', $status)
            ->get()
            ->getResultArray();
    }

    public function getCustomerInformation(){
        return $this->findAll();
    }

}
