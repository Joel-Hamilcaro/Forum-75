<?php
require_once('fonc_afficherUn.php');
function afficherToutQuestion(){
  echo "<section>";
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  $requete = $connexion->query('SELECT * FROM questions ORDER BY id DESC'); //execute et retourne un objet des resultats de la requete SQL (natif PHP >=5.1.0)
  //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
  while ($question = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
    afficherUneQuestion($question['id'],$question['anonyme'],$question['sujet'],$question['titre'],$question['question'],$question['pseudo'],$question['creation']); //Fonction IV.1
  }
  echo "</section><aside class='messages'>";
}

function afficherToutReponse($id_question){
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  //$requete = $connexion->query('SELECT * FROM reponses WHERE id_question='.$id_question.' && best=1 '); //execute et retourne un objet des resultats de la requete SQL (natif PHP >=5.1.0)
  //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
  //while ($table = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
  //  afficherUneReponse($table['id'], $table['anonyme'], $table['id_question'],$table['reponse'],$table['pseudo'],$table['creation']); // Fonction IV.3
  //}
  $requete = $connexion->query('SELECT * FROM reponses WHERE id_question='.$id_question.' ORDER BY id ASC'); //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
  while ($table = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
    afficherUneReponse($table['id'], $table['anonyme'], $table['id_question'],$table['reponse'],$table['pseudo'],$table['creation']); // Fonction IV.3
  }
}
function afficherToutArticle(){
  echo "<section>";
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  $requete = $connexion->query('SELECT * FROM articles ORDER BY id DESC');
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    $likes =  lineRequete('SELECT * FROM likes WHERE id_article='.$article["id"].'');
    afficherUnArticle($article['id'],$article['titre'],$article['texte'],$article['creation'],$article['modification'],$article['pseudo'],$article['anonyme'],$likes);
  }
  echo "</section><aside class='messages'>";
}
function afficherToutCommentaires($id_article){
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  $requete = $connexion->query('SELECT * FROM commentaires WHERE id_article='.$id_article.' ORDER BY id ASC'); //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
  while ($table = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
    afficherUnCommentaire($table['id'], $table['anonyme'], $table['id_article'],$table['commentaire'],$table['pseudo'],$table['creation']); // Fonction IV.3
  }
}
function afficherToutSignalement(){
  echo '<h2> Liste des post signalés </h2>';
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  echo '<articles> <h3> Articles </h3>';
  $requete = $connexion->query('SELECT * FROM articles WHERE signale=TRUE ORDER BY id DESC');
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    $likes =  lineRequete('SELECT * FROM likes WHERE id_article='.$article["id"].'');
    afficherUnArticle($article['id'],$article['titre'],$article['texte'],$article['creation'],$article['modification'],$article['pseudo'],$article['anonyme'],$likes);
  }
  echo '</articles><hr> <topics> <h3> Sujets </h3>';
  $requete = $connexion->query('SELECT * FROM questions WHERE signale=TRUE ORDER BY id DESC'); //execute et retourne un objet des resultats de la requete SQL (natif PHP >=5.1.0)
  //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
  while ($question = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
    afficherUneQuestion($question['id'],$question['anonyme'],$question['sujet'],$question['titre'],$question['question'],$question['pseudo'],$question['creation']); //Fonction IV.1
  }
  echo '</topics><hr> <messages> <h3> Messages </h3>';
  $requete = $connexion->query('SELECT * FROM commentaires WHERE signale=TRUE ORDER BY id DESC');
  while ($table = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
    afficherUnCommentaire($table['id'], $table['anonyme'], $table['id_article'],$table['commentaire'],$table['pseudo'],$table['creation']); // Fonction IV.3
  }
  $requete = $connexion->query('SELECT * FROM reponses WHERE signale=TRUE ORDER BY id DESC'); //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
  while ($table = $requete->fetch_array(MYSQLI_ASSOC)){ //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
    afficherUneReponse($table['id'], $table['anonyme'], $table['id_question'],$table['reponse'],$table['pseudo'],$table['creation']); // Fonction IV.3
  }
  echo '</messages><hr>' ;
}

function afficherUneQuestionEtSesReponses($id,$anonyme,$sujet,$titre,$question,$pseudo, $creation){
  echo "<section>";
  afficherUneQuestion($id,$anonyme,$sujet,$titre,$question,$pseudo, $creation); //Fonction IV.1
  afficherToutReponse($id); // Fonction IV.5
  echo "</section><aside class='messages'>";
  repondre($id); //Fonction II.4
}

function afficherUnArticleEtSesCommentaires($id_article,$anonyme,$titre,$texte,$creation, $modification, $pseudo){
  echo "<section>";
  require_once('fonc_bdd.php'); // Contient lineRequete()
  $likes =  lineRequete('SELECT * FROM likes WHERE id_article='.$id_article.'');
  afficherUnArticle($id_article,$titre,$texte,$creation,$modification, $pseudo, $anonyme, $likes); //Fonction IV.7
  afficherToutCommentaires($id_article);
  echo "</section><aside>";
  commenter($id_article); //Fonction II.4
}

function afficher_best_article(){
  echo '<h3> Article le plus apprécié </h3>';
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  $x = 0;
  $y = 1;
  $requete = $connexion->query('SELECT * FROM articles');
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    $likes =  lineRequete('SELECT * FROM likes WHERE id_article='.$article["id"].'');
    if ($x<=$likes){
      $x = $likes;
      $y = $article["id"];
    }
  }
  $requete = $connexion->query('SELECT * FROM articles WHERE id='.$y);
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    afficherUnArticle($article['id'],$article['titre'],$article['texte'],$article['creation'],$article['modification'],$article['pseudo'],$article['anonyme'],$x);
  }
  echo "<hr>";
}

function afficher_dernier_article(){
  echo '<h3> Article le plus récent </h3>';
  require_once('fonc_bdd.php'); // Contient connexionBDD()
  $connexion = connexionBDD(); // Connexion à la base de donnée
  $x = 0;
  $y = 1;
  $requete = $connexion->query('SELECT * FROM articles');
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    $likes =  lineRequete('SELECT * FROM likes WHERE id_article='.$article["id"].'');
    $x = $likes;
    $y = $article["id"];
  }
  $requete = $connexion->query('SELECT * FROM articles WHERE id='.$y);
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    afficherUnArticle($article['id'],$article['titre'],$article['texte'],$article['creation'],$article['modification'],$article['pseudo'],$article['anonyme'],$x);
  }
  echo "<hr>";
}

function voirRéponses(){

  if ( !isset($_GET['action']) ||!isset($_GET['id_question']) ) return;
  if ($_GET['action']!="reponses") return;
    require_once('fonc_bdd.php'); // Contient connexionBDD()
    $connexion = connexionBDD(); // Connexion à la base de donnée
    $requete = $connexion->query('SELECT * FROM questions WHERE id='.$_GET['id_question'].''); //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
    while ($question = $requete->fetch_array(MYSQLI_ASSOC)){  //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
      afficherUneQuestionEtSesReponses($question['id'],$question['anonyme'],$question['sujet'],$question['titre'],$question['question'],$question['pseudo'],$question['creation']); //Fonction IV.4
    }
}

function voirCommentaires(){
  if ( !isset($_GET['action']) || !isset($_GET['id_article']) ) return;
  if ($_GET['action']!="commentaires"){ return; }
    require_once('fonc_bdd.php'); // Contient connexionBDD() et lineRequete()
    $connexion = connexionBDD(); // Connexion à la base de donnée
    $requete = $connexion->query('SELECT * FROM articles WHERE id='.$_GET['id_article'].''); //ORDER BY id DESC pour ordre inverse des id - remplacer DESC par ASC pour ordre croissant.
    while ($article = $requete->fetch_array(MYSQLI_ASSOC)){  //retourne la ligne suivante des resultats de la requete SQL (natif PHP >=5.1.0)
      afficherUnArticleEtSesCommentaires($article['id'],$article['anonyme'],$article['titre'],$article['texte'],$article['creation'],$article['modification'],$article['pseudo']); //Fonction IV.10
    }
}


function voirSignalements(){
  echo "<section class=full>";
  $refuser = "Désolé, cette page est réservée au administrateurs." ;
  if (!isset($_SESSION["admin"])){ echo $refuser ; return ; }
  if ($_SESSION["admin"]!=true){ echo $refuser ; return ; }
  else {
    afficherToutSignalement();
  }
  echo "</section><aside class='zero'>";
}

 ?>
