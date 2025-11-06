<?php
// Uso: php commands/make_factory.php Nome
// Exemplo: php commands/make_factory.php Product

$name = $argv[1] ?? null;

if (!$name) {
    die("❌ Uso: php commands/make_factory.php NomeDaFactory\n");
}

$name = ucfirst($name);
$factoryName = "{$name}Factory";
$timestamp = date('Y_m_d_His');
$filename = __DIR__ . "/../database/factories/{$factoryName}.php";

$template = <<<PHP
<?php
/**
 * Factory gerada automaticamente
 * Uso: php database/factories/{$factoryName}.php [quantidade]
 */

\$qty = (int)(\$argv[1] ?? 10);
if (\$qty < 1) \$qty = 10;

\$config = require __DIR__ . '/../../config/database.php';

try {
    \$pdo = new PDO(
        "mysql:host={\$config['host']};dbname={\$config['dbname']};charset=utf8mb4",
        \$config['user'],
        \$config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException \$e) {
    echo "❌ Erro de conexão: " . \$e->getMessage() . "\\n";
    exit(1);
}

// Função de slugify
function slugify(\$text) {
    \$text = mb_strtolower(\$text, 'UTF-8');
    \$text = preg_replace('~[^\\pL\\d]+~u', '-', \$text);
    \$text = iconv('UTF-8', 'ASCII//TRANSLIT', \$text);
    \$text = preg_replace('~[^-\\w]+~', '', \$text);
    \$text = trim(\$text, '-');
    \$text = preg_replace('~-+~', '-', \$text);
    return \$text ?: 'produto-' . substr(uniqid(), -6);
}

// Exemplo genérico de inserção (ajuste depois)
\$titles = [
    "Produto Exemplo",
    "Outro Produto",
    "Item Genérico"
];

\$insertSql = "INSERT INTO {strtolower($name)} (title, slug, short_description, description, price, rating, image, created_at)
               VALUES (:title, :slug, :short_description, :description, :price, :rating, :image, :created_at)";

\$stmt = \$pdo->prepare(\$insertSql);

for (\$i = 0; \$i < \$qty; \$i++) {
    \$title = \$titles[array_rand(\$titles)];
    \$slug = slugify(\$title) . '-' . substr(uniqid(), -4);
    \$short = "Descrição curta de exemplo";
    \$desc = "Descrição detalhada do produto exemplo para fins de teste.";
    \$price = number_format(rand(500, 9999) / 100, 2, '.', '');
    \$rating = number_format(rand(30, 50) / 10, 1);
    \$image = "img/products/default.jpg";
    \$createdAt = date('Y-m-d H:i:s');

    try {
        \$stmt->execute([
            ':title' => \$title,
            ':slug' => \$slug,
            ':short_description' => \$short,
            ':description' => \$desc,
            ':price' => \$price,
            ':rating' => \$rating,
            ':image' => \$image,
            ':created_at' => \$createdAt
        ]);
        echo "✅ Inserido: {\$title}\\n";
    } catch (Exception \$e) {
        echo "❌ Erro: " . \$e->getMessage() . "\\n";
    }
}

echo "\\n🎉 Total inserido: {\$qty}\\n";
PHP;

if (file_put_contents($filename, $template) !== false) {
    echo "✅ Factory criada com sucesso: {$filename}\n";
} else {
    echo "❌ Erro ao criar a factory.\n";
}
