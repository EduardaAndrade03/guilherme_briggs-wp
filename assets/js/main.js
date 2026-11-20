console.log('Meu Tema carregado');

// Navbar: ganha fundo ao rolar a página (classe .is-rolado, veja style.css)
(function () {
  var header = document.querySelector('.site-header');
  if (!header) return;

  function atualizar() {
    header.classList.toggle('is-rolado', window.scrollY > 40);
  }

  window.addEventListener('scroll', atualizar, { passive: true });
  atualizar();
})();
