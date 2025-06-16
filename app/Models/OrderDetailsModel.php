<?php namespace App\Models;

use CodeIgniter\Model;

class OrderDetailsModel extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price', 'subtotal'];


    public function countItems() {
        return $this->countAll();
    }

    public function getAllItems(){
        return $this->findAll();
    }
}
