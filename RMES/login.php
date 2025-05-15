<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(__DIR__."/config.php");
require_once(__DIR__."/include/header.php");

function goToURL($url){
  header("Location: ".$url);
  // Si le pb avec le header (déjà envoyé, ...)
  die("<script>location.href='$url'</script>");
}

function handlePost($postData){
  $data = ["identifiant" => $postData["login"], "mot_de_passe" => hash($_ENV["HASH_KEY"], $postData["password"])];
  $data = json_encode($data);
  $data = urlencode($data);

  // On interroge l'api pour savoir si on est connecté
  $reponse = file_get_contents("http://".$_ENV["SERVER"]."api/login?token=".$data);

  if ($reponse === FALSE) 
  {
    error_log("Erreur lors de l'accès à l'API pour la connexion au site : " . error_get_last()['message']);
    echo "<p class='red'>Erreur lors de l'accès à l'API.</p>";
    return; // on sort de la fonction
  }

  $reponse = json_decode($reponse, true);
  
  if (json_last_error() !== JSON_ERROR_NONE) 
  {
    echo "<p class='red'>Erreur lors du décodage de la réponse JSON.</p>";
    return;
  }

    // Si la réponse est favorable, on renvoi vers la page admin
  if ($reponse["connecter"] === true) 
  { 
    setcookie("token", json_encode(["id" => $reponse["id"], "identifiant" => $postData["login"]]), time() + 1200);
    setcookie("connecter", true, time() + 1200);
    goToURL("admin.php");
    exit;
  }
  else { echo "<p class='red'>".$reponse["error"]."</p>"; }
}





// Si l'utilisateur est déjà connecté on redirige
if (isset($_COOKIE["connecter"])) {
  goToURL("admin.php");
  exit;
}


// Si le formulaire est envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST["login"]) && isset($_POST["password"])) handlePost($_POST);

} else{
  // Sinon on affiche le formulaire de connexion
  if (isset($_COOKIE['connecter']) && !$_COOKIE["connecter"]) {echo "<p class='red'>Incorrect login or password</p>";}
  require_once(__DIR__."/templates/login.html");
}

require_once(__DIR__."/include/footer.php");