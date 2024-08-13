<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1>Meu Formulário</h1>
        <!-- Adicione mais elementos de cabeçalho aqui -->
    </header>

    <main class="container my-5">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-light text-center py-3">
        <p>© 2024 Saraiva Soluções em Sistemas</p>
        <!-- Adicione mais elementos de rodapé aqui -->
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
