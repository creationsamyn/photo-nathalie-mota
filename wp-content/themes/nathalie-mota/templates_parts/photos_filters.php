<section class="filtre">

<?php
// Affichage des taxonomies
$taxonomy = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annees' => 'TRIER PAR',
];

// Début du conteneur #filtrePhoto
echo "<div id='filtrePhoto'>";

// Section gauche
echo "<div class='left-section'>";

foreach ($taxonomy as $taxonomy_slug => $label) {
    // Exclure 'annees' de la section gauche
    if ($taxonomy_slug !== 'annees') {
        // Récupérer les termes de la taxonomie
        $terms = get_terms($taxonomy_slug);

        // Vérifier si des termes existent et qu'il n'y a pas d'erreur WordPress
        if ($terms && !is_wp_error($terms)) {
            // Ajouter une classe CSS spécifique pour chaque select
            $select_class = 'custom-select ' . $taxonomy_slug . '-select';

            // Début du conteneur pour la taxonomie
            echo "<div class='taxonomy-container'>";
            // Afficher le select avec l'ID et la classe appropriés
            echo "<select id='$taxonomy_slug' class='$select_class'>";
            // Option par défaut avec le label de la taxonomie
            echo "<option value=''>$label</option>";

            // Afficher chaque terme comme une option
            foreach ($terms as $term) {
                echo "<option value='$term->slug'>$term->name</option>";
            }

            // Fin du select et du conteneur pour la taxonomie
            echo "</select>";
            echo "</div>";
        }
    }
}

// Fin de la section gauche
echo "</div>";

// Section droite
echo "<div class='right-section'>";
// Classe CSS spécifique pour la taxonomie 'annees'
$select_class_annees = 'custom-select annees-select';
// Début du conteneur pour la taxonomie 'annees'
echo "<div class='taxonomy-container'>";
// Afficher le select avec l'ID et la classe appropriés
echo "<select id='annees' class='$select_class_annees'>";
// Option par défaut avec le label de la taxonomie 'annees'
echo "<option value=''>{$taxonomy['annees']}</option>";
// Options spécifiques pour 'annees'
echo "<option value='date_asc'>A partir des plus récentes</option>";
echo "<option value='date_desc'>A partir des plus anciennes</option>";
// Fin du select et du conteneur pour la taxonomie 'annees'
echo "</select>";
echo "</div>";

// Fin de la section droite
echo "</div>";

// Fin du conteneur #filtrePhoto
echo "</div>";
?>

</section>