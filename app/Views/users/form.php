<?php
/** @var array<string,string> $errors Erros por campo. */
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
        <span class="ef-auth-kicker">FAÇA PARTE DO EDUCAFIN</span>
        <h1>Novo usuário</h1>
        <p class="ef-auth-lead">Cadastre-se para acompanhar os conteúdos de educação fiscal e financeira.</p>

        <form method="post" action="<?= e(url('user/store')) ?>" novalidate>
            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

            <div class="ef-field<?= isset($errors['name']) ? ' has-error' : '' ?>">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name"
                       value="<?= e($old['name'] ?? '') ?>"
                       autocomplete="name" required
                       <?= isset($errors['name']) ? 'aria-invalid="true" aria-describedby="name-erro"' : '' ?>>
                <?php if (isset($errors['name'])): ?>
                    <p class="ef-error" id="name-erro"><?= e($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <div class="ef-field<?= isset($errors['email']) ? ' has-error' : '' ?>">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                       value="<?= e($old['email'] ?? '') ?>"
                       autocomplete="email" required
                       <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="email-erro"' : '' ?>>
                <?php if (isset($errors['email'])): ?>
                    <p class="ef-error" id="email-erro"><?= e($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="ef-field<?= isset($errors['phone']) ? ' has-error' : '' ?>">
                <label for="phone">Telefone</label>
                <input type="tel" id="phone" name="phone"
                       value="<?= e($old['phone'] ?? '') ?>"
                       autocomplete="tel" inputmode="tel" required
                       <?= isset($errors['phone']) ? 'aria-invalid="true" aria-describedby="phone-erro"' : '' ?>>
                <?php if (isset($errors['phone'])): ?>
                    <p class="ef-error" id="phone-erro"><?= e($errors['phone']) ?></p>
                <?php endif; ?>
            </div>

            <div class="ef-field<?= isset($errors['password']) ? ' has-error' : '' ?>">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password"
                       autocomplete="new-password" minlength="8" maxlength="72" required
                       <?= isset($errors['password']) ? 'aria-invalid="true" aria-describedby="password-erro"' : '' ?>>
                <?php if (isset($errors['password'])): ?>
                    <p class="ef-error" id="password-erro"><?= e($errors['password']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="ef-btn ef-auth-btn">Cadastrar</button>
        </form>

        <p class="ef-auth-alt">Já tem uma conta? <a href="<?= e(url('user/login')) ?>">Entrar</a></p>
    </div>
        </div>
</section>