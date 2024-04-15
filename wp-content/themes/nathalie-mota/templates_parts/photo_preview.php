<?php
        // Récupérer le titre de la photo
        $photo_titre = get_the_title();
        // Récupérer l'URL du post
        $post_url = get_permalink();
        // Récupérer la référence de la photo
        $reference = get_field('reference');
        // Récupérer les catégories de la photo
        $categories = get_the_terms(get_the_ID(), 'categorie');
        $categorie_name = $categories[0]->name; // On suppose qu'il y a au moins une catégorie
        ?>

        <div class="blockPhotoRelative">
            <?php echo get_the_post_thumbnail(); ?>

            <div class="overlay">

                <!-- Afficher le titre de la photo -->
                <h2><?php echo esc_html($photo_titre); ?></h2>

                <!-- Afficher le nom de la catégorie -->
                <h3><?php echo esc_html($categorie_name); ?></h3>

                <!-- Icône pour voir la photo en détail -->
                <div class="eye-icon">
                    <a href="<?php echo esc_url($post_url); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon_eye.svg" alt="voir la photo">
                    </a>
                </div>

                <!-- Vérifier si la référence est définie avant d'afficher l'icône fullscreen -->
                <?php if ($reference) : ?>
                    <div class="fullscreen-icon" data-full="<?php echo get_the_post_thumbnail_url() ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
                    </div>
                <?php endif; ?>

            </div>
        </div>
