
<?php

/**
 * @var array<string, array<string, mixed>> $disciplinas
 * Recebido do HomeController.
 */

$svg = static fn (string $inner, int $s = 30): string =>
    '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $inner . '</svg>';

?>

<!-- =========================
     BANNER PRINCIPAL
========================= -->

<div class="ef-hero">
    <div class="ef-hero-in">

        <div>
            <span class="ef-tag">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 4h6a4 4 0 0 1 4 4v12a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 4h-6a4 4 0 0 0-4 4v12a3 3 0 0 1 3-3h7z"/>
                </svg>
                Educação fiscal e financeira
            </span>

            <h1>Entenda o dinheiro. <mark>Exerça</mark> sua cidadania.</h1>

            <p class="ef-lead">
                Resumos claros, exemplos do dia a dia e exercícios comentados
                para você estudar no seu ritmo.
            </p>

            <form class="ef-search" role="search" data-busca>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-3.5-3.5"/>
                </svg>

                <input
                    type="search"
                    placeholder="Buscar um assunto: inflação, IPCA, orçamento…"
                    aria-label="Buscar um assunto"
                >

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

            <p class="ef-def">
                Taxa básica de juros da economia brasileira, definida pelo
                Comitê de Política Monetária (Copom) do Banco Central.
                Serve de referência para empréstimos e investimentos.
            </p>

            <a class="ef-more"
               href="<?= e(url('disciplina/conteudo/economia/o-que-e-inflacao')) ?>">
                Estudar economia

                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </a>

        </article>

    </div>
</div>


<!-- =========================
     DISCIPLINAS
========================= -->

<section class="ef-sec" id="disciplinas">

    <h2>Disciplinas</h2>

    <p class="ef-sub">
        Escolha um tema e comece a estudar.
    </p>

    <div class="ef-grid">

        <?php foreach ($disciplinas as $d): ?>

            <?php
                $conteudos = $d['conteudos'] ?? [];
                $n = count($conteudos);

                if ($n === 0) {
                    continue;
                }
            ?>

            <a class="ef-disc"
               href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $conteudos[0]['slug'])) ?>"
               style="--bg-i:<?= e($d['bg']) ?>;--fg-i:<?= e($d['fg']) ?>">

                <span class="ef-ico">
                    <?= $svg($d['icone']) ?>
                </span>

                <div>
                    <h3><?= e($d['nome']) ?></h3>

                    <p><?= e($d['descricao']) ?></p>

                    <small>
                        <?= $n ?>
                        <?= $n === 1 ? 'conteúdo' : 'conteúdos' ?>
                    </small>
                </div>

            </a>

        <?php endforeach; ?>

    </div>

</section>


<!-- =========================
     COMECE POR AQUI
========================= -->

<section class="ef-sec">

    <h2>Comece por aqui</h2>

    <p class="ef-sub">
        Três leituras curtas para pegar o ritmo.
    </p>

    <div class="ef-posts" id="ef-posts">

        <?php foreach (array_slice($disciplinas, 0, 3) as $d): ?>

            <?php
                $conteudos = $d['conteudos'] ?? [];

                if (empty($conteudos)) {
                    continue;
                }

                $c = $conteudos[0];
            ?>

            <a class="ef-post"
               href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $c['slug'])) ?>"
               style="--fg-i:<?= e($d['fg']) ?>">

                <span><?= e($d['nome']) ?></span>

                <h3><?= e($c['titulo']) ?></h3>

                <p><?= e($c['resumo']) ?></p>

            </a>

        <?php endforeach; ?>

        <p class="ef-none" id="ef-none" hidden>
            Nenhum conteúdo encontrado para essa busca.
        </p>

    </div>

</section>


<!-- =========================
     ÍNDICE DE CONTEÚDOS
========================= -->

<section class="ef-sec">

    <div class="ef-index">

        <h2>Índice de conteúdos</h2>

        <p class="ef-sub">
            Todos os assuntos, organizados por disciplina.
        </p>

        <div class="ef-index-grid">

            <?php foreach ($disciplinas as $d): ?>

                <div>

                    <h3><?= e($d['nome']) ?></h3>

                    <ul>

                        <?php foreach ($d['conteudos'] as $c): ?>

                            <li>
                                <a href="<?= e(url('disciplina/conteudo/' . $d['slug'] . '/' . $c['slug'])) ?>">
                                    <?= e($c['titulo']) ?>
                                </a>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- ==========================================
     CENTRAL DE DÚVIDAS INTERATIVA
========================================== -->

<section class="ef-sec" id="duvidas">

    <div class="ef-faq-heading">

        <span class="ef-tag">
            ✦ EDUCAFIN RESPONDE
        </span>

        <h2>
            Dinheiro gera dúvidas.
            <mark>Vamos esclarecer?</mark>
        </h2>

        <p class="ef-sub">
            Descubra respostas para situações do cotidiano
            e aprenda a tomar decisões financeiras mais conscientes.
        </p>

    </div>


    <!-- PAINEL DE BUSCA E FILTROS -->

    <div class="ef-faq-tools">

        <div class="ef-faq-search">

            <span>⌕</span>

            <input
                type="search"
                id="faqBusca"
                placeholder="Pesquise sua dúvida..."
                aria-label="Pesquisar perguntas frequentes"
            >

            <button type="button" id="faqLimpar">
                Limpar
            </button>

        </div>


        <!-- CATEGORIAS -->

        <div class="ef-faq-categorias">

            <button type="button"
                    class="faq-cat active"
                    data-filter="todas">
                Todas
            </button>

            <button type="button"
                    class="faq-cat"
                    data-filter="credito">
                 Crédito
            </button>

            <button type="button"
                    class="faq-cat"
                    data-filter="economia">
                 Economia
            </button>

            <button type="button"
                    class="faq-cat"
                    data-filter="planejamento">
                 Planejamento
            </button>

            <button type="button"
                    class="faq-cat"
                    data-filter="fiscal">
                 Educação fiscal
            </button>

        </div>


        <!-- CONTADOR -->

        <div class="ef-faq-status">

            <span id="faqContador">
                11 dúvidas encontradas
            </span>

            <button type="button" id="faqToggle">
                Abrir todas +
            </button>

        </div>

    </div>


    <!-- LISTA DE PERGUNTAS -->

    <div class="ef-faq" id="faqLista">


        <details class="ef-faq-item" data-category="credito">

            <summary>
                <span>01</span>
                É melhor comprar à vista ou parcelado?
            </summary>

            <p>
                Comprar à vista costuma ser vantajoso quando existe desconto
                e você possui dinheiro disponível. Já parcelar pode ajudar
                a organizar os pagamentos, desde que as parcelas caibam
                no orçamento e os juros sejam avaliados.
            </p>

        </details>


        <details class="ef-faq-item" data-category="economia">

            <summary>
                <span>02</span>
                Qual é a diferença entre conta corrente e poupança?
            </summary>

            <p>
                A conta corrente serve principalmente para movimentar dinheiro,
                fazer pagamentos, transferências e receber valores.
                A poupança é uma modalidade de depósito utilizada para guardar
                dinheiro e receber rendimentos.
            </p>

        </details>


        <details class="ef-faq-item" data-category="credito">

            <summary>
                <span>03</span>
                Devo usar cartão de crédito ou débito?
            </summary>

            <p>
                O cartão de débito utiliza o dinheiro disponível na sua conta.
                O crédito permite comprar agora e pagar depois.
                Os dois podem ser úteis, mas o cartão de crédito exige
                planejamento para evitar dívidas.
            </p>

        </details>


        <details class="ef-faq-item" data-category="credito">

            <summary>
                <span>04</span>
                O que acontece quando não pago a fatura do cartão?
            </summary>

            <p>
                O atraso pode gerar juros, multas e outras cobranças.
                A dívida pode crescer e comprometer sua organização financeira.
                Por isso, é importante acompanhar a fatura e os vencimentos.
            </p>

        </details>


        <details class="ef-faq-item" data-category="economia">

            <summary>
                <span>05</span>
                O que são juros compostos?
            </summary>

            <p>
                São juros calculados sobre o valor inicial e também sobre
                os juros acumulados anteriormente. Podem aumentar o rendimento
                de investimentos, mas também fazer dívidas crescerem.
            </p>

        </details>


        <details class="ef-faq-item" data-category="planejamento">

            <summary>
                <span>06</span>
                Por que é importante guardar dinheiro?
            </summary>

            <p>
                Guardar dinheiro ajuda a alcançar objetivos, lidar com
                imprevistos e ter mais segurança financeira.
                Mesmo pequenas quantias podem fazer diferença com o tempo.
            </p>

        </details>


        <details class="ef-faq-item" data-category="planejamento">

            <summary>
                <span>07</span>
                O que é uma reserva de emergência?
            </summary>

            <p>
                É um dinheiro separado para situações inesperadas,
                como despesas médicas, consertos ou perda de renda.
                Ela ajuda a evitar que imprevistos se transformem em dívidas.
            </p>

        </details>


        <details class="ef-faq-item" data-category="fiscal">

            <summary>
                <span>08</span>
                Qual é a diferença entre imposto, taxa e contribuição?
            </summary>

            <p>
                São diferentes espécies de tributos. O imposto não depende
                de um serviço específico prestado ao contribuinte.
                A taxa está relacionada a um serviço público específico
                ou ao exercício do poder de polícia. As contribuições
                possuem finalidades próprias previstas na legislação.
            </p>

        </details>


        <details class="ef-faq-item" data-category="planejamento">

            <summary>
                <span>09</span>
                Como começar a organizar meu dinheiro?
            </summary>

            <p>
                Comece anotando tudo o que recebe e gasta.
                Depois, separe as despesas essenciais, estabeleça prioridades
                e defina metas para economizar.
            </p>

        </details>


        <details class="ef-faq-item" data-category="planejamento">

            <summary>
                <span>10</span>
                O que é orçamento financeiro?
            </summary>

            <p>
                É o planejamento das entradas e saídas de dinheiro.
                Ele permite visualizar quanto você recebe, quanto gasta
                e quanto pode guardar.
            </p>

        </details>


        <details class="ef-faq-item" data-category="planejamento">

            <summary>
                <span>11</span>
                Como evitar compras por impulso?
            </summary>

            <p>
                Antes de comprar, pense se realmente precisa daquele produto,
                compare preços e avalie se a compra cabe no seu orçamento.
                Esperar um pouco antes de decidir também pode ajudar.
            </p>

        </details>

    </div>


    <!-- MENSAGEM DE BUSCA VAZIA -->

    <div class="ef-faq-vazio" id="faqVazio" hidden>

        <span>🔎</span>

        <h3>Não encontramos essa dúvida!</h3>

        <p>
            Tente pesquisar por outra palavra ou escolher uma categoria.
        </p>

    </div>


   



    <!-- RODAPÉ -->

    <div class="ef-faq-footer">

        

        <p>
            <strong>EducaFin:</strong>
            conhecimento financeiro também é uma forma
            de cuidar do seu futuro!
        </p>

    </div>

</section>


<!-- JAVASCRIPT DA CENTRAL DE DÚVIDAS -->

<script src="<?= e(asset('js/js/faq.js')) ?>" defer></script>
