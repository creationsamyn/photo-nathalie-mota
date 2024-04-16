// Attend que le document soit prêt avant d'appliquer les fonctionnalités
$(function () {
  // Initialise le plugin Select2 sur les éléments avec la classe ".custom-select"
  $(".custom-select").select2({
    // Définit la position du menu déroulant en dessous
    dropdownPosition: "below",
  });
});
