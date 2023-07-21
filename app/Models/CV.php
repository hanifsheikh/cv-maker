<?php

namespace App\Models;

class CV extends Model
{
    public function create($data)
    {
        unset($data['with_percentage']);
        $data['user_id'] = auth()['id'];
        $data['photo'] = auth()['photo'];
        $data['url'] = $this->generateURL();
        $data['created_at'] = date("Y-m-d H:i:s");
        $sql = "INSERT INTO cvs (" . implode(', ', array_map(function ($val) {
            return sprintf("`%s`", $val);
        }, array_keys($data))) . ") VALUES (" .  implode(', ', array_map(function ($val) {
            return sprintf("'%s'", $val);
        }, array_values($data))) . ")";

        mysqli_query($this->connection, $sql);
        return mysqli_insert_id($this->connection);
    }
    public function update($data)
    {
        $id = $data['cv_id'];
        $url = $data['cv_url'];
        unset($data['with_percentage'], $data['cv_id'], $data['cv_url']);

        $data['user_id'] = auth()['id'];
        $data['photo'] = auth()['photo'];
        $data['updated_at'] = date("Y-m-d H:i:s");

        $update_string =  '';
        $i = 0;
        foreach ($data as $key => $value) {
            $i++;
            if (count($data) == $i) {
                $update_string .= '`' . $key . '`' . "='" . $value . "' ";
            } else {
                $update_string .= '`' . $key . '`' . "='" . $value . "', ";
            }
        }
        $sql = "UPDATE cvs SET " . $update_string . " WHERE url='" . $url . "' AND id=" . $id;
        mysqli_query($this->connection, $sql);
        return;
    }
    public function all()
    {
        $sql = "SELECT * FROM cvs WHERE user_id=" . auth()['id'];
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    private function generateURL($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function get($url)
    {
        $sql = "SELECT * FROM cvs WHERE url='" . $url . "' AND user_id=" . auth()['id'];
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_assoc($result);
    }
    public function delete($url)
    {
        $sql = "DELETE FROM cvs WHERE url='" . $url . "' AND user_id=" . auth()['id'];
        mysqli_query($this->connection, $sql);
        return;
    }
}
