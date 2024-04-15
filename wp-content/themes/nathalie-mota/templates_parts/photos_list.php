<?php

//recuperer les photos, dans la limite de 12 par page (par chargement)

get_template_part( 'templates_parts/photos_filters' );
?>
<section id="containerPhoto" class="blocCatalogue">

<?php
//recuperer les photos

$args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 8,
    'orderby'        => 'rand',
    'order'          => 'ASC',
);
$photo_block = new WP_Query($args);

// Vérification s'il y a des photos
if ($photo_block->have_posts()) :

    // Définir les arguments pour le bloc photo
    set_query_var('photo_block_args', array('context' => 'front-page'));

//boucle a mettre en place pour les afficher 1 a 1
    while ($photo_block->have_posts()) :
        $photo_block->the_post();
        get_template_part( 'templates_parts/photo_preview' );
    endwhile;

    // Réinitialisation de la requête
    wp_reset_postdata();
else :
    echo 'Aucune photo trouvée.';
endif;
?>

<!-- Bloc pour le chargement de plus de photos -->
<div id="load-moreContainer">
    <button id="btnLoad-more" data-page="1" data-url="">Charger plus</button>
</div>

</section>
