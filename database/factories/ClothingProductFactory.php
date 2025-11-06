<?php
/**
 * Uso: php database/factories/ClothingProductFactory.php [quantidade]
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
    "Boné Nike Air", "Camisa Polo Premium", "Calça Jeans Slim Fit", 
    "Tênis Adidas Run", "Chinelo Slide Comfort", "Jaqueta Corta-Vento",
    "Camisa Regata DryFit", "Chapéu Fedora Clássico", 
    "Moletom Oversized", "Camiseta Estilo Street"
];

$insert = $pdo->prepare("
    INSERT INTO products (title, slug, short_description, description, price, rating, image, category, created_at)
    VALUES (:title, :slug, :short_description, :description, :price, :rating, :image, :category, :created_at)
");

for ($i = 0; $i < $qty; $i++) {
    $title = $titles[array_rand($titles)];
    $slug = slugify($title) . '-' . substr(uniqid(), -4);
    $short_description = "Peça de roupa de alta qualidade e conforto.";
    $description = "Fabricado com materiais premium e design moderno.";
    $price = number_format(rand(5000, 29990) / 100, 2, '.', '');
    $rating = number_format(rand(35, 50) / 10, 1);
    $image = "img/products/clothing_" . (($i % 5) + 1) . ".jpg";
    $category = 'roupas';
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

echo "\n🎉 {$qty} roupas inseridas.\n";
