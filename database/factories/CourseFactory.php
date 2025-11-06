<?php
// Uso: php database/factory_courses.php [quantidade]
// Ex: php database/factory_courses.php 12

$qty = (int)($argv[1] ?? 10);
if ($qty < 1) $qty = 10;

// carrega config (assume que config/database.php já usa EnvLoader se necessário)
$configPath1 = __DIR__ . '/../../config/database.php';
$configPath2 = __DIR__ . '/../../../config/database.php';
if (file_exists($configPath1)) {
    $config = require $configPath1;
} elseif (file_exists($configPath2)) {
    $config = require $configPath2;
} else {
    echo "❌ Não foi possível localizar config/database.php\n";
    exit(1);
}

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
        $config['user'],
        $config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    echo "❌ Erro de conexão: " . $e->getMessage() . "\n";
    exit(1);
}

// Cria tabela courses se não existir
$createSql = <<<SQL
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    short_description VARCHAR(255),
    description TEXT,
    price DECIMAL(8,2) DEFAULT 0.00,
    rating DECIMAL(2,1) DEFAULT 0.0,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

$pdo->exec($createSql);

// Funções utilitárias
function slugify($text) {
    $text = mb_strtolower($text, 'UTF-8');
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return $text ?: 'curso-' . substr(uniqid(), -6);
}

$titles = [
    "Camisa São Miguel",
    "Terço de São Bento",
    "Kit 3 camisas Totus Tuus",
    "Camiseta Divina Misericórdia",
    "Escapulário de Nossa Senhora do Carmo - Modelo Clássico",
    "Crucifixo de Parede em Madeira",
    "Nossa Senhora Aparecida - Imagem de Resina",
    "Nossa Senhora de Fátima - Porcelana",
    "Medalha de São Bento - Aço Inoxidável",
    "Confissões de Santo Agostinho - Edição de Bolso",
];

$adjectives = ["Completo", "Essencial", "Promoção", "Caridoso", "Limitado", "Exclusivo"];

$sentences = [
    "Patrocinadas pelo Lírio Mimoso.",
    "Feitos em Belém do Pará.",
    "Lucros deste item serão enviados à caridade.",
    "Presente ideal para familiares.",
    "Ora et Labora.",
    "Gênero: Filosofia, História, Poesia.",
];

$insertSql = "INSERT INTO products (title, slug, short_description, description, price, rating, image, created_at)
              VALUES (:title, :slug, :short_description, :description, :price, :rating, :image, :created_at)";

$stmt = $pdo->prepare($insertSql);

$inserted = [];

for ($i = 0; $i < $qty; $i++) {
    // combinações aleatórias para título
    $t = $titles[array_rand($titles)];
    $adj = $adjectives[array_rand($adjectives)];
    $title = "{$t} - {$adj}";

    $slugBase = slugify($title);
    // garante slug único adicionando sufixo aleatório curto
    $slug = $slugBase . '-' . substr(uniqid(), -4);

    $short = $sentences[array_rand($sentences)];
    // descrição mais longa combinada
    $desc = implode(' ', [
        $short,
        $sentences[array_rand($sentences)],
        "Pode ser usado como um presente ou como objeto de autoconsagração.",
        "Limitado a essa loja, feito em Belém do Pará."
    ]);

    $instructor = $instructors[array_rand($instructors)];
    $price = number_format(rand(0, 19990) / 100, 2, '.', ''); // 0.00 até 199.90 ou 199.90
    $duration = rand(60, 1200); // em minutos
    $rating = number_format(rand(30, 50) / 10, 1); // 3.0 - 5.0
    $students = rand(10, 15000);

    // image sugerida — você pode criar/impor imagens em public/images/courseX.jpg e ajustar nomes
    $image = "img/course" . ( ($i % 6) + 1 ) . ".jpg";

    // created_at aleatório últimos 365 dias
    $daysAgo = rand(0, 365);
    $createdAt = date('Y-m-d H:i:s', strtotime("-{$daysAgo} days"));

    try {
        $stmt->execute([
            ':title' => $title,
            ':slug' => $slug,
            ':short_description' => $short,
            ':description' => $desc,
            ':price' => $price,
            ':rating' => $rating,
            ':image' => $image,
            ':created_at' => $createdAt
        ]);

        $insertId = $pdo->lastInsertId();
        $inserted[] = ['id' => $insertId, 'title' => $title, 'slug' => $slug];
        echo "✅ Inserido: [{$insertId}] {$title} (R\$ {$price})\n";
    } catch (Exception $e) {
        echo "❌ Erro ao inserir curso: " . $e->getMessage() . "\n";
    }
}

echo "\n🎉 Total inserido: " . count($inserted) . " cursos\n";
if (count($inserted) > 0) {
    echo "IDs inseridos: " . implode(', ', array_map(function($r){ return $r['id']; }, $inserted)) . "\n";
}
