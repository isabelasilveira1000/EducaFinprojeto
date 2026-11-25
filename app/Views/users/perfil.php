
<?php
/** @var array<string,mixed> $user */

$nome = (string) ($user['name'] ?? '');
$email = (string) ($user['email'] ?? '');
$telefone = (string) ($user['phone'] ?? '');
$foto = (string) ($user['photo'] ?? '');

$nomeExibicao = $nome !== '' ? $nome : 'Estudante';

$partes = preg_split('/\s+/', trim($nome)) ?: [];

$iniciais = mb_strtoupper(
    mb_substr($partes[0] ?? '', 0, 1) .
    (count($partes) > 1 ? mb_substr(end($partes), 0, 1) : '')
);
?>

<section class="ef-profile-page">

    <nav class="ef-profile-crumb">
        <a href="<?= e(url('home/index')) ?>">Início</a>
        <span>/</span>
        <strong>Meu perfil</strong>
    </nav>

    <header class="ef-profile-heading">
        <span class="ef-profile-label">ESPAÇO DO ESTUDANTE</span>
        <h1>Meu perfil <span>✦</span></h1>
        <p>Seu espaço para acompanhar sua jornada de conhecimento.</p>
    </header>

    <div class="ef-profile-card">

        <div class="ef-profile-banner">

            <div class="ef-banner-text">
                <span>EDUCAFIN • SUA JORNADA FINANCEIRA</span>
                <h2>Conhecimento que transforma<br>o seu futuro.</h2>
                <p>Aprenda, evolua e conquiste novos objetivos.</p>
            </div>

            <div class="ef-banner-art" aria-hidden="true">
                <svg viewBox="0 0 300 220" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="165" cy="105" r="91" fill="#ffffff" opacity=".08"/>
                    <circle cx="165" cy="105" r="70" fill="none" stroke="#E6C77B" stroke-width="1.5" opacity=".8"/>

                    <rect x="90" y="85" width="105" height="85" rx="9" fill="#F8F3E6"/>
                    <rect x="102" y="98" width="81" height="8" rx="4" fill="#D5AC59"/>
                    <rect x="102" y="114" width="55" height="5" rx="2" fill="#B9CDBB"/>
                    <rect x="102" y="125" width="68" height="5" rx="2" fill="#B9CDBB"/>

                    <rect x="115" y="142" width="12" height="20" rx="3" fill="#0D8056"/>
                    <rect x="134" y="133" width="12" height="29" rx="3" fill="#D5AC59"/>
                    <rect x="153" y="122" width="12" height="40" rx="3" fill="#0D8056"/>

                    <circle cx="208" cy="65" r="23" fill="#D5AC59"/>
                    <text x="208" y="73" text-anchor="middle" font-size="25" fill="#123D2D" font-weight="bold">R$</text>

                    <path d="M54 168 Q30 120 63 100 Q85 135 54 168Z" fill="#A9C9A8"/>
                    <path d="M54 168 Q54 135 63 100" stroke="#F8F3E6" stroke-width="2" fill="none"/>

                    <circle cx="235" cy="155" r="8" fill="#E6C77B"/>
                    <circle cx="75" cy="55" r="5" fill="#E6C77B"/>
                    <path d="M225 40 l5 10 10 5 -10 5 -5 10 -5 -10 -10 -5 10 -5Z" fill="#F8F3E6" opacity=".8"/>
                </svg>
            </div>

            <div class="ef-banner-decoration"></div>
        </div>

        <div class="ef-profile-content">

            <div class="ef-profile-user-top">

                <div class="ef-profile-avatar">
                    <?php if ($foto !== ''): ?>
                        <img
                            src="<?= e(asset('uploads/avatars/' . $foto)) ?>"
                            alt="Foto de perfil de <?= e($nomeExibicao) ?>"
                        >
                    <?php else: ?>
                        <span><?= e($iniciais ?: 'EF') ?></span>
                    <?php endif; ?>
                </div>

                <div class="ef-profile-user">
                    <span class="ef-profile-welcome">✦ PERFIL DO ESTUDANTE</span>
                    <h2><?= e($nomeExibicao) ?></h2>
                    <p>Bem-vindo(a) ao seu espaço no EducaFin!</p>
                </div>

            </div>

            <div class="ef-profile-divider"></div>

            <div class="ef-profile-section-title">
                <span>01</span>
                <h3>Informações pessoais</h3>
            </div>

            <div class="ef-profile-details">

                <div class="ef-profile-detail">
                    <div class="ef-profile-icon">✉</div>
                    <div>
                        <span>Endereço de e-mail</span>
                        <strong><?= e($email) ?></strong>
                    </div>
                </div>

                <div class="ef-profile-detail">
                    <div class="ef-profile-icon">☎</div>
                    <div>
                        <span>Telefone</span>
                        <strong>
                            <?= $telefone !== ''
                                ? e($telefone)
                                : 'Não informado' ?>
                        </strong>
                    </div>
                </div>

            </div>

            <div class="ef-profile-action">
                <div class="ef-action-icon">✦</div>

                <div class="ef-action-text">
                    <span>SUA PRÓXIMA CONQUISTA</span>
                    <h3>Continue evoluindo!</h3>
                    <p>Acesse seu plano de estudos e continue aprendendo.</p>
                </div>

                <a href="<?= e(url('user/plano')) ?>" class="ef-profile-button">
                    Ver plano de estudos <span>→</span>
                </a>
            </div>

        </div>
    </div>

    <p class="ef-profile-footer">
        ✦ Educação financeira é liberdade para construir o futuro.
    </p>

</section>
