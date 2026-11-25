<?php
/** @var array<string,string> $errors Erros (chave login = e-mail ou senha incorretos). */
/** @var array<string,string> $old Valores digitados antes do erro. */
/** @var string $csrf Token CSRF gerado pelo controller. */
$errors = $errors ?? [];
$old = $old ?? [];
?>
<section class="ef-auth">
    <div class="ef-auth-layout">
        <aside class="ef-auth-art" aria-label="Ilustração de educação financeira">
            <span class="ef-auth-art-tag">APRENDA • PLANEJE • CRESÇA</span>
            <div class="ef-auth-illustration" aria-hidden="true">
                <svg viewBox="0 0 420 320" role="img">
                    <path d="M55 264h310" class="art-line"/>
                    <rect x="83" y="170" width="74" height="94" rx="13" class="art-card"/>
                    <rect x="171" y="126" width="74" height="138" rx="13" class="art-card art-card-light"/>
                    <rect x="259" y="88" width="74" height="176" rx="13" class="art-card"/>
                    <path d="M101 145l36-34 34 14 48-52 44 9 49-48" class="art-chart"/>
                    <path d="M296 34h16v16" class="art-chart"/>
                    <circle cx="119" cy="216" r="18" class="art-coin"/><path d="M119 205v22m-7-16h11a5 5 0 0 1 0 10h-11" class="art-coin-line"/>
                    <circle cx="207" cy="174" r="18" class="art-coin"/><path d="M207 163v22m-7-16h11a5 5 0 0 1 0 10h-11" class="art-coin-line"/>
                    <path d="M344 265c-4-34 8-58 29-76m-29 45c-21-5-33-18-37-37m37 16c19-2 31-12 37-28" class="art-leaf"/>
                    <path d="M335 265h27" class="art-line"/>
                </svg>
            </div>
            <h2>Seu futuro começa com conhecimento.</h2>
            <p>Entenda o dinheiro, faça escolhas conscientes e participe de uma sociedade mais informada.</p>
            <div class="ef-auth-art-note"><span>✦</span> Educação financeira para a vida real</div>
        </aside>
        <div class="ef-auth-card">
        <span class="ef-auth-kicker">BEM-VINDA(O) DE VOLTA</span>
        <h1>Entrar</h1>
        <p class="ef-auth-lead">Acesse a sua conta para ver o seu perfil e o seu plano de estudos.</p>

        <?php if (isset($errors['login'])): ?>
            <p class="ef-alert" role="alert"><?= e($errors['login']) ?></p>
        <?php endif; ?>

        <form method="post" action="<?= e(url('user/authenticate')) ?>" novalidate>
            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

            <div class="ef-field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                       value="<?= e($old['email'] ?? '') ?>"
                       autocomplete="email" required>
            </div>

            <div class="ef-field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password"
                       autocomplete="current-password" required>
            </div>

            <button type="submit" class="ef-btn ef-auth-btn">Entrar</button>
        </form>

        <p class="ef-auth-alt">Ainda não tem conta? <a href="<?= e(url('user/create')) ?>">Cadastre-se</a></p>
    </div>
        </div>
</section>