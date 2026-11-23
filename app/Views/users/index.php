
<?php

/** @var array<string, array<string, mixed>> $disciplinas Recebido do HomeController. */
$svg = static fn (string $inner, int $s = 30): string =>
    '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $inner . '</svg>';
?>
<div class="ef-hero">
  <div class="ef-hero-in">
    <div>
      <span class="ef-tag">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h6a4 4 0 0 1 4 4v12a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v12a3 3 0 0 1 3-3h7z"/></svg>
        Educação fiscal e financeira
      </span>
      <h1>Entenda o dinheiro. <mark>Exerça</mark> sua cidadania.</h1>
      <p class="ef-lead">Resumos claros, exemplos do dia a dia e exercícios comentados para você estudar no seu ritmo.</p>
      <form class="ef-search" role="search" data-busca>
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input type="search" placeholder="Buscar um assunto: inflação, IPCA, orçamento…" aria-label="Buscar um assunto">
        <button class="ef-btn" type="submit">Buscar</button>
      </form>
      <div class="ef-chips">
        <span>Mais buscados:</span>
        <button type="button">Inflação</button>
        <button type="button">Juros compostos</button>
        <button type="button">Tributos</button>
        <button type="button">Orçamento</button>
      </div>
    </div>

    <article class="ef-term" aria-label="Termo do dia">
      <span class="ef-flag">Termo do dia</span>
      <h2>Selic</h2>
      <p class="ef-cls">substantivo feminino</p>
      <p class="ef-def">Taxa básica de juros da economia brasileira, definida pelo Comitê de Política Monetária (Copom) do Banco Central. Serve de referência para empréstimos e investimentos.</p>
      <a class="ef-more" href="<?= e(url('disciplina/conteudo/economia/o-que-e-inflacao')) ?>">Estudar economia
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </article>
  </div>
</div>

<section class="ef-sec" id="disciplinas">
  <h2>Disciplinas</h2>
  <p class="ef-sub">Escolha um tema e comece a estudar.</p>
  <div class="ef-grid">
    <?php foreach ($disciplinas as $d): $n = count($d['conteudos']); ?>
      <a class="ef-disc" href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $d['conteudos'][0]['slug'])) ?>" style="--bg-i:<?= e($d['bg']) ?>;--fg-i:<?= e($d['fg']) ?>">
        <span class="ef-ico"><?= $svg($d['icone']) ?></span>
        <div>
          <h3><?= e($d['nome']) ?></h3>
          <p><?= e($d['descricao']) ?></p>
          <small><?= $n ?> <?= $n === 1 ? 'conteúdo' : 'conteúdos' ?></small>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<section class="ef-sec">
  <h2>Comece por aqui</h2>
  <p class="ef-sub">Três leituras curtas para pegar o ritmo.</p>
  <div class="ef-posts" id="ef-posts">
    <?php foreach (array_slice($disciplinas, 0, 3) as $d): $c = $d['conteudos'][0]; ?>
      <a class="ef-post" href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $c['slug'])) ?>" style="--fg-i:<?= e($d['fg']) ?>">
        <span><?= e($d['nome']) ?></span>
        <h3><?= e($c['titulo']) ?></h3>
        <p><?= e($c['resumo']) ?></p>
      </a>
    <?php endforeach; ?>
    <p class="ef-none" id="ef-none" hidden>Nenhum conteúdo encontrado para essa busca.</p>
  </div>
</section>

<section class="ef-sec">
  <div class="ef-index">
    <h2>Índice de conteúdos</h2>
    <p class="ef-sub">Todos os assuntos, organizados por disciplina.</p>
    <div class="ef-index-grid">
      <?php foreach ($disciplinas as $d): ?>
        <div>
          <h3><?= e($d['nome']) ?></h3>
          <ul>
            <?php foreach ($d['conteudos'] as $c): ?>
              <li><a href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $c['slug'])) ?>"><?= e($c['titulo']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
