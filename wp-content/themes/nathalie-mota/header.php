<?php
/**
 * The header
 *
 * @package WordPress
 * @subpackage nathalie-mota
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Site Photographe Freelance">
    <meta name="keywords" content="Photo Event">
    <meta name="author" content="Efrain samyn">
	<meta name="keywords" content="photographe événementiel, photographe event, nathalie mota, photo format hd"/>
	<meta name="description" content="Nathalie Mota - Site personnel pour la vente de mes photos en impression HD.">
    <title>Nathalie Mota - Photographe Freelance</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>	
    <header class="header-area">
    <!-- site-navbar start -->
    <div class="navbar-area">
        <div class="container">
        <nav class="site-navbar">
        <div class="site-logo">
            <a href="<?php echo home_url( '/' ); ?>" aria-label="Page d'accueil de Nathalie Mota">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_nathalie_mota.png" 
                alt="Logo <?php echo bloginfo('name'); ?>">
            </a>
        </div>
            <!-- site menu/nav -->
        
            <?php 
                // Mostrar menú principal
                wp_nav_menu(array('theme_location' => 'main-menu')); 
            ?>
            <!-- nav-toggler for mobile version only -->
            <button class="nav-toggler">
            <span></span>
            </button>
        </nav>
        </div>
    </div><!-- navbar-area end -->
    </header>





