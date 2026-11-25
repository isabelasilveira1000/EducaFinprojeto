<?php
/** @var array<int,array{nome:string,url:string,feitos:int,total:int}> $itens Progresso por disciplina. */
$itens = $itens ?? [];
?>
<section class="ef-profile">
    <nav class="ef-crumb" aria-label="Você está em">
        <a href="<?= e(url('home/index')) ?>">Início</a> /
        <a href="<?= e(url('user/perfil')) ?>">Perfil</a> /
        <b>Plano de estudos</b>
    </nav>

    <h1 class="ef-plan-title">Plano de estudos</h1>
    <p class="ef-sub">Acompanhe o seu avanço em cada disciplina.</p>

    <?php if (!$itens): ?>
        <p class="ef-none">Ainda não há disciplinas no seu plano.</p>
    <?php else: ?>
        <div class="ef-plan">
            <?php foreach ($itens as $i): ?>
                <?php $pct = $i['total'] > 0 ? (int) round($i['feitos'] / $i['total'] * 100) : 0; ?>
                <a class="ef-plan-item" href="<?= e($i['url']) ?>">
                    <div class="ef-plan-head">
                        <h3><?= e($i['nome']) ?></h3>
                        <span><?= $pct ?>%</span>
                    </div>
                    <div class="ef-bar" role="progressbar" aria-valuenow="<?= $pct ?>" aria-valuemin="0" aria-valuemax="100"
                         aria-label="Progresso em <?= e($i['nome']) ?>">
                        <i style="width:<?= $pct ?>%"></i>
                    </div>
                    <p><?= (int) $i['feitos'] ?> de <?= (int) $i['total'] ?> <?= $i['total'] === 1 ? 'conteúdo concluído' : 'conteúdos concluídos' ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>