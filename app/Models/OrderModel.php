<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'order_type', 'quantity', 'total', 'order_status', 'desired_date', 'desired_time', 'transaction_id', 'payment_status'];


    public function countItems() {
        return $this->countAll();
    }

    public function getAllItems(){
        return $this->findAll();
    }

    public function getTotalSales(){
        return $this->selectSum('total')
                ->where('payment_status', 'Confirmed')
                ->get()
                ->getRow()
                ->total;
    }
}
