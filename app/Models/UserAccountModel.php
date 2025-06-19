<?php namespace App\Models;

use CodeIgniter\Model;

class UserAccountModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'contact_number', 'address', 'email', 'password'];

    public function getCustomersData(){
        return $this->findAll();
    }

    public function getCustomerAddress($userId)
    {
        return $this->where('id', $userId)->first();
    }
}
