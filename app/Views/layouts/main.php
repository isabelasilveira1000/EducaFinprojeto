
<?php
$pageTitle = isset($title) && is_string($title)
    ? $title
    : 'EducaFin - Educação Financeira';

$pageContent = isset($content) && is_string($content)
    ? $content
    : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= e($pageTitle) ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS do Freelancer -->
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?= asset('css/estilo.css') ?>">
</head>

<body id="page-top">

    <!-- MENU -->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top"
         id="mainNav">

        <div class="container">

            <a class="navbar-brand" href="<?= url('user/index') ?>">
                EducaFin
            </a>

            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive">

                Menu
                <i class="fas fa-bars"></i>

            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded"
                           href="<?= url('user/index') ?>">
                            Início
                        </a>
                    </li>

                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded"
                           href="<?= url('user/index') ?>">
                            Usuários
                        </a>
                    </li>

                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded"
                           href="<?= url('user/create') ?>">
                            Cadastrar
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- CONTEÚDO DAS PÁGINAS -->
    <main style="padding-top: 100px; min-height: 80vh;">

        <?= $pageContent ?>

    </main>

    <!-- RODAPÉ -->
    <footer class="footer text-center bg-secondary text-white py-4">

        <div class="container">
            <h5>EducaFin</h5>

            <p class="mb-0">
                Educação financeira para transformar o futuro.
            </p>

            <small>
                &copy; <?= date('Y') ?> EducaFin. Todos os direitos reservados.
            </small>
        </div>

    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript do Freelancer -->
    <script src="<?= asset('js/scripts.js') ?>"></script>

</body>
</html>




