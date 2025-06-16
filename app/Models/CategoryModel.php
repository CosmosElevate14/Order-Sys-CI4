<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'CategoryID';
    protected $allowedFields = ['CategoryID', 'CategoryName'];


    public function getAllCategory($categoryID = False){
        if ($categoryID === False) {
            return $this->findAll();
        }
        return $this->where(['CategoryID' => $categoryID])->findAll();
    }
}
