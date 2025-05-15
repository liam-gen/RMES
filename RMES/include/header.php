<?php
// Accès à l'environnement de travail
require_once realpath(__DIR__."/../vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?= $CONFIG["name"] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dependencies -->

    <link href="/assets/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/winbox@0.2.82/dist/css/winbox.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/winbox@0.2.82/dist/winbox.bundle.min.js"></script>
  

    <!-- SEO -->

    <meta name="title" content="School without frontiers">
    <meta name="description" content="Our aim is to provide a cultural exchange between any school in the world.">
    <meta name="keywords" content="school, réaumur, reaumur, lycee, lycée, laval, sydney, nepal, world, frontiers, world, school without frontiers, ">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name='url' content='https://noschool-frontieres.org'>

    <meta name='og:title' content='School without frontiers'>
    <meta name='og:type' content='website'>
    <meta name='og:url' content='https://noschool-frontieres.org'>
    <meta name='og:site_name' content='School without frontiers'>
    <meta name='og:description' content="Our aim is to provide a cultural exchange between any school in the world.">

    <link rel="canonial" href="https://noschool-frontieres.org">

  </head>
  <body>
  <!-- Analytics (todo: cookies) -->
  <script>
    var _paq = window._paq = window._paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u="https://analytics.liamcharpentier.fr/";
      _paq.push(['setTrackerUrl', u+'matomo.php']);
      _paq.push(['setSiteId', '2']);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>


    <?php
    // Vérifier que la config est chargée
    if(!isset($CONFIG)){
      echo "Le fichier config.php doit être inclus dans votre fichier php.";
      exit;
    }
    ?>
    <p id="warn_construction">Our website is still under construction</p>
    <header>
      <h1><?= $CONFIG["name"] ?></h1>
      <nav>
        <ul>
          <?php
          /* Récupérer le menu depuis la config */
          foreach($CONFIG["menu"] as $menuItem){
            echo "<li><a ".(array_key_exists("className", $menuItem) ? "class='{$menuItem["className"]}'":  "")." href='{$menuItem["href"]}'>{$menuItem["title"]}</a></li>";
          }
          ?>
        </ul>
        <a href="https://github.com/NoePoirier5327/RMES" target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
          </svg>
        </a>
      </nav>
      
    </header>
