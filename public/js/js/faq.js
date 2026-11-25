
document.addEventListener('DOMContentLoaded', function () {

    const busca = document.getElementById('faqBusca');
    const limpar = document.getElementById('faqLimpar');
    const contador = document.getElementById('faqContador');
    const botoes = document.querySelectorAll('#duvidas .faq-cat');
    const perguntas = document.querySelectorAll('#faqLista .ef-faq-item');
    const vazio = document.getElementById('faqVazio');
    const toggle = document.getElementById('faqToggle');

    let categoriaAtual = 'todas';

    function normalizar(texto) {
        return texto.normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim();
    }

    function filtrar() {
        const termo = normalizar(busca.value);
        let quantidade = 0;

        perguntas.forEach(function (pergunta) {
            const categoria = normalizar(pergunta.dataset.category || '');
            const texto = normalizar(pergunta.textContent);

            const mostrar =
                (categoriaAtual === 'todas' || categoria === categoriaAtual) &&
                texto.includes(termo);

            pergunta.style.display = mostrar ? '' : 'none';

            if (!mostrar) {
                pergunta.open = false;
            } else {
                quantidade++;
            }
        });

        contador.textContent = quantidade +
            (quantidade === 1
                ? ' dúvida encontrada'
                : ' dúvidas encontradas');

        vazio.hidden = quantidade !== 0;

        toggle.textContent = 'Abrir todas +';
        toggle.dataset.aberto = 'false';
    }

    botoes.forEach(function (botao) {
        botao.addEventListener('click', function (event) {
            event.preventDefault();

            categoriaAtual = normalizar(botao.dataset.filter);

            botoes.forEach(function (item) {
                item.classList.toggle('active', item === botao);
            });

            filtrar();
        });
    });

    busca.addEventListener('input', filtrar);

    limpar.addEventListener('click', function (event) {
        event.preventDefault();

        busca.value = '';
        categoriaAtual = 'todas';

        botoes.forEach(function (botao) {
            botao.classList.toggle(
                'active',
                botao.dataset.filter === 'todas'
            );
        });

        filtrar();
    });

    toggle.addEventListener('click', function (event) {
        event.preventDefault();

        const abrir = toggle.dataset.aberto !== 'true';

        perguntas.forEach(function (pergunta) {
            if (pergunta.style.display !== 'none') {
                pergunta.open = abrir;
            }
        });

        toggle.dataset.aberto = String(abrir);
        toggle.textContent = abrir ? 'Fechar todas −' : 'Abrir todas +';
    });

    filtrar();

});
