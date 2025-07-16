<?php

namespace App\Model;
require_once '../../env.php'; 

use Medoo\Medoo;
use \PDO;


class Connection
{
    private $conn;

    public function connect()
    {
        return $this->conn = new Medoo([
            'type'      => DATABASE_TYPE_DEV,
            'host'      => DATABASE_HOST_DEV,
            'database'  => DATABASE_DATABASE_DEV,
            'username'  => DATABASE_USERNAME_DEV,
            'password'  => DATABASE_PASSWORD_DEV,
            'error'     => PDO::ERRMODE_SILENT,
        ]);
    }
}
