<?php wp_footer(); ?>

<footer>
    <nav class="footer-nav">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'footer-menu',
          'container' => false,
          'menu_class' => 'footer-menu',
        ) );
      ?>
    </nav>
  <!--chargement du template modale.php  -->
    <?php get_template_part('templates_parts/modale-contact'); ?>
  <!--chargement du template lightbox.php  -->
  
    <?php get_template_part('templates_parts/lightbox'); ?>


</footer>
