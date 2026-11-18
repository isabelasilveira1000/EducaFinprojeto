
<?php
$pageTitle = isset($title) && is_string($title)
    ? $title
    : 'EducaFinance - Sistema de Controle Financeiro';

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
    <link rel="stylesheet" href="<?= asset('css/css/styles.css') ?>">
<link rel="stylesheet" href="<?= asset('css/estilo.css') ?>">
</head>

<body>

    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top"
         id="mainNav">

        <div class="container">

            <a class="navbar-brand" href="<?= url('user/index') ?>">
                Meu Sistema
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
                            Usuários
                        </a>
                    </li>

                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded"
                           href="<?= url('user/create') ?>">
                            Novo usuário
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- Conteúdo das páginas -->
    <main style="padding-top: 100px;">
        <?= $pageContent ?>
    </main>

    <!-- JavaScript do Freelancer -->
    <script src="<?= asset('assets/js/scripts.js') ?>"></script>

</body>
</html>



