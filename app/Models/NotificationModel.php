<?php namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'message', 'reference_id', 'reference_table', 'is_read'];


    public function getAllNotification($id = False){
        if ($id === False) {
            return $this->findAll();
        }
        return $this->where(['reference_id' => $id])->findAll();
    }

    public function countUnreadNotification($userId) {
        return $this->where('is_read', 0)
                ->where('reference_id', $userId)
                ->countAllResults();
    }

    public function readAllNotifications($userId) {
        return $this->where('reference_id', $userId)
                ->set(['is_read' => 1])
                ->update();
    }
}
