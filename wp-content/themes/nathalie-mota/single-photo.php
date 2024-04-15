<?php get_header(); ?>

<?php
// Récupération des champs ACF personnalisés pour l'article actuel
$photoUrl = get_the_post_thumbnail_url();
$reference = get_field('reference');
$refUppercase = strtoupper($reference); // Conversion de la référence en majuscules
$type = get_field('type');

// Récupération des termes de la taxonomie 'annee' associés à l'article
$annees_terms = get_the_terms(get_the_ID(), 'annee');
// Vérification de l'existence des termes et non-vide
if ($annees_terms && !is_wp_error($annees_terms)) {
  // Prendre le premier terme, car un article peut avoir plusieurs termes
  $annee = $annees_terms[0]->name;
} else {
  // Définition d'une valeur par défaut si aucun terme n'est trouvé
  $annee = 'Non défini';
}

// Récupération des termes de la taxonomie 'categorie' et 'format'
$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$FORMATS = $formats ? ucwords($formats[0]->name) : '';

// Définissez les URLs des vignettes pour le post précédent et suivant
$nextPost = get_next_post();
$previousPost = get_previous_post();
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';
?>

<!-- Section d'affichage de la photo et des informations associées -->
<section class="cataloguePhotos">
  <div class="galleryPhotos">
    <div class="detailPhoto">
      <div class="containerPhoto">
        <!-- Affichage de l'image de la photo -->
        <img src="<?php echo $photoUrl; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
      </div>

      <div class="photo-info">
        <div class="photo-title">
          <h2><?php echo get_the_title(); ?></h2>
        </div>
        <div class="taxo-details">
          <p>RÉFÉRENCES: <?php echo esc_html($refUppercase); ?></p>
          <p>CATÉGORIE: <?php echo esc_html($categories ? $categories[0]->name : 'Non défini'); ?></p>
          <p>FORMAT: <?php echo esc_html($FORMATS); ?></p>
          <p>TYPE: <?php echo esc_html($type); ?></p>
          <p>ANNÉE: <?php echo esc_html($annee); ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Section de contact et navigation entre les photos -->
  <div class="contenairContact">
    <div class="contact">
      <p class="interesser">Cette photo vous intéresse ?</p>
      <!-- Bouton de contact avec la référence comme attribut de données -->
      <button id="boutonContact" data-reference="<?php echo esc_attr($reference); ?>">Contact</button>
    </div>

    <div class="naviguationPhotos">

      <!-- Conteneur pour la miniature -->
      <div class="miniPicture" id="miniPicture">
        <!-- La miniature sera chargée ici par JavaScript -->
      </div>

      <div class="naviguationArrow">
        <?php if (!empty($previousPost)) : ?>
          <img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/img/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previousThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
        <?php endif; ?>

        <?php if (!empty($nextPost)) : ?>
          <img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/img/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $nextThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<section class="similars">
  <div class="titleSugest">
    <h3>VOUS AIMEREZ AUSSI</h3>
  </div>
  <div class="similar_photo">
    <?php
    // Récupération des catégories de la photo principale
    $categories = get_the_terms(get_the_ID(), 'categorie');
    // Arguments de la requête pour récupérer les photos similaires
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 2,
      'post__not_in' => array(get_the_ID()),
      'tax_query' => array(
        array(
          'taxonomy' => 'categorie',
          'field' => 'id',
          'terms' => $categories ? wp_list_pluck($categories, 'term_id') : array(),
        ),
      ),
    );
    // Exécution de la requête WP_Query avec les arguments définis
    $query = new WP_Query($args);
    // Boucle à travers les photos similaires
    while ($query->have_posts()) :
      $query->the_post();
      // Récupération de l'ID de la photo et de la référence
      $photoUrl = get_the_post_thumbnail_url();
      $reference = get_field('reference');
      $refUppercase = strtoupper($reference);
      // Affiche le bloc de photo en utilisant un template part (partie de modèle)
      get_template_part('templates_parts/photo_preview');
    endwhile;
    // Affiche un message si aucune photo similaire n'est trouvée
    if (!$query->have_posts()) :
      echo '<p class="photoNotFound">Pas de photo similaire trouvée pour la catégorie.</p>';
    endif;
    // Réinitialisation des données de post après la boucle de requête
    wp_reset_postdata();
    ?>
  </div>
</section>
<?php get_footer(); ?>
