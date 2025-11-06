<?php

return new class {
    public function up(PDO $pdo) {
        $pdo->exec("
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(30) DEFAULT 'client',
                phone VARCHAR(20),
                address VARCHAR(255),
                city VARCHAR(100),
                state VARCHAR(100),
                zip_code VARCHAR(15),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS users");
    }
};
