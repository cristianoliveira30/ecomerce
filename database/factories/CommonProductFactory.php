<?php
/**
 * Uso: php database/factories/CommonProductFactory.php [quantidade]
 */

$qty = (int)($argv[1] ?? 10);
if ($qty < 1) $qty = 10;

$config = require __DIR__ . '/../../config/database.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
        $config['user'],
        $config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    exit("❌ Erro de conexão: {$e->getMessage()}\n");
}

function slugify($text) {
    $text = mb_strtolower($text, 'UTF-8');
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    return trim($text, '-');
}

$titles = [
    "Fone Bluetooth JBL", "Controle PS5 DualSense", "PowerBank 20.000mAh",
    "Relógio Inteligente XWatch", "Lâmpada RGB Wi-Fi", "Suporte para Celular",
    "Carregador Turbo 65W", "Câmera de Segurança Wi-Fi", "Microfone Condensador", 
    "Mouse Gamer RGB"
];

$insert = $pdo->prepare("
    INSERT INTO products (title, slug, short_description, description, price, rating, image, category, created_at)
    VALUES (:title, :slug, :short_description, :description, :price, :rating, :image, :category, :created_at)
");

for ($i = 0; $i < $qty; $i++) {
    $title = $titles[array_rand($titles)];
    $slug = slugify($title) . '-' . substr(uniqid(), -4);
    $short_description = "Produto eletrônico popular e de alta durabilidade.";
    $description = "Ideal para uso diário, com ótimo custo-benefício e design moderno.";
    $price = number_format(rand(8000, 49990) / 100, 2, '.', '');
    $rating = number_format(rand(30, 50) / 10, 1);
    $image = "img/products/common_" . (($i % 5) + 1) . ".jpg";
    $category = 'comum';
    $created_at = date('Y-m-d H:i:s');

    $insert->execute([
        ':title' => $title,
        ':slug' => $slug,
        ':short_description' => $short_description,
        ':description' => $description,
        ':price' => $price,
        ':rating' => $rating,
        ':image' => $image,
        ':category' => $category,
        ':created_at' => $created_at
    ]);

    echo "✅ Inserido: {$title}\n";
}

echo "\n🎉 {$qty} produtos comuns inseridos.\n";
