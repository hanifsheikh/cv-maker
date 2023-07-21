<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    private $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function login()
    {
        if (session_has('isLoggedIn') === true) {
            return redirect('/cv/list');
        }
        if (post_request()) {
            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                return dd('Email and password is required.');
            }
            $user_exist = $this->user->exist($_POST['email']);
            if ($user_exist) {
                if ($this->user->authenticate($_POST['email'], $_POST['password'])) {
                    $user_data = $this->user->get($_POST['email']);
                    $this->setLoggedIn($user_data);
                    return redirect('/cv/list');
                }
            }
            return dd('Invalid Credentials.');
        }
        return view('auth.login', null, 0);
    }
    public function register()
    {
        if (session_has('isLoggedIn') === true) {
            return redirect('/');
        }
        if (post_request()) {
            if (!isset($_POST['name'])) {
                return dd('Name is requied.');
            }
            if (!isset($_POST['email'])) {
                return dd('Email is required.');
            }
            if (strlen($_POST['password']) < 8) {
                return dd('Password should be at least 8 characters.');
            }
            if ($_POST['password'] != $_POST['password_confirmation']) {
                return dd('Password confirmation mismatch.');
            }

            $this->user->create([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12])
            ]);

            return $this->login();
        }
        return view('auth.register', null, 0);
    }
    private function setLoggedIn($user_data)
    {
        session_set('userData', $user_data);
        session_set('isLoggedIn', true);
        return;
    }
    public function logout()
    {
        if (post_request()) {
            session_del('isLoggedIn');
            session_del('userData');
            return redirect('/');
        }
        return dd('Only POST method is allwed!');
    }
}
