<?php // BEGIN PHP
$websitekey=basename(__DIR__);
if (! defined('USEDOLIBARRSERVER') && ! defined('USEDOLIBARREDITOR')) { require_once __DIR__.'/master.inc.php'; } // Load env if not already loaded
require_once DOL_DOCUMENT_ROOT.'/core/lib/website.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/website.inc.php';
ob_start();
if (! headers_sent()) {	/* because file is included inline when in edit mode and we don't want warning */ 
header('Cache-Control: max-age=3600, public, must-revalidate');
header('Content-type: text/css');
}
// END PHP ?>
/* CSS content (all pages) */
body.bodywebsite { margin: 0; font-family: 'Open Sans', sans-serif; }
.bodywebsite h1 { margin-top: 0; margin-bottom: 0; padding: 10px;}
body {
  font-family: 'Arial', sans-serif;
  margin: 0; /* Supprimer les marges par défaut du body */
  padding-left: 20px;
  padding-right: 20px;
  margin-left: auto;  /* Centrer le contenu */
  margin-right: auto; /* Centrer le contenu */
}

/* Animation pour les liens */
@keyframes slide-up {
  0% {
    transform: translateY(20px);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Animation personnalisée sur les liens */
.anim-scroll {
  animation: slide-up 1s ease-out;
}

/* Effet de survol sur les cartes */
a:hover {
  transform: scale(1.05);
  transition: transform 0.3s ease;
}

/* Pagination - Style des boutons */
.pagination-btn {
  padding: 10px 20px;
  background-color: #38a169;
  color: white;
  border-radius: 5px;
  text-decoration: none;
}

.pagination-btn:hover {
  background-color: #2f855a;
}

/* Pagination texte */
.pagination-text {
  padding: 10px 20px;
  background-color: #f0f0f0;
  color: #2d3748;
  border-radius: 5px;
  font-weight: bold;
}

/* Centrer le logo dans l'en-tête */
.site-logo {
  text-align: center;
}

.entry-logo {
  margin: 0 auto; /* Assurer un centrage si l'image est en bloc */
}

/* Limiter la largeur maximale du contenu principal */
.container {
  max-width: 1200px !important; /* Ajustez cette valeur à la largeur souhaitée */
  margin: 0 auto !important; /* Centrer le contenu horizontalement */
}

/* Ajout de marges à gauche et à droite pour les éléments comme le logo */
.site-header {
  margin-bottom: 20px;
  padding: 20px; /* Espacement autour du contenu du header */
  border-bottom: 3px solid #6ec1e4;
  display: block;
  width: 100%; /* La largeur de l'élément site-header */
  max-width: 1200px; /* Limite la largeur du header pour correspondre à la largeur du contenu */
  margin-left: auto; /* Centrer le header */
  margin-right: auto; /* Centrer le header */
}

/* Titre <h2> centré avec marges en haut et en bas */
h2 {
  text-align: center;
  margin-top: 30px !important; /* Marge pour séparer du logo */
  margin-bottom: 40px !important; /* Marge pour séparer des liens */
  font-size: 1.5rem !important;
  font-weight: bold !important;
  padding-left: 20px;
  padding-right: 20px;
}

/*couleur des textes dans les grides*/
.text-green-600 {
  color: #100ab2 !important;
}

/*fond des vignettes*/
.bg-green-500 {
  background-color: #ffffff91 !important;
}
.bg-green-500:hover {
  background-color: #6ec1e4 !important; /* Remplacez #6ec1e4 par la couleur de votre choix */
}
<?php // BEGIN PHP
$tmp = ob_get_contents(); ob_end_clean(); dolWebsiteOutput($tmp, "css");
// END PHP
