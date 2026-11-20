/* Painel das páginas: imagens, listas (adicionar/remover/ordenar/abrir/fechar) e caixas recolhidas. */
(function ($) {

  /* ---------- Escolher imagem da biblioteca de mídia ---------- */
  $(document).on('click', '.tema-img-escolher', function (e) {
    e.preventDefault();
    var $caixa = $(this).closest('.tema-img');
    var quadro = wp.media({
      title: 'Escolher imagem',
      button: { text: 'Usar esta imagem' },
      library: { type: 'image' },
      multiple: false
    });
    quadro.on('select', function () {
      var anexo = quadro.state().get('selection').first().toJSON();
      var url = anexo.sizes && anexo.sizes.medium ? anexo.sizes.medium.url : anexo.url;
      $caixa.find('input[type=hidden]').val(anexo.id);
      $caixa.find('.tema-img-previa').html('<img src="' + url + '" alt="">');
      $caixa.find('.tema-img-remover').show();
    });
    quadro.open();
  });

  $(document).on('click', '.tema-img-remover', function (e) {
    e.preventDefault();
    var $caixa = $(this).closest('.tema-img');
    $caixa.find('input[type=hidden]').val('');
    $caixa.find('.tema-img-previa').empty();
    $(this).hide();
  });

  /* ---------- Listas ---------- */
  $(document).on('click', '.tema-lista-add', function (e) {
    e.preventDefault();
    var $lista = $(this).closest('.tema-lista');
    var n = parseInt($lista.attr('data-prox'), 10);
    var html = $lista.children('.tema-modelo').html().replace(/__N__/g, n);
    $lista.attr('data-prox', n + 1);
    $lista.children('.tema-lista-linhas').append(html);
  });

  $(document).on('click', '.tema-linha-remover', function (e) {
    e.preventDefault();
    if (window.confirm('Remover este item?')) {
      $(this).closest('.tema-linha').remove();
    }
  });

  $(document).on('click', '.tema-linha-subir', function (e) {
    e.preventDefault();
    var $linha = $(this).closest('.tema-linha');
    $linha.prev('.tema-linha').before($linha);
  });

  $(document).on('click', '.tema-linha-descer', function (e) {
    e.preventDefault();
    var $linha = $(this).closest('.tema-linha');
    $linha.next('.tema-linha').after($linha);
  });

  // Abrir / fechar um item
  $(document).on('click', '.tema-linha-toggle', function (e) {
    e.preventDefault();
    $(this).closest('.tema-linha').toggleClass('is-fechada');
  });

  // Título do item fechado acompanha o que você digita
  $(document).on('input change', '.tema-linha input, .tema-linha textarea', function () {
    var $linha = $(this).closest('.tema-linha');
    var ids = ($linha.closest('.tema-lista').attr('data-resumo') || '').split(',');
    var partes = [];
    ids.forEach(function (id) {
      if (!id) return;
      var v = $.trim($linha.find('[name$="[' + id + ']"]').first().val() || '');
      if (v) partes.push(v);
    });
    var texto = partes.join(' — ');
    if (texto.length > 60) texto = texto.substring(0, 60) + '…';
    $linha.find('.tema-linha-resumo').first().text(texto || 'Novo item');
  });

  /* ---------- Caixas recolhidas (só a primeira começa aberta) ---------- */
  $(function () {
    var $caixas = $('.postbox[id^="tema_"]');
    if (!$caixas.length) return;

    var chave = 'tema_abertas_' + ($('#post_ID').val() || '');
    var abertas = null;
    try { abertas = JSON.parse(window.sessionStorage.getItem(chave)); } catch (e) {}
    if (!$.isArray(abertas)) abertas = [$caixas.first().attr('id')];

    $caixas.each(function () {
      $(this).toggleClass('closed', $.inArray(this.id, abertas) === -1);
    });

    // Lembra quais caixas você deixou abertas (assim, ao salvar, a tela volta do jeito que estava)
    $(document).on('postbox-toggled', function () {
      var lista = [];
      $caixas.each(function () {
        if (!$(this).hasClass('closed')) lista.push(this.id);
      });
      try { window.sessionStorage.setItem(chave, JSON.stringify(lista)); } catch (e) {}
    });
  });

})(jQuery);
