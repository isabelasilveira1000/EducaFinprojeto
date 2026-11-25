<?php 
// $disciplina vem do DisciplinaController
if (!isset($disciplina) || !is_array($disciplina)) {
    http_response_code(500);
    exit('A disciplina não foi enviada pelo controller.');
}
$d = $disciplina;
$n = count($d['conteudos']);
?>
<div class="ef-dhero" style="--bg-i:<?= e($d['bg']) ?>;--fg-i:<?= e($d['fg']) ?>">
  <div class="ef-dhero-in">
    <p class="ef-crumb"><a href="<?= e(url('home/index')) ?>">Início</a> &nbsp;/&nbsp; <b><?= e($d['nome']) ?></b></p>
    <div class="ef-dhead">
      <span class="ef-dico">
        <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= $d['icone'] ?></svg>
      </span>
      <div>
        <h1><?= e($d['nome']) ?></h1>
        <p><?= e($d['descricao']) ?></p>
      </div>
    </div>
  </div>
</div>

<section class="ef-sec" style="--bg-i:<?= e($d['bg']) ?>;--fg-i:<?= e($d['fg']) ?>">
  <p class="ef-count"><?= $n ?> <?= $n === 1 ? 'conteúdo' : 'conteúdos' ?></p>
  <div class="ef-cards">
    <?php foreach ($d['conteudos'] as $c): ?>
      <a class="ef-card" href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $c['slug'])) ?>">
        <div class="ef-card-top">
          <span class="ef-pill"><?= e($d['nome']) ?></span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 17 7M8 7h9v9"/></svg>
        </div>
        <h3><?= e($c['titulo']) ?></h3>
        <p><?= e($c['resumo']) ?></p>
        <div class="ef-meta">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
          <?= e($c['tempo']) ?> &nbsp;·&nbsp; <?= e($c['nivel']) ?>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>
