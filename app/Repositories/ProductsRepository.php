<?php

namespace App\Repositories;

use PDO;

class ProductsRepository
{
    private $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        $this->pdo = new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
            $config['user'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM products ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
