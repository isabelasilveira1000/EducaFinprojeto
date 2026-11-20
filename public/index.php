

<!DOCTYPE html>

<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EducaFin – Educação fiscal e financeira</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,700;12..96,800&family=Source+Serif+4:opsz,wght@8..60,400;8..60,500&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#fcfbf8; --card:#fffefb; --line:#e8e4d9;
  --ink:#06301c; --ink-soft:#4f5a52; --green:#0b5d3b; --chip:#dcf0e6;
  --yellow:#f4c94a; --mark:#fbe77a;
  --sans:"Bricolage Grotesque","Segoe UI",system-ui,sans-serif;
  --serif:"Source Serif 4",Georgia,"Times New Roman",serif;
}
*{box-sizing:border-box;margin:0}
body{font-family:var(--sans);background:var(--bg);color:var(--ink);line-height:1.5}
a{color:inherit;text-decoration:none}
:focus-visible{outline:3px solid var(--green);outline-offset:2px}

/* Cabeçalho */
.top{display:flex;align-items:center;justify-content:space-between;gap:24px;max-width:1440px;margin:0 auto;padding:14px 24px}
.brand{display:flex;align-items:center;gap:12px;font-weight:800;font-size:1.5rem;color:var(--ink)}
.logo{width:46px;height:46px;border-radius:50%;background:var(--green);color:#fff;display:grid;place-items:center;font-size:1.05rem;font-weight:800}
.search{display:flex;align-items:center;gap:10px;background:#fff;border:1px solid var(--line);border-radius:999px;padding:0 18px;height:50px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.search input{flex:1;border:0;background:transparent;font:inherit;font-size:1rem;color:var(--ink);min-width:0;outline:0}
.search input::placeholder{color:#59635c}
.search svg{flex:none;color:var(--ink)}
.top .search{width:min(480px,100%)}
.nav{border-top:1px solid var(--line);border-bottom:1px solid var(--line)}
.nav ul{list-style:none;display:flex;gap:6px;max-width:1440px;margin:0 auto;padding:0 24px;overflow-x:auto}
.nav a{display:block;padding:18px 15px;font-weight:500;color:#2d3a32;white-space:nowrap}
.nav a:hover{color:var(--green)}

/* Hero */
.hero{background-image:linear-gradient(var(--line) 1px,transparent 1px),linear-gradient(90deg,var(--line) 1px,transparent 1px);background-size:52px 52px;background-position:-1px -1px;border-bottom:1px solid var(--line)}
.hero-in{max-width:1440px;margin:0 auto;padding:96px 24px 120px;display:grid;grid-template-columns:1.25fr 1fr;gap:56px;align-items:center}
.tag{display:inline-flex;align-items:center;gap:8px;border:1px solid var(--line);background:var(--bg);border-radius:999px;padding:7px 14px;font-size:.8rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--green)}
h1{font-size:clamp(2.8rem,6vw,4.6rem);line-height:1.02;font-weight:800;letter-spacing:-.03em;margin:22px 0 26px}
h1 mark{background:linear-gradient(transparent 62%,var(--mark) 62%);color:inherit;padding:0 6px 0 0}
.lead{font-family:var(--serif);font-size:1.35rem;line-height:1.65;color:var(--ink-soft);max-width:30em;margin-bottom:34px}
.hero .search{height:68px;padding:0 8px 0 22px;max-width:720px;box-shadow:0 4px 14px rgba(6,48,28,.06)}
.hero .search input{font-size:1.1rem}
.btn{background:var(--green);color:#fff;border:0;border-radius:999px;padding:14px 24px;font:inherit;font-weight:700;cursor:pointer}
.btn:hover{background:#094a2f}
.chips{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-top:18px;color:var(--ink-soft)}
.chips button{background:var(--chip);color:var(--ink);border:0;border-radius:999px;padding:9px 16px;font:inherit;font-weight:500;cursor:pointer}
.chips button:hover{background:#c8e8d8}

/* Termo do dia */
.term{position:relative;background:var(--card);border:1px solid var(--line);border-radius:30px;padding:46px 40px 36px;transform:rotate(1.2deg);box-shadow:0 18px 40px rgba(6,48,28,.1),0 2px 6px rgba(0,0,0,.05)}
.term .flag{position:absolute;top:-16px;left:40px;background:var(--yellow);border-radius:999px;padding:7px 16px;font-size:.78rem;font-weight:800;letter-spacing:.05em;text-transform:uppercase}
.term h2{font-size:2.3rem;font-weight:800;letter-spacing:-.02em}
.term .cls{color:var(--ink-soft);margin:6px 0 18px}
.term p{font-family:var(--serif);font-size:1.2rem;line-height:1.7;color:#2d3a32}
.term a{display:inline-flex;gap:8px;align-items:center;margin-top:22px;font-weight:700;color:var(--green)}
.term a:hover{text-decoration:underline}

/* Seções */
main section{max-width:1440px;margin:0 auto;padding:64px 24px 24px}
h2.sec{font-size:2.2rem;font-weight:800;letter-spacing:-.02em}
.sub{font-family:var(--serif);color:var(--ink-soft);font-size:1.15rem;margin:6px 0 28px}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.disc{display:flex;gap:20px;background:var(--card);border:1px solid var(--line);border-radius:24px;padding:24px;box-shadow:0 2px 6px rgba(0,0,0,.04);transition:box-shadow .15s}
.disc:hover{box-shadow:0 8px 22px rgba(6,48,28,.1)}
.ico{flex:none;width:60px;height:60px;border-radius:18px;display:grid;place-items:center;background:var(--bg-i);color:var(--fg-i)}
.disc h3{font-size:1.35rem;font-weight:700;letter-spacing:-.01em}
.disc p{font-family:var(--sans);color:var(--ink-soft);margin:8px 0 12px;font-size:1.02rem;line-height:1.65}
.disc small{font-weight:700;font-size:.92rem;color:var(--fg-i)}

/* Comece por aqui */
.posts{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;padding-bottom:40px}
.post{background:var(--card);border:1px solid var(--line);border-radius:24px;padding:26px;display:flex;flex-direction:column;gap:10px}
.post .k{font-size:.9rem;font-weight:700;color:var(--fg-i)}
.post h3{font-size:1.35rem;font-weight:700;line-height:1.25}
.post p{font-family:var(--serif);font-size:1.08rem;line-height:1.65;color:var(--ink-soft)}
.post[hidden]{display:none}
.none{color:var(--ink-soft);font-family:var(--serif);font-size:1.1rem;grid-column:1/-1}

@media (max-width:960px){
  .hero-in{grid-template-columns:1fr;padding:56px 20px 80px}
  .grid,.posts{grid-template-columns:1fr 1fr}
  .top .search{display:none}
}
@media (max-width:620px){
  .grid,.posts{grid-template-columns:1fr}
  .term{padding:40px 26px 30px}
  .btn{padding:12px 18px}
}
@media (prefers-reduced-motion:reduce){*{transition:none!important}}
</style>
</head>
<body>

<header>
  <div class="top">
    <a class="brand" href="#"><span class="logo" aria-hidden="true">Ef</span>EducaFin</a>
    <form class="search" role="search" data-busca>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
      <input type="search" placeholder="Buscar um assunto: inflação, IPCA, orçamento…" aria-label="Buscar um assunto">
    </form>
  </div>
  <nav class="nav" aria-label="Disciplinas">
    <ul>
      <li><a href="#disciplinas">Educação Fiscal</a></li>
      <li><a href="#disciplinas">Impostos e Tributos</a></li>
      <li><a href="#disciplinas">Orçamento Pessoal</a></li>
      <li><a href="#disciplinas">Investimentos</a></li>
      <li><a href="#disciplinas">Crédito e Dívidas</a></li>
      <li><a href="#disciplinas">Economia</a></li>
    </ul>
  </nav>
</header>

<div class="hero">
  <div class="hero-in">
    <div>
      <span class="tag">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h6a4 4 0 0 1 4 4v12a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v12a3 3 0 0 1 3-3h7z"/></svg>
        Educação fiscal e financeira
      </span>
      <h1>Entenda o dinheiro. <mark>Exerça</mark> sua cidadania.</h1>
      <p class="lead">Resumos claros, exemplos do dia a dia e exercícios comentados para você estudar no seu ritmo.</p>
      <form class="search" role="search" data-busca>
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input id="q" type="search" placeholder="Buscar um assunto: inflação, IPCA, orçamento…" aria-label="Buscar um assunto">
        <button class="btn" type="submit">Buscar</button>
      </form>
      <div class="chips">
        <span>Mais buscados:</span>
        <button type="button">Inflação</button>
        <button type="button">Juros compostos</button>
        <button type="button">Tributos</button>
        <button type="button">Orçamento</button>
      </div>
    </div>

    <article class="term" aria-label="Termo do dia">
      <span class="flag">Termo do dia</span>
      <h2>Selic</h2>
      <p class="cls">substantivo feminino</p>
      <p>Taxa básica de juros da economia brasileira, definida pelo Comitê de Política Monetária (Copom) do Banco Central. Serve de referência para empréstimos e investimentos.</p>
      <a href="#disciplinas">Estudar economia
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </article>
  </div>
</div>

<main>
  <section id="disciplinas">
    <h2 class="sec">Disciplinas</h2>
    <p class="sub">Escolha um tema e comece a estudar.</p>
    <div class="grid">

      <a class="disc" href="#" style="--bg-i:#dcebe9;--fg-i:#1b7473">
        <span class="ico"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V10m4 11V10m6 11V10m4 11V10M3 10l9-6 9 6z"/></svg></span>
        <div><h3>Educação Fiscal</h3><p>Cidadania, função social dos tributos e controle dos gastos públicos.</p><small>1 conteúdo</small></div>
      </a>

      <a class="disc" href="#" style="--bg-i:#f6e3dd;--fg-i:#c0472b">
        <span class="ico"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3h14v18l-3-2-2 2-2-2-2 2-2-2-3 2z"/><path d="M14.5 8.5c-.5-.7-1.4-1-2.5-1-1.4 0-2.3.7-2.3 1.6 0 2.2 5 1 5 3.200 0 1-1 1.700-2.600 1.700-1.200 0-2.100-.4-2.600-1.200M12 6v1.500m0 7V16"/></svg></span>
        <div><h3>Impostos e Tributos</h3><p>Como funcionam os tributos no Brasil e quem paga cada um.</p><small>1 conteúdo</small></div>
      </a>

      <a class="disc" href="#" style="--bg-i:#e1ece4;--fg-i:#1f7a4a">
        <span class="ico"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0 0 4h14a1 1 0 0 1 1 1v3m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5"/><path d="M20 11h-3a2 2 0 0 0 0 4h3z"/></svg></span>
        <div><h3>Orçamento Pessoal</h3><p>Planejamento, controle de gastos e reserva de emergência.</p><small>1 conteúdo</small></div>
      </a>

      <a class="disc" href="#" style="--bg-i:#e3e8f2;--fg-i:#2a5fa5">
        <span class="ico"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/></svg></span>
        <div><h3>Investimentos</h3><p>Juros compostos, renda fixa e primeiros passos para investir.</p><small>1 conteúdo</small></div>
      </a>

      <a class="disc" href="#" style="--bg-i:#f6e1e6;--fg-i:#b0345a">
        <span class="ico"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2.500"/><path d="M2 10h20"/></svg></span>
        <div><h3>Crédito e Dívidas</h3><p>Cartão, empréstimos, juros e como sair do vermelho.</p><small>1 conteúdo</small></div>
      </a>

      <a class="disc" href="#" style="--bg-i:#f4e8d4;--fg-i:#b07a00">
        <span class="ico"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M8 17v-5m4 5V8m4 9v-3"/></svg></span>
        <div><h3>Economia</h3><p>Inflação, Selic e os conceitos que movem o seu bolso.</p><small>1 conteúdo</small></div>
      </a>

    </div>
  </section>

  <section>
    <h2 class="sec">Comece por aqui</h2>
    <p class="sub">Três leituras curtas para pegar o ritmo.</p>
    <div class="posts" id="posts">
      <a class="post" href="#" style="--fg-i:#b07a00"><span class="k">Economia</span><h3>O que é inflação e como ela afeta o seu bolso</h3><p>Entenda por que os preços sobem e como o IPCA mede essa alta.</p></a>
      <a class="post" href="#" style="--fg-i:#1f7a4a"><span class="k">Orçamento Pessoal</span><h3>Como montar um orçamento em quatro passos</h3><p>Liste o que entra, o que sai e defina quanto guardar todo mês.</p></a>
      <a class="post" href="#" style="--fg-i:#2a5fa5"><span class="k">Investimentos</span><h3>Juros compostos: o efeito do tempo</h3><p>Veja, com exemplos, por que começar cedo faz tanta diferença.</p></a>
      <p class="none" id="none" hidden>Nenhum conteúdo encontrado para essa busca.</p>
    </div>
  </section>
</main>

<script>
(function(){
  var forms=document.querySelectorAll('[data-busca]'),
      inputs=document.querySelectorAll('[data-busca] input'),
      posts=document.querySelectorAll('.post'),
      none=document.getElementById('none');

  function filtrar(t){
    t=t.trim().toLowerCase();
    var achou=0;
    posts.forEach(function(p){
      var ok=!t||p.textContent.toLowerCase().indexOf(t)>-1;
      p.hidden=!ok; if(ok) achou++;
    });
    none.hidden=achou>0;
  }
  forms.forEach(function(f){
    f.addEventListener('submit',function(e){
      e.preventDefault();
      var v=f.querySelector('input').value;
      inputs.forEach(function(i){i.value=v});
      filtrar(v);
      document.getElementById('posts').scrollIntoView({behavior:'smooth',block:'center'});
    });
  });
  document.querySelectorAll('.chips button').forEach(function(b){
    b.addEventListener('click',function(){
      inputs.forEach(function(i){i.value=b.textContent});
      filtrar(b.textContent);
    });
  });
})();
</script>
</body>
</html>