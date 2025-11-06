<?php

namespace App\Core;

use PDO;
use PDOException;
use Exception;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/database.php';

            try {
                self::$connection = new PDO(
                    "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
                    $config['user'],
                    $config['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                // Lança uma exceção mais genérica para ser tratada externamente
                throw new Exception('Erro ao conectar ao banco de dados: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
