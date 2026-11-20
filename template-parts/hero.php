<?php $hero = tema_imagem('hero_img'); ?>
<section class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('<?php echo esc_url($hero ? $hero['url'] : img_placeholder()); ?>');">
</section>
