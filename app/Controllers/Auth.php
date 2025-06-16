<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserAccountModel;


class Auth extends Controller
{
    public function index()
    {
        return view('admin/login');
    }

    public function authenticate(){
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('AdminUsername', $username)->first();

        if ($admin) {
            if ($password === $admin['AdminPassword']) {
                $session->set([
                    'username' => $username,
                    'accountID' => $admin['AccountID'],
                    'isLoggedIn' => true,
                ]);
                return redirect()->to('/admin/dashboard');
            } else {
                $session->setFlashdata('error', 'Incorrect password.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Username not found.');
            return redirect()->back()->withInput();
        }
    }

    public function userLogin(){
        $session = session();
        if ($this->request->getMethod() === 'POST') {
            $userModel = new UserAccountModel();
            $session = session();

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'email'   => $user['email'],
                    'first_name'    => $user['first_name'],
                    'last_name'    => $user['last_name'] ,
                    'contact_number' => $user['contact_number'] ,
                    'address' => $user['address'] ,
                    'isLoggedIn' => true,
                ]);

                $session->setFlashdata('success', 'Loging successfully');
                return redirect()->to('/home');
            }
            $session->setFlashdata('error', 'Invalid email or password');
            return redirect()->back();
        }


        return view('layout/users/header')
            . view('users/login') 
            . view('layout/users/footer');
    }

    public function userRegister(){
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();
            $session = session();

            $rules = [
                'firstname' => 'required',
                'lastname'  => 'required',
                'address'   => 'required',
                'contact'   => 'required',
                'email'     => 'required',
                'password'  => 'required|min_length[6]',
            ];

            if (!$this->validate($rules)) {
                $session->setFlashdata('error', $validation->getErrors());
                return redirect()->back();
            }

            $userModel = new UserAccountModel();
            $userModel->save([
                'first_name' => $this->request->getPost('firstname'),
                'last_name'  => $this->request->getPost('lastname'),
                'address'   => $this->request->getPost('address'),
                'contact_number'   => $this->request->getPost('contact'),
                'email'     => $this->request->getPost('email'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);

            $session->setFlashdata('success', 'Register Successfully!');
            return redirect()->to('/login');
        }
        
        return view('layout/users/header')
            . view('users/register') 
            . view('layout/users/footer');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        $session->setFlashdata('success', 'Logout Successfully');
        return redirect()->to('/admin');
    }
    
    public function userLogout(){
        $session = session();
        $session->destroy();
        $session->setFlashdata('success', 'Logout Successfully');
        return redirect()->to('/home');
    }
}