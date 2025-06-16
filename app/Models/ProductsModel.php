<?php namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'productID';
    protected $allowedFields = ['CategoryID', 'ProductName', 'Price', 'ImagePath'];


    public function getAllProducts($categoryID = False){
        $builder = $this->select('product.*, category.CategoryName')
                    ->join('category', 'category.CategoryID = product.categoryID');

        if ($categoryID) {
            $builder->where('product.categoryID', $categoryID);
        }

        return $builder->findAll();
    }
}
