<?php
// app/Core/autoload.php

spl_autoload_register(function ($class) {
    // Prefixo do namespace do nosso app
    $prefix = 'App\\';

    // Diretório base onde ficam as classes (ajuste se necessário)
    $baseDir = __DIR__ . '/../../app/';

    // Se a classe não pertence ao nosso prefixo, ignore
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    // Obtém a parte após o prefixo e converte namespace -> path
    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
