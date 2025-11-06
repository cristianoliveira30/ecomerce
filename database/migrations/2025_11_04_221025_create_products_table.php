<?php

return new class {
    public function up(PDO $pdo)
    {
        $pdo->exec("
            CREATE TABLE products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(100) NOT NULL,
                slug VARCHAR(100) NOT NULL UNIQUE,
                short_description VARCHAR(255),
                description TEXT,
                price DECIMAL(8,2) DEFAULT 0.00,
                rating DECIMAL(2,1) DEFAULT 0.0,
                image VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
    }

    public function down(PDO $pdo)
    {
        $pdo->exec("DROP TABLE IF EXISTS products");
    }
};
