jQuery(document).ready(function ($) {
    $("#categorie, #format, #annees").on("change", function () {
      // Capturer les valeurs des filtres
      const category = $("#categorie").val();
      const format = $("#format").val();
      const years = $("#annees").val();
      console.log(category);
      // Vérifier si les valeurs sont les valeurs par défaut
      const isDefaultValues = category === "" && format === "" && years === "";
  
      $.ajax({
        url: ajax_params.ajax_url,
        type: "post",
        data: {
          action: "filter_photos",
          filter: {
            category: category,
            format: format,
            years: years,
          },
        },
        success: function (response) {
          // Mettez à jour la section des photos avec les résultats filtrés
          $("#containerPhoto").html(response);
        },
        //permet d'afficher les erreurs
        error: function (xhr, ajaxOptions, thrownError) {          
          console.log(xhr.status);
          console.log(thrownError);
          console.log(ajaxOptions);
          console.log(xhr.responseText);
        },
        complete: function () {
          // Si les valeurs sont les valeurs par défaut, relancer le conteneur photo
          if (isDefaultValues) {
            // Mettez à jour la section des photos avec le contenu par défaut
            $("#containerPhoto").load(window.location.href + " #containerPhoto");
          }
        },
      });
    });
  });
  