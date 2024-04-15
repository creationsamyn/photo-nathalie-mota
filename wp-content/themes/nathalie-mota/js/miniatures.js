// Attend que le document soit prêt avant d'exécuter le script
$(function () {
  // Sélectionne l'élément avec l'ID "miniPicture"
  const miniPicture = $("#miniPicture");

  // Associe des gestionnaires d'événements aux flèches gauche et droite lorsque la souris survole
  $(".arrow-left, .arrow-right").hover(
    // Fonction exécutée lorsque la souris survole les flèches
    function () {
      // Affiche une miniature avec un lien vers l'URL cible et une image de miniature
      miniPicture.css({
        visibility: "visible",
        opacity: 1,
      }).html(`<a href="${$(this).data("target-url")}">
                        <img src="${$(this).data("thumbnail-url")}" alt="${
        $(this).hasClass("arrow-left") ? "Photo précédente" : "Photo suivante"
      }">
                    </a>`);
    },
    // Fonction exécutée lorsque la souris cesse de survoler les flèches
    function () {
      // Masque la miniature en la rendant invisible
      miniPicture.css({
        visibility: "hidden",
        opacity: 0,
      });
    }
  );

  // Associe un gestionnaire d'événements de clic aux flèches gauche et droite
  $(".arrow-left, .arrow-right").click(function () {
    // Redirige l'utilisateur vers l'URL cible au clic sur une flèche
    window.location.href = $(this).data("target-url");
  });
});
