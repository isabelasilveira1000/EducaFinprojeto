<?php
/** @var array<string,string> $errors Erros (chave login = e-mail ou senha incorretos). */
/** @var array<string,string> $old Valores digitados antes do erro. */
/** @var string $csrf Token CSRF gerado pelo controller. */
$errors = $errors ?? [];
$old = $old ?? [];
?>
<section class="ef-auth">
    <div class="ef-auth-card">
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
</section>