<?php 
ini_set("display_errors", 1);
require_once(__DIR__."/config.php");
require_once(__DIR__."/include/header.php");
require_once(__DIR__."/api/bdd.php");

// Fonction affichant la page d'admin
function display_admin()
{
  // On lance la connexion avec la bdd
  $bdd = new BDD($_ENV["BDD_SERVER"], $_ENV["BDD_USER_NAME"], $_ENV["BDD_PASSWORD"], $_ENV["BDD_NAME"]);

  // TO DO : Ajouter la possibilité d'ajouter un article depuis le site
  echo "<a href=''>Ajouter un article</a>";

  // On affiche les articles dans un tableau
  echo "<table>";
    echo "<thead>";
      echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Insertion date</th>";
        echo "<th>Modification date</th>";
        echo "<th>Actif</th>";
        echo "<th>Modify</th>";
        echo "<th>Delete</th>";
      echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
      $articles = $bdd->get("article");
      foreach ($articles as $article)
      {
        echo "<tr>";
          echo "<th>".$article["title"]."</th>";
          echo "<th>".$article["date_insert"]."</th>";
          echo "<th>".$article["date_modif"]."</th>";

          // TO DO : ajouter la couleur verte et rouge du bouton
          echo "<th><input type='button' class='".($article["actif"] == 1 ? "green_btn" : "red_btn")."' onclick='set_actif(".$article["id_article"].")' action='submit' value=''/></th>";

          // TO DO : ajouter la fonctionnalité de modification d'un article
          echo "<th></th>";

          // TO DO : ajouter l'image ./image/trash_can.png comme assets du bouton
          echo "<th><input type='button' class='delete_btn' onclick='".$article["id_article"]."' action='submit' value=''/></th>";
        echo "</tr>";
      }
    echo "</tbody>";
  echo "</table>";
}

// Fonction renvoyant vers la page de connexion si on est pas connecté
function go_to_log_in()
{
  echo "<p>You need to <a href='./login.php'>log in</a> before accessing this page</p>";
}
?>

<main>
<?php
// On est connecté, on affiche la page d'admin
if (isset($_COOKIE["connecter"])) { display_admin(); }
// Sinon, on demande de se connecter
else { go_to_log_in(); }
?>
</main>

<?php require_once(__DIR__."/include/footer.php"); ?>
