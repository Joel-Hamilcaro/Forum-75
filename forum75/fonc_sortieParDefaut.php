<?php
////// AFFICHAGE DE LA STRUCTURE HTML

// Header : En tête (toujours)

function tete_de_page(){
  echo
'
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href=style1.css>
      <title>Forum 75</title>
  </head>

  <body>
      <header>

        <h1>
' ; echo '<img src="logo75.png" alt="Forum 75" width="50%">' ;
echo '</h1>
        <p> ' ; require_once('fonc_date.php');
afficher_date() ;
if (isset($_SESSION["user"])){ echo "<br><a class='deconect' href='index.php?action=deconnexion''>Deconnexion</a><br>" ;}
echo ' </p>
      </header>
      '
 ;
}

// Nav : Menu (toujours)

function menu(){
if (isset($_SESSION["admin"])){
  if ($_SESSION["admin"]==true){
    $menu =
    '
    <td class="admin">
      <a class="admin" href="index.php?action=signalement" class="admin">Signalements</a></li>
    </td>
    ';
  } else $menu="" ;
} else $menu="" ;
echo
  '
<nav>
  <table class="menu">
      <tr>
        <td class="menu">
          <a href="index.php" class="menu">Accueil</a></li>
        </td>
        <td class="menu">
          <a href="index.php?action=poser" class="menu">Poser une question</a></li>
        </td>
        <td class="menu">
          <a href="index.php?action=poster" class="menu">Rediger un article</a></li>
        </td>
        <td class="menu">
          <a href="index.php?action=repondre" class="menu">Forum</a></li>
        </td>
        <td class="menu">
          <a href="index.php?action=article" class="menu">Articles</a></li>
        </td>
        <td class="menu">
          <a href="index.php?action=profil" class="menu">Modifier votre profil</a></li>
        </td>'.$menu.'
      </tr>
  </table>
</nav>
<div>
  '
;
}

// Section : Page d'acceuil (défaut)

function accueil(){
  if (!isset($_SESSION["user"])){ $login = "" ; $section=""; $aside=""; }
  else  {
    $login=$_SESSION["user"]; $section=" class='full'"; $aside=" class='zero'" ;
  }
  if (!isset($_SESSION["admin"])){ $admin = "" ; }
  else {
    $admin=" (<admin><em> Session administrateur </em></admin>)";

  }

    echo'
      <section'.$section.'>
      <strong>Bienvenue '.$login.' ! '.$admin.'</strong>
      ';
    require_once('fonc_afficherTout.php'); afficher_best_article();
    require_once('fonc_afficherTout.php'); afficher_dernier_article();
    echo'</section><aside'.$aside.'>';
}

// Aside : Affichage du formulaire de connexion (défaut)

function connexionFormulaire(){

if (!isset($_SESSION["user"])){
  require_once('fonc_afficherFormulaire.php');
  page_login(); } // Fonction III.1
}

// Footer : Pied de page (toujours)

function pied_de_page(){
  echo
'</aside>
</div>
  <footer>
     <p><contacts> Contacts : Projet IO2 2018 : Groupe 75 </contacts></p>
  </footer>
</body>
</html>
  ';
}




?>
