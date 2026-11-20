(function () {
  var posts = document.querySelectorAll('.ef-post'),
      none = document.getElementById('ef-none'),
      list = document.getElementById('ef-posts'),
      inputs = document.querySelectorAll('[data-busca] input');

  function setAll(v) { inputs.forEach(function (i) { i.value = v; }); }
  function filtrar(t) {
    t = t.trim().toLowerCase();
    var achou = 0;
    posts.forEach(function (p) {
      var ok = !t || p.textContent.toLowerCase().indexOf(t) > -1;
      p.hidden = !ok;
      if (ok) achou++;
    });
    if (none) none.hidden = achou > 0;
  }

  document.querySelectorAll('[data-busca]').forEach(function (f) {
    f.addEventListener('submit', function (e) {
      e.preventDefault();
      var v = f.querySelector('input').value;
      if (!posts.length) {            // fora da home: vai para a home já com a busca
        location.href = f.dataset.home + '#' + encodeURIComponent(v);
        return;
      }
      setAll(v); filtrar(v);
      list.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  });

  document.querySelectorAll('.ef-chips button').forEach(function (b) {
    b.addEventListener('click', function () { setAll(b.textContent); filtrar(b.textContent); });
  });

  if (posts.length && location.hash.length > 1) {   // busca vinda de outra página
    var h = decodeURIComponent(location.hash.slice(1));
    if (!document.getElementById(h)) { setAll(h); filtrar(h); }
  }
})();