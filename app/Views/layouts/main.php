
<?php
/** @var string|null $title */
/** @var string|null $content */
/** @var string|null $disciplinaAtiva */

$pageTitle = isset($title) && is_string($title)
    ? $title
    : 'EducaFin - Educação Financeira';

$pageContent = isset($content) && is_string($content)
    ? $content
    : '';

require_once __DIR__ . '/../../Models/Disciplina.php';

$disciplinasMenu = \App\Models\Disciplina::all();

$ativa = isset($disciplinaAtiva) && is_string($disciplinaAtiva)
    ? $disciplinaAtiva
    : '';

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
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,700;12..96,800&family=Source+Serif+4:opsz,wght@8..60,400;8..60,500&display=swap"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/estilo.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/educafin.css') ?>">
</head>

<body id="page-top" class="ef-body">

    <!-- CABEÇALHO -->
    <header>
        <div class="ef-top">

            <a class="ef-brand" href="<?= e(url('home/index')) ?>">
                <span class="ef-logo" aria-hidden="true">Ef</span>
                EducaFin
            </a>

            <form
                class="ef-search"
                role="search"
                data-busca
                data-home="<?= e(url('home/index')) ?>"
            >
                <svg width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-3.5-3.5"/>
                </svg>

                <input
                    type="search"
                    placeholder="Buscar um assunto: inflação, IPCA, orçamento…"
                    aria-label="Buscar um assunto"
                >
            </form>

        </div>

        <nav class="ef-nav" aria-label="Principal">
            <ul>

                <?php foreach ($disciplinasMenu as $d): ?>
                    <li>
                        <a
                            href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $d['conteudos'][0]['slug'])) ?>"
                            class="<?= $ativa === $d['slug'] ? 'is-active' : '' ?>"
                            <?= $ativa === $d['slug'] ? 'aria-current="page"' : '' ?>
                        >
                            <?= e($d['nome']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>

                <?php if ($logado): ?>

                    <li class="ef-right">
                        <a href="<?= e(url('user/perfil')) ?>">
                            Usuário
                        </a>
                    </li>

                    <li>
                        <form
                            class="ef-logout"
                            method="post"
                            action="<?= e(url('user/logout')) ?>"
                        >
                            <input
                                type="hidden"
                                name="csrf"
                                value="<?= e($_SESSION['csrf']) ?>"
                            >

                            <button type="submit">Sair</button>
                        </form>
                    </li>

                <?php else: ?>

                    <li class="ef-right">
                        <a href="<?= e(url('user/login')) ?>">Entrar</a>
                    </li>

                    <li>
                        <a href="<?= e(url('user/create')) ?>">Cadastrar</a>
                    </li>

                <?php endif; ?>

            </ul>
        </nav>
    </header>

    <!-- CONTEÚDO DAS PÁGINAS -->
    <main class="ef-main" style="min-height: 70vh;">
        <?= $pageContent ?>
    </main>

    <!-- RODAPÉ -->
    
<!-- RODAPÉ -->
<footer class="ef-footer">

    <div class="ef-footer-decoration"></div>

    <div class="ef-foot-in">

        <!-- IDENTIDADE DO SITE -->
        <div class="ef-footer-about">
            <a class="ef-footer-brand" href="<?= e(url('home/index')) ?>">
                <span class="ef-footer-logo">Ef</span>
                <span>EducaFin</span>
            </a>

            <p>
                Aprender hoje para transformar o amanhã.
                Educação fiscal e financeira para construir
                escolhas mais conscientes e um futuro melhor.
            </p>

            <div class="ef-footer-social">
                <span><i class="fa-solid fa-book-open"></i></span>
                <span><i class="fa-solid fa-coins"></i></span>
                <span><i class="fa-solid fa-graduation-cap"></i></span>
            </div>
        </div>

        <!-- DISCIPLINAS -->
        <div class="ef-fcol">
            <h4>Explore as disciplinas</h4>

            <ul>
                <?php foreach ($disciplinasMenu as $d): ?>
                    <li>
                        <a href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $d['conteudos'][0]['slug'])) ?>">
                            <?= e($d['nome']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- SOBRE -->
        <div class="ef-fcol">
            <h4>Conheça o EducaFin</h4>

            <ul>
                <li><a href="#">Sobre o projeto</a></li>
                <li><a href="#">Nossa proposta</a></li>
                <li><a href="#">Fale conosco</a></li>
            </ul>
        </div>

        <!-- DESTAQUE -->
        <div class="ef-footer-message">
            <span class="ef-footer-message-icon">
                <i class="fa-solid fa-lightbulb"></i>
            </span>

            <h4>Conhecimento é investimento!</h4>

            <p>
                Quanto mais você aprende, melhores
                escolhas pode fazer.
            </p>
        </div>

    </div>

    <div class="ef-copy">
        <span>© <?= date('Y') ?> EducaFin</span>
        <span>Educação que transforma. Conhecimento que liberta.</span>
    </div>

</footer>


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('js/scripts.js') ?>" defer></script>
    <script src="<?= asset('js/educafin.js') ?>" defer></script>
    <script src="<?= asset('js/quiz-conteudo.js') ?>" defer></script>

</body>
</html>
```