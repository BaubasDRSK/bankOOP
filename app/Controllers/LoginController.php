<?php
namespace Bank\Controllers;

use Bank\App;
use Bank\FileWriter;
use Bank\OldData;
use Bank\Messages;

class LoginController
{

    public function index()
    {
        $old = OldData::getFlashData();
        
        return App::view('login/index', [
            'pageTitle' => 'Login',
            // 'inLogin' => true,
            'old' => $old
        ]);
    }

    public function login(array $data)
    { 
        $fname = $data['fname'] ?? '';
        $password = $data['password'] ?? '';

        $users = (new FileWriter('users'))->showAll();
     
        foreach ($users as $user) {
            if ($user['fname'] == $fname && $user['psw'] == md5($password)) {
                $_SESSION['user_name'] = $fname;
                $_SESSION['user_email'] = $user['email'];
                header('Location: /accounts');
                die;
            }
        }
        OldData::flashData($data);
        Messages::addMessage('danger', 'Wrong email or password');
        header('Location: /login');
        die;
    }

    public function logout()
    {
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('Location: /');
        exit;
    }
}