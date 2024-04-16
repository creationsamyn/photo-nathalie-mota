<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css');
    wp_enqueue_script( 'js-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'),'1.0.0', true );
}
// Enregistrement - Menu Principal
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

// Enregistrement - Menu pied de page
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu du pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );



// Ajout des scripts personnalisés
function enqueue_custom_scripts()
{
    // Enqueue jQuery from CDN
    wp_enqueue_script('jquery-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);

    // Enqueue modale-contact.js
    wp_enqueue_script('modale-contact-script', get_template_directory_uri() . '/js/modale-contact.js', array('jquery'), '1.0.0', true);

    // Enqueue burger-menu.js
    wp_enqueue_script('menu-burger-script', get_template_directory_uri() . '/js/menu-burger.js', array('jquery'), '1.0.0', true);

    // Enqueue miniatures.js
    wp_enqueue_script('miniatures-script', get_template_directory_uri() . '/js/miniatures.js', array('jquery'), '1.0.0', true);

    // Enqueue lightbox.js
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0.0', true);

    // Enqueue filtre.js
    wp_enqueue_script('filtre-script', get_template_directory_uri() . '/js/filtre.js', array('jquery'), '1.0.0', true);

    // Bibliotheque Select2 pour les selects de tri
    wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
    wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array());

    //Enqueue custom-select.js
    wp_enqueue_script('custom-select-script', get_template_directory_uri() . '/js/custom-select.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Ajout du script load-more-photos.js et filtre.js avec wp_localize_script pour passer des paramètres AJAX
function enqueue_load_more_photos_script()
{
    wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/js/load-more.js', array('jquery'), null, true);

    wp_enqueue_script('filtre', get_template_directory_uri() . '/js/filtre.js', array('jquery'), null, true);

    // Utilisez wp_localize_script pour passer des paramètres à votre script
    wp_localize_script('load-more-photos', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    wp_localize_script('filtre', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_photos_script');

// Fonction pour charger plus de photos via AJAX
function load_more_photos()
{
    // Récupère le numéro de page à partir des données POST
    $page = $_POST['page'];

    // Arguments de la requête pour récupérer les photos
    $args = array(
        'post_type'      => 'photo',     // Type de publication : photo
        'posts_per_page' => -1,          // Nombre de photos par page (-1 pour toutes)
        'orderby'        => 'rand',      // Tri aléatoire
        'order'          => 'ASC',       // Ordre ascendant
        'paged'          => $page,       // Numéro de page
    );

    // Exécute la requête WP_Query avec les arguments
    $photo_block = new WP_Query($args);

    // Vérifie s'il y a des photos dans la requête
    if ($photo_block->have_posts()) :
        // Boucle à travers les photos
        while ($photo_block->have_posts()) :
            $photo_block->the_post();
            // Inclut la partie du modèle pour afficher un bloc de photo
            get_template_part('templates_parts/photo_preview', get_post_format());
        endwhile;

        // Réinitialise les données post
        wp_reset_postdata();
    else :
        // Aucune photo trouvée
        echo 'Aucune photo trouvée.';
    endif;

    // Termine l'exécution de la fonction
    die();
}

// Ajoute l'action AJAX pour les utilisateurs connectés
add_action('wp_ajax_load_more_photos', 'load_more_photos');
// Ajoute l'action AJAX pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

// Fonction pour filtrer les photos via AJAX
function filter_photos()
{
    // Vérifiez si l'action est définie
    if (isset($_POST['action']) && $_POST['action'] == 'filter_photos') {
        // Récupérez les filtres et nettoyez-les
        $filter = array_map('sanitize_text_field', $_POST['filter']);

        // Ajoutez des messages de débogage pour voir les valeurs reçues
        error_log('Filter values: ' . print_r($filter, true));

        // Construisez votre requête WP_Query avec les filtres
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => -1,
            'orderby'        => 'rand',
            'order'          => 'ASC',
            'tax_query'      => array(
                'relation' => 'AND',
            ),
        );

        // Ajoutez la taxonomie pour la catégorie si elle est spécifiée
        if (!empty($filter['category'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $filter['category'],
            );
        }

        // Ajoutez la taxonomie pour l'année si elle est spécifiée
        if (!empty($filter['years'])) {
            $args['order'] = ($filter['years'] == 'date_desc') ? 'DESC' : 'ASC';
        }

        // Ajoutez la taxonomie pour le format si elle est spécifiée
        if (!empty($filter['format'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $filter['format'],
            );
        }

        // Effectuez la requête WP_Query
        $query = new WP_Query($args);

        // Vérifiez si la requête a réussi
        if ($query->have_posts()) {
            // Boucle à travers les résultats de la requête
            while ($query->have_posts()) :
                $query->the_post();
                // Récupérez et affichez les informations de chaque photo
                $photoId      = get_post_thumbnail_id();
                $reference    = get_field('reference');
                $refUppercase = strtoupper($reference);

                // Ajoutez des messages de débogage pour les champs ACF
                error_log('Photo ID: ' . $photoId);
                error_log('Reference: ' . $reference);

                // Affiche le bloc de photo
                get_template_part('templates_parts/photo_preview');
            endwhile;

            // Réinitialisez les données de requête après la boucle de requête
            wp_reset_query();
        } else {
            // Aucune photo ne correspond aux critères de filtrage
            echo '<p class="critereFiltrage">Aucune photo ne correspond aux critères de filtrage</p>';
        }
    }

    // Assurez-vous que votre code renvoie la sortie souhaitée pour le traitement AJAX
    die();
}

// Hook pour les utilisateurs connectés
add_action('wp_ajax_filter_photos', 'filter_photos');
// Hook pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
