<?php

namespace App\Models;

class Model
{
    protected $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if (!$this->connection) {
            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
    }
}
