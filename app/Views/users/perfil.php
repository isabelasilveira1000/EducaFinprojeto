<?php
/** @var array<string,mixed> $user Usuário logado (id, name, email, phone, photo opcional). */
$nome = (string) ($user['name'] ?? '');
$email = (string) ($user['email'] ?? '');
$telefone = (string) ($user['phone'] ?? '');
$foto = (string) ($user['photo'] ?? '');

// Iniciais para o avatar quando não há foto
$partes = preg_split('/\s+/', trim($nome)) ?: [];
$iniciais = mb_strtoupper(mb_substr($partes[0] ?? '', 0, 1) . (count($partes) > 1 ? mb_substr(end($partes), 0, 1) : ''));
?>
<section class="ef-profile">
    <nav class="ef-crumb" aria-label="Você está em">
        <a href="<?= e(url('home/index')) ?>">Início</a> / <b>Perfil</b>
    </nav>

    <div class="ef-profile-card">
        <div class="ef-avatar">
            <?php if ($foto !== ''): ?>
                <img src="<?= e(asset('uploads/avatars/' . $foto)) ?>" alt="Foto de perfil de <?= e($nome) ?>">
            <?php else: ?>
                <span aria-hidden="true"><?= e($iniciais ?: 'Ef') ?></span>
            <?php endif; ?>
        </div>

        <div class="ef-profile-body">
            <h1><?= e($nome) ?></h1>

            <dl class="ef-info">
                <div>
                    <dt>E-mail</dt>
                    <dd><?= e($email) ?></dd>
                </div>
                <div>
                    <dt>Telefone</dt>
                    <dd><?= $telefone !== '' ? e($telefone) : '<span class="ef-empty">Não informado</span>' ?></dd>
                </div>
            </dl>

            <a class="ef-btn" href="<?= e(url('user/plano')) ?>">Ver plano de estudos</a>
        </div>
    </div>
</section>