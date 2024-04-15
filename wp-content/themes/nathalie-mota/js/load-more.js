/**
 *fonction qui permet de charger plus de photos
 * et de les afficher
 */

 jQuery(function ($) {
    // Fonction pour gérer le chargement du contenu additionnel
    function loadMoreContent() {
      //on recupere le numero de page actuelle depuis les données du bouton de chargement
      const page = $("#btnLoad-more").data("page");
  
      //calcul le numero de page a charger
      const newPage = page + 1;
  
      // recupere lurl de la page ajax a partir de son parametre ajax_url
      const ajaxurl = ajax_params.ajax_url;
  
      //effecture une requete ajax
      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          page: newPage,
          action: "load_more_photos",
        },
        success: function (response) {
          // Insérez la nouvelle charge dans le conteneur des photos
          $("#load-moreContainer").before(response);
  
          // Mettez à jour la valeur de la page dans les données du bouton de chargement
          $("#btnLoad-more").data("page", newPage);
        },
      });
    }
  
    // Utiliser la délégation d'événement sur un parent stable
    $(document).on("click", "#load-moreContainer #btnLoad-more", function () {
      loadMoreContent();
    });
  });
  