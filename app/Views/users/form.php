<?php
/** @var array<string,string> $errors Erros por campo (chaves: name, email). */
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

            <button type="submit" class="ef-btn ef-auth-btn">Cadastrar</button>
        </form>

        <p class="ef-auth-alt"><a href="<?= e(url('user/index')) ?>">Ver usuários cadastrados</a></p>
    </div>
</section>