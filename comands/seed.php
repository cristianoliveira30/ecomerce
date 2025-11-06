<?php
// commands/seed.php
// Uso: php commands/seed.php [quantidade]
// Ex: php commands/seed.php 10

$qty = (int)($argv[1] ?? 10);
if ($qty < 1) $qty = 10;

$factoryDir = __DIR__ . '/../database/factories';

if (!is_dir($factoryDir)) {
    exit("❌ Diretório de factories não encontrado: {$factoryDir}\n");
}

$factories = glob("{$factoryDir}/*.php");

if (empty($factories)) {
    exit("⚠️ Nenhuma factory encontrada em {$factoryDir}\n");
}

echo "\n🌱 Iniciando seed de {$qty} itens por factory...\n\n";

foreach ($factories as $factory) {
    $name = basename($factory);
    echo "🚀 Executando {$name} ... ";

    $cmd = escapeshellcmd(PHP_BINARY . " {$factory} {$qty}");
    exec($cmd . " 2>&1", $output, $status);

    if ($status === 0) {
        echo "✅ OK\n";
    } else {
        echo "❌ ERRO\n";
        foreach ($output as $line) {
            echo "   → {$line}\n";
        }
    }
}

echo "\n🎉 Seed finalizado!\n";
