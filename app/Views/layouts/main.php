<?php
/** @var string|null $title Recebido pelo controller. */
/** @var string|null $content HTML da view renderizada pelo controller. */
/** @var string|null $disciplinaAtiva Slug da disciplina atual, quando houver. */
$pageTitle = isset($title) && is_string($title)
    ? $title
    : 'EducaFin - Educação Financeira';

$pageContent = isset($content) && is_string($content)
    ? $content
    : '';

// Menu e rodapé listam as disciplinas; $disciplinaAtiva vem do controller
require_once __DIR__ . '/../../Models/Disciplina.php';
$disciplinasMenu = \App\Models\Disciplina::all();
$ativa = isset($disciplinaAtiva) && is_string($disciplinaAtiva) ? $disciplinaAtiva : '';

// Login: o menu muda conforme a pessoa esteja logada ou não
$logado = !empty($_SESSION['user_id']);
$_SESSION['csrf'] ??= bin2hex(random_bytes(32));
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

    <!-- Fontes do novo visual -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,700;12..96,800&family=Source+Serif+4:opsz,wght@8..60,400;8..60,500&display=swap"
          rel="stylesheet">

    <!-- CSS do Freelancer -->
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?= asset('css/estilo.css') ?>">

    <!-- CSS do novo visual (deve vir por último) -->
    <link rel="stylesheet" href="<?= asset('css/educafin.css') ?>">
</head>

<body id="page-top" class="ef-body">

    <!-- CABEÇALHO -->
    <header>
        <div class="ef-top">
            <a class="ef-brand" href="<?= e(url('home/index')) ?>">
                <span class="ef-logo" aria-hidden="true">Ef</span>EducaFin
            </a>

            <form class="ef-search" role="search" data-busca
                  data-home="<?= e(url('home/index')) ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input type="search" placeholder="Buscar um assunto: inflação, IPCA, orçamento…" aria-label="Buscar um assunto">
            </form>
        </div>

        <nav class="ef-nav" aria-label="Principal">
            <ul>
                <?php foreach ($disciplinasMenu as $d): ?>
                    <li>
                        <a href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $d['conteudos'][0]['slug'])) ?>"
                           class="<?= $ativa === $d['slug'] ? 'is-active' : '' ?>"
                           <?= $ativa === $d['slug'] ? 'aria-current="page"' : '' ?>><?= e($d['nome']) ?></a>
                    </li>
                <?php endforeach; ?>
                <?php if ($logado): ?>
                    <li class="ef-right"><a href="<?= e(url('user/perfil')) ?>">Usuário</a></li>
                    <li>
                        <form class="ef-logout" method="post" action="<?= e(url('user/logout')) ?>">
                            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                            <button type="submit">Sair</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="ef-right"><a href="<?= e(url('user/login')) ?>">Entrar</a></li>
                    <li><a href="<?= e(url('user/create')) ?>">Cadastrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- CONTEÚDO DAS PÁGINAS -->
    <main style="min-height: 70vh;">

        <?= $pageContent ?>

    </main>

    <!-- RODAPÉ -->
    <footer class="ef-footer">
        <div class="ef-foot-in">
            <div>
                <a class="ef-brand" href="<?= e(url('home/index')) ?>">
                    <span class="ef-logo" aria-hidden="true">Ef</span>EducaFin
                </a>
                <p>Educação fiscal e financeira para você entender o dinheiro, estudar no seu ritmo e exercer a sua cidadania.</p>
            </div>

            <div class="ef-fcol">
                <h4>Disciplinas</h4>
                <ul>
                    <?php foreach ($disciplinasMenu as $d): ?>
                        <li><a href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $d['conteudos'][0]['slug'])) ?>"><?= e($d['nome']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="ef-fcol">
                <h4>EducaFin</h4>
                <ul>
                    <li><a href="#">Sobre nós</a></li>
                    <li><a href="#">Fale conosco</a></li>
                    <li><a href="#">Política de privacidade</a></li>
                </ul>
            </div>
        </div>
        <div class="ef-copy">&copy; <?= date('Y') ?> EducaFin. Todos os direitos reservados.</div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript do Freelancer -->
    <script src="<?= asset('js/scripts.js') ?>"></script>

    <!-- JavaScript do novo visual -->
    <script src="<?= asset('js/educafin.js') ?>"></script>

    <!-- Interação do quiz das aulas -->
    <script src="<?= asset('js/quiz-conteudo.js') ?>"></script>

</body>
</html>
