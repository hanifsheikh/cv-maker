<?php

namespace App\Models;


class User extends Model
{
    public function create($data = [])
    {

        $sql = "INSERT INTO users (" . implode(', ', array_map(function ($val) {
            return sprintf("`%s`", $val);
        }, array_keys($data))) . ") VALUES (" .  implode(', ', array_map(function ($val) {
            return sprintf("'%s'", $val);
        }, array_values($data))) . ")";

        return mysqli_query($this->connection, $sql);
    }
    public function exist($email)
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->connection, $sql);
        return  mysqli_num_rows($result);
    }
    public function authenticate($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->connection, $sql);
        $data =  mysqli_fetch_assoc($result);
        if (password_verify($password, $data['password'])) {
            return true;
        }
        return false;
    }

    public function get($email)
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->connection, $sql);
        $data = mysqli_fetch_assoc($result);
        return  [
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'photo' => $data['photo'],
            'address' => $data['address'],
        ];
    }
    public function update($data)
    {
        if (isset($data['photo'])) {
            $sql = "UPDATE users SET name='" . $data['name'] .
                "', email='" . $data['email'] .
                "', address='" . ($data['address'] ?: null) .
                "', photo='" . $data['photo'] .
                "' WHERE id=" . auth()['id'];
        } else {
            $sql = "UPDATE users SET name='" . $data['name'] .
                "', email='" . $data['email'] .
                "', address='" . ($data['address'] ?: null) .
                "' WHERE id=" . auth()['id'];
        }

        return mysqli_query($this->connection, $sql);
    }
    public function updatePassword($new_password)
    {
        $sql = "UPDATE users SET password='" . password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 12]) .
            "' WHERE id=" . auth()['id'];
        return mysqli_query($this->connection, $sql);
    }
}
