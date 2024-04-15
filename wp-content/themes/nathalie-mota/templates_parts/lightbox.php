<div class="containerLightbox">
  <!-- Conteneur principal de la lightbox -->
  <div id="lightbox" class="lightbox">
    <!-- Div pour le contenu de la lightbox -->
    <div class="lightbox-content">
      <!-- Section pour afficher la catégorie de la photo -->
      <span class="lightboxCategorie"></span>

      <!-- Section pour afficher la référence de la photo -->
      <span class="lightboxReference"></span>

      <!-- Bouton pour fermer la lightbox -->
      <img class="lightboxClose" src="<?= get_stylesheet_directory_uri() . '/assets/img/Cross_white.png'; ?>" alt="croix">

      <!-- Texte pour la navigation vers la photo précédente -->
      <span class="lightboxPrevious">&#8592; précédente</span>

      <!-- Div pour afficher la photo -->
      <div class="lightboxPhoto">
        <!-- Image de la photo -->
        <img class="lightboxImage" src="" alt="">
      </div>

      <!-- Texte pour la navigation vers la photo suivante -->
      <span class="lightboxNext">suivante &#8594;</span>
    </div>
  </div>
</div>
