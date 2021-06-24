<?php

  function signalerArticle(){
    if (!isset($_POST["signaler"])) { return ; }
    require_once('fonc_bdd.php'); // contient connexionBDD()
    $connexion = connexionBDD();
    if (!$connexion){ return; }
    $id = $_POST["id"];
    $requete = 'UPDATE articles SET signale=TRUE WHERE id='.$id.';' ;
    $enregistrement = mysqli_query($connexion,$requete);
    if (!$enregistrement){ echo mysqli_error($connexion)."<br>"; return ; }
    header('Location: index.php?action=commentaires&id_article='.$id);
    return ;
  }

  function signalerCommentaire(){
    if (!isset($_POST["signaler"])) { return ; }
    require_once('fonc_bdd.php'); // contient connexionBDD()
    $connexion = connexionBDD();
    if (!$connexion){ return; }
    $id = $_POST["id"];
    $id_article = $_POST["id_article"];
    $requete = 'UPDATE commentaires SET signale=TRUE WHERE id='.$id.';' ;
    $enregistrement = mysqli_query($connexion,$requete);
    if (!$enregistrement){ echo mysqli_error($connexion)."<br>"; return ; }
    header('Location: index.php?action=commentaires&id_article='.$id_article);
    return ;
  }

  function signalerQuestion(){
    if (!isset($_POST["signaler"])) { return ; }
    require_once('fonc_bdd.php'); // contient connexionBDD()
    $connexion = connexionBDD();
    if (!$connexion){ return; }
    $id = $_POST["id"];
    $requete = 'UPDATE questions SET signale=TRUE WHERE id='.$id.';' ;
    $enregistrement = mysqli_query($connexion,$requete);
    if (!$enregistrement){
      //echo $requete;
      echo mysqli_error($connexion)."<br>";
      //header('Location: index.php?action=article');
      return ;
    }
    header('Location: index.php?action=reponses&id_question='.$id);
    return ;
  }

  function signalerReponse(){
    if (!isset($_POST["signaler"])) { return ; }
    require_once('fonc_bdd.php'); // contient connexionBDD()
    $connexion = connexionBDD();
    if (!$connexion){ return; }
    $id = $_POST["id"];
    $id_question = $_POST["id_question"];
    $requete = 'UPDATE reponses SET signale=TRUE WHERE id='.$id.';' ;
    $enregistrement = mysqli_query($connexion,$requete);
    if (!$enregistrement){
      echo mysqli_error($connexion)."<br>";
      return ;
    }
    header('Location: index.php?action=reponses&id_question='.$id_question);
    return ;
  }
?>
