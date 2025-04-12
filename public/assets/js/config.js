(function () {
  var primary = localStorage.getItem("primary") || "#648FFF";
  var secondary = localStorage.getItem("secondary") || "#838383";

  window.CubaAdminConfig = {
    // Theme Primary Color
    primary: primary,
    // theme secondary color
    secondary: secondary,
  };
})();
