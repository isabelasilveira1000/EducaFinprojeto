<?php
/** @var array<string,string> $errors Erros por campo. */
/** @var array<string,string> $old Valores digitados antes do erro. */
/** @var string $csrf Token CSRF gerado pelo controller. */
$errors = $errors ?? [];
$old = $old ?? [];
?>
<section class="ef-auth">
    <div class="ef-auth-card">
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
</section>
