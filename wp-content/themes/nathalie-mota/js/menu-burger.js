// Attend que le document soit prêt avant d'exécuter le code jQuery
$(function () {
  // Sélectionne les éléments du DOM
  const header = $("header");
  const menuBurger = $(".burgerMenu");
  const nav = $(".nav-links-container");
  const menuLinks = $(".header-menu li a");

  // Ajoute un gestionnaire d'événement au clic sur l'icône du menu burger
  menuBurger.on("click", function () {
    // Vérifie si la classe "open" est présente dans l'élément header
    const isOpen = header.hasClass("open");

    // Bascule la classe "open" sur les éléments en fonction de leur état actuel
    header.toggleClass("open", !isOpen);
    menuBurger.toggleClass("open", !isOpen);
    nav.toggleClass("open", !isOpen);

    // Bloque ou réactive le défilement du corps en fonction de l'état du menu
    if (!isOpen) {
      $("body").css("overflow", "hidden");
    } else {
      $("body").css("overflow", "auto");
    }
  });

  // Ajoute un gestionnaire d'événement pour la fermeture du menu au clic sur un lien
  menuLinks.on("click", function () {
    // Ferme le menu
    header.removeClass("open");
    menuBurger.removeClass("open");
    nav.removeClass("open");

    // Réactive le défilement du corps
    $("body").css("overflow", "auto");
  });
});
