<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Minha Loja' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Seu CSS -->
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <?php include_once __DIR__ . '/header.php'; ?>

    <!-- Conteúdo -->
    <main class="container-fluid p-0" style="min-height: 80vh;">
        <?= $content ?? '' ?>
    </main>

    <!-- footer -->
    <?php include_once __DIR__ . '/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
