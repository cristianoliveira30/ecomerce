<?php
/**
 * Uso: php database/factories/ReligiousProductFactory.php [quantidade]
 */

$qty = (int)($argv[1] ?? 10);
if ($qty < 1) $qty = 10;

$config = require __DIR__ . '/../../config/database.php';

// Conexão
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

// Função slugify
function slugify($text) {
    $text = mb_strtolower($text, 'UTF-8');
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    return $text ?: 'produto-' . substr(uniqid(), -6);
}

// Dados base
$titles = [
    "Terço de São Bento", "Imagem de Nossa Senhora Aparecida",
    "Crucifixo de Parede", "Medalha de São Miguel Arcanjo",
    "Escapulário de Nossa Senhora do Carmo", "Camiseta Totus Tuus",
    "Livro - Confissões de Santo Agostinho", "Vela Aromática Sagrada Família",
    "Pulseira de São Francisco", "Chaveiro de São Jorge"
];

$sentences = [
    "Produzido artesanalmente em Belém do Pará.",
    "Ideal para uso pessoal ou presente religioso.",
    "Bênção especial em cada item.",
    "Enviado com embalagem protetora e oração inclusa."
];

// SQL com parâmetros nomeados corretos
$insert = $pdo->prepare("
    INSERT INTO products (title, slug, short_description, description, price, rating, image, category, created_at)
    VALUES (:title, :slug, :short_description, :description, :price, :rating, :image, :category, :created_at)
");

for ($i = 0; $i < $qty; $i++) {
    $title = $titles[array_rand($titles)];
    $slug = slugify($title) . '-' . substr(uniqid(), -4);
    $short_description = "Artigo religioso feito com fé e dedicação.";
    $description = implode(' ', [
        $sentences[array_rand($sentences)],
        $sentences[array_rand($sentences)]
    ]);
    $price = number_format(rand(2000, 9999) / 100, 2, '.', '');
    $rating = number_format(rand(40, 50) / 10, 1);
    $image = "img/products/religious_" . (($i % 5) + 1) . ".jpg";
    $category = "religioso";
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

echo "\n🎉 {$qty} produtos religiosos criados.\n";
