<?php 

namespace App\Database;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class Database
{
    public static function getConnection(): Connection
    {
        return DriverManager::getConnection([
            'dbname'   => 'mini_erp',
            'user'     => 'root',
            'password' => 'mini_erp_teste',
            'host'     => '127.0.0.1',
            'driver'   => 'pdo_mysql',
        ]);
    }
}
