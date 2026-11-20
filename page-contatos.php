<?php get_header(); ?>

<main class="container">
    <section class="contato">
        <div class="contato_info">
            <h2><?php echo esc_html(tema_texto('titulo_contato')); ?></h2>
<?php if (tema_texto('link_youtube')) : ?>
            <a href="<?php echo esc_url(tema_texto('link_youtube')); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                </svg><?php echo esc_html(tema_texto('contato_youtube')); ?>
            </a>
            <?php endif; ?>
<?php if (tema_texto('link_instagram')) : ?>
            <a href="<?php echo esc_url(tema_texto('link_instagram')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                </svg><?php echo esc_html(tema_texto('contato_instagram')); ?>
            </a>
            <?php endif; ?>
<?php if (tema_texto('link_x')) : ?>
            <a href="<?php echo esc_url(tema_texto('link_x')); ?>" target="_blank" rel="noopener noreferrer" aria-label="X">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/>
                </svg><?php echo esc_html(tema_texto('contato_x')); ?>
            </a>
            <?php endif; ?>
<?php if (tema_texto('link_facebook')) : ?>
            <a href="<?php echo esc_url(tema_texto('link_facebook')); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                </svg><?php echo esc_html(tema_texto('contato_facebook')); ?>
            </a>
            <?php endif; ?>
<?php if (tema_texto('link_tiktok')) : ?>
            <a href="<?php echo esc_url(tema_texto('link_tiktok')); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                </svg><?php echo esc_html(tema_texto('contato_tiktok')); ?>
            </a>
            <?php endif; ?>
<?php if (tema_texto('contato_email')) : ?>
            <a href="<?php echo esc_url('mailto:' . tema_texto('contato_email')); ?>" aria-label="E-mail">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg><?php echo esc_html(tema_texto('contato_email')); ?>
            </a>
            <?php endif; ?>
        </div>   
        <div class="contato_img">
             <?php $imagem = tema_imagem('img_contato'); ?>
            <img src="<?php echo esc_url($imagem ? $imagem['url'] : img_placeholder()); ?>" alt="<?php echo esc_attr($imagem ? $imagem['alt'] : 'Imagem padrão'); ?>">
        </div> 
    </section>

</main>

<?php get_footer(); ?>