<?php
/** @var array<string, mixed> $disciplina Disciplina atual. */
/** @var array<string, mixed> $conteudo Aula atual. */

if (!isset($disciplina, $conteudo) || !is_array($disciplina) || !is_array($conteudo)) {
    http_response_code(500);
    exit('Os dados do conteúdo não foram enviados pelo controller.');
}

$quiz = is_array($conteudo['quiz'] ?? null) ? $conteudo['quiz'] : [];
$exemplos = is_array($conteudo['exemplos'] ?? null) ? $conteudo['exemplos'] : [];
?>
<div class="ef-lesson" style="--bg-i:<?= e($disciplina['bg']) ?>;--fg-i:<?= e($disciplina['fg']) ?>">
  <header class="ef-lesson-hero">
    <div class="ef-lesson-wrap">
      <p class="ef-crumb">
        <a href="<?= e(url('home/index')) ?>">Início</a>
        <span aria-hidden="true">/</span>
        <a href="<?= e(url('disciplina/show/' . $disciplina['slug'])) ?>"><?= e($disciplina['nome']) ?></a>
        <span aria-hidden="true">/</span>
        <b><?= e($conteudo['titulo']) ?></b>
      </p>

      <span class="ef-lesson-pill"><?= e($disciplina['nome']) ?></span>
      <h1><?= e($conteudo['titulo']) ?></h1>
      <p class="ef-lesson-intro"><?= e($conteudo['resumo']) ?></p>

      <div class="ef-lesson-meta">
        <span>
          <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
          <?= e($conteudo['tempo']) ?> de leitura
        </span>
        <span><?= e($conteudo['nivel']) ?></span>
        <span><?= count($quiz) ?> questões no quiz</span>
      </div>
    </div>
  </header>

  <main class="ef-lesson-wrap ef-lesson-main">
    <nav class="ef-lesson-index" aria-label="Nesta aula">
      <strong>Nesta aula</strong>
      <a href="#conceito">O conceito</a>
      <a href="#exemplos">Exemplos práticos</a>
      <a href="#quiz">Quiz</a>
    </nav>

    <article class="ef-lesson-content">
      <section class="ef-lesson-section" id="conceito">
        <span class="ef-lesson-step">01 · ENTENDA</span>
        <h2>O que é esse conceito?</h2>
        <div class="ef-lesson-paragraph"><?= nl2br(e(str_replace('\\n', "\n", (string) ($conteudo['conceito'] ?? '')))) ?></div>
      </section>

      <section class="ef-lesson-section" id="exemplos">
        <span class="ef-lesson-step">02 · VEJA NA PRÁTICA</span>
        <h2>Exemplos do dia a dia</h2>
        <div class="ef-example-list">
          <?php foreach ($exemplos as $i => $exemplo): ?>
            <div class="ef-example-card">
              <span class="ef-example-number"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
              <p><?= e($exemplo) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="ef-lesson-section ef-quiz-section" id="quiz">
        <span class="ef-lesson-step">03 · TESTE O QUE APRENDEU</span>
        <h2>Hora do quiz!</h2>
        <p class="ef-quiz-intro">Responda às questões e confira seu resultado no final. Você pode tentar novamente quantas vezes quiser.</p>

        <?php if ($quiz !== []): ?>
          <form class="ef-quiz-form" data-ef-quiz>
            <?php foreach ($quiz as $i => $questao): ?>
              <fieldset class="ef-quiz-question"
                        data-correct="<?= (int) $questao['resposta'] ?>"
                        data-explanation="<?= e($questao['explicacao']) ?>">
                <legend><span><?= $i + 1 ?></span><?= e($questao['pergunta']) ?></legend>
                <div class="ef-quiz-options">
                  <?php foreach ($questao['opcoes'] as $j => $opcao): ?>
                    <label class="ef-quiz-option">
                      <input type="radio" name="questao_<?= $i ?>" value="<?= $j ?>" required>
                      <span><?= e($opcao) ?></span>
                    </label>
                  <?php endforeach; ?>
                </div>
                <p class="ef-quiz-feedback" hidden aria-live="polite"></p>
              </fieldset>
            <?php endforeach; ?>

            <div class="ef-quiz-actions">
              <button class="ef-btn" type="submit">Ver meu resultado</button>
              <button class="ef-quiz-reset" type="reset">Tentar novamente</button>
            </div>
            <p class="ef-quiz-result" data-ef-quiz-result role="status" hidden></p>
          </form>
        <?php else: ?>
          <p>Este conteúdo ainda não possui questões cadastradas.</p>
        <?php endif; ?>
      </section>

      <div class="ef-lesson-back">
        <a href="<?= e(url('disciplina/show/' . $disciplina['slug'])) ?>">← Ver todos os conteúdos de <?= e($disciplina['nome']) ?></a>
      </div>
    </article>
  </main>
</div>
