<?php

namespace App\Controllers;

use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

class UserController
{

    private $user;
    public function __construct()
    {
        if (session_has('isLoggedIn') !== true) {
            return redirect('/auth/login');
        }
        $this->user = new User;
    }
    public function profile()
    {
        $page_title = 'My Profile';
        return view('user.profile', compact('page_title'));
    }
    public function update()
    {
        $photo_dir = storage_dir('/users/' . session_get('userData')['id'] . '/photo');
        if (!file_exists($photo_dir)) {
            mkdir($photo_dir, 755, true);
        }
        $file_name = $this->getFileName();
        $file = $photo_dir . '/' . $file_name;

        if ($_FILES["photo"]["tmp_name"]) {
            $image_height = 230 * 5;
            $image_width = 200 * 5;
            Image::configure(['driver' => 'imagick']);
            $img = Image::make($_FILES["photo"]["tmp_name"])->orientate()->fit($image_width,  $image_width, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop($image_width, $image_height);
            $img->save($file, 100, 'webp');
            $this->user->update([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'photo' => $file_name,
            ]);
            session_set('userData', $this->user->get($_POST['email']));
        } else {
            if (($_POST['name']) && $_POST['email']) {
                $this->user->update([
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'address' => $_POST['address'],
                ]);
                session_set('userData', $this->user->get($_POST['email']));
            }
        }

        return redirect('/user/profile');
    }
    public function update_password()
    {
        if (strlen($_POST['new_password']) < 8 || strlen($_POST['current_password']) < 8) {
            return dd('Password should be at least 8 characters.');
        }
        if ($_POST['new_password'] != $_POST['password_confirmation']) {
            return dd('Password confirmation mismatch.');
        }
        if (post_request()) {
            $user_exist = $this->user->exist(auth()['email']);
            if ($user_exist) {
                if ($this->user->authenticate(auth()['email'], $_POST['current_password'])) {
                    $this->user->updatePassword($_POST['new_password']);
                } else {
                    return dd('unauthorized! current password is wrong.');
                }
            } else {
                return dd('user invalid!');
            }

            return redirect('/user/profile');
        }
        return dd('Only POST method is allwed!');
    }
    private function getFileName()
    {
        $string =  strtolower(str_replace(' ', '-', auth()['name']));
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string) . '-' . auth()['id'] . '-' . time() . '.webp'; // Removes special chars.
    }
}
