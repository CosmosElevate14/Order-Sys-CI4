<?php namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'item_name', 'quantity', 'total', 'date_added', 'user_id'];


    public function countItems($userId) {
        return $this->where('user_id', $userId)->countAllResults();
    }

    public function getAllItems($userId){
        return $this->where('user_id', $userId)->findAll();
    }

}
