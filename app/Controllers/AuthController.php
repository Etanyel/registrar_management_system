<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
        return view('landing/index');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $validation = Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required|max_length[50]|min_length[2]',
                'errors' => [
                    'min_length' => 'Username must have at least 2 characters.',
                    'required' => 'Username is required.'
                ]
            ],
            'password' => [
                'rules' => 'required|max_length[50]|min_length[6]',
                'errors' => [
                    'min_length' => 'Password must have at least 6 characters.',
                    'required' => 'Password is required'
                ]
            ]
        ]);

        if(!$validation->run(['username' => $username, 'password' => $password]))
        {
            return $this->response->setJSON([
                'status' => 401,
                'errors' => $validation->getErrors() 
            ]);
        }

        $model = new UserModel();

        $user = $model->where('username', $username)->first();

        if(!$user)
        {
            return $this->response->setJSON([
                'status' => 401,
                'errors' => [
                    'username' => 'Invalid Username or Password.',
                    'password' => 'Invalid Username or Password.'
                ]
            ]);
        }

        if(!password_verify($password, $user['password']))
        {
            return $this->response->setJSON([
                'status' => 401,
                'errors' => [
                    'username' => 'Invalid Username or Password.',
                    'password' => 'Invalid Username or Password.',
                ]
            ]);
        }

        if($user['is_blocked'] == 1)
        {
            return $this->response->setJSON([
                'status' => 401,
                'message' => 'Your Account is Blocked or Suspended.',
            ]);
        }

        $is_active = ['is_active' => 1];
 
        $model->where('id', $user['id'])->set($is_active)->update();

        service('activitylogs')->save([
            'user_id' => $user['id'],
            'user_agent' => service('request')->getUserAgent()->getAgentString(),
            'ip_address' => service('request')->getIPAddress(),
            'action' => 'Logged In'
        ]);
        
        session()->set([
            'username'=> $user['username'],
            'userRole' => $user['role'],
            'userId'=> $user['id'],
            'isLoggedIn' => true
        ]);

        
        return $this->response->setJSON([
            'status' => 200,
            'role' => $user['role']
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
