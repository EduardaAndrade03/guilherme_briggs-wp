/* Página Trabalhos: abas (um grupo por vez) e paginação dentro de cada grupo */
(function () {
  var pagina = document.querySelector('.trabalhos-pagina');
  if (!pagina) return;

  var abas = pagina.querySelectorAll('.trabalhos-aba');
  var grupos = pagina.querySelectorAll('.trabalhos-grupo');
  var porPagina = parseInt(pagina.getAttribute('data-por-pagina'), 10) || 8;

  /* ---------- Paginação ---------- */
  function paginar(grupo) {
    var cards = Array.prototype.slice.call(grupo.querySelectorAll('.blog__lista > .post-card'));
    if (cards.length <= porPagina) return;

    var total = Math.ceil(cards.length / porPagina);
    var atual = 1;
    var nav = document.createElement('nav');
    nav.className = 'trabalhos-paginacao';
    nav.setAttribute('aria-label', 'Páginas');
    grupo.appendChild(nav);

    function botao(texto, pagina, extra) {
      var b = document.createElement('button');
      b.type = 'button';
      b.textContent = texto;
      b.className = 'trabalhos-pag' + (extra ? ' ' + extra : '');
      return b;
    }

    function desenhar() {
      cards.forEach(function (card, i) {
        card.hidden = !(i >= (atual - 1) * porPagina && i < atual * porPagina);
      });

      nav.innerHTML = '';

      var anterior = botao('‹ Anterior');
      anterior.disabled = atual === 1;
      anterior.addEventListener('click', function () { ir(atual - 1); });
      nav.appendChild(anterior);

      for (var n = 1; n <= total; n++) {
        (function (n) {
          var b = botao(String(n), n, n === atual ? 'is-atual' : '');
          if (n === atual) b.setAttribute('aria-current', 'page');
          b.addEventListener('click', function () { ir(n); });
          nav.appendChild(b);
        })(n);
      }

      var proxima = botao('Próxima ›');
      proxima.disabled = atual === total;
      proxima.addEventListener('click', function () { ir(atual + 1); });
      nav.appendChild(proxima);
    }

    function ir(n) {
      atual = Math.max(1, Math.min(total, n));
      desenhar();
      grupo.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    desenhar();
  }

  grupos.forEach(paginar);

  /* ---------- Abas ---------- */
  if (!abas.length) return;
  pagina.classList.add('tem-abas');

  function mostrar(alvo) {
    abas.forEach(function (aba) {
      var ativa = aba.getAttribute('data-alvo') === alvo;
      aba.classList.toggle('is-ativa', ativa);
      aba.setAttribute('aria-selected', ativa ? 'true' : 'false');
    });
    grupos.forEach(function (grupo) {
      grupo.classList.toggle('is-ativo', grupo.id === 'grupo-' + alvo);
    });
  }

  abas.forEach(function (aba) {
    aba.addEventListener('click', function () {
      mostrar(aba.getAttribute('data-alvo'));
    });
  });

  mostrar(abas[0].getAttribute('data-alvo'));
})();
