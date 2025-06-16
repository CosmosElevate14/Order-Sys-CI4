<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        // Start session and check login
        $session = session();

        // if (!$session->get('username')) {
        //     return redirect()->to('/login');  // Adjust login route if needed
        // }

        // Connect to DB using CodeIgniter 4 database
        $db = \Config\Database::connect();

        // Query pending orders count
        $pendingOrders = $db->table('orders')->where('status', 'Pending')->countAllResults();

        // Query total sales count
        $totalSales = $db->table('PurchaseBill')->countAllResults();

        // Query total feedback count
        $totalFeedback = $db->table('feedback')->countAllResults();

        // Data array for view
        $data = [
            'pendingOrders' => $pendingOrders,
            'totalSales' => $totalSales,
            'totalFeedback' => $totalFeedback
        ];

        return view('layout/header', $data) .
                view('layout/navbar') .
                view('layout/sidebar') .
                view('dashboard') .
                view('layout/footer');
        // return view('dashboard.php', $data);
    }
}
