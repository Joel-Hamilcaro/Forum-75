<?php

function supprimerOuValiderArticle(){
  if (isset($_SESSION['admin'])){

    if ($_SESSION['admin']==true){ //Si admin : 2 choix
      //Choix 1 : Suppression
      if (isset($_POST["supprimer"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ header('Location: index.php?action=signalement'); return; }
        $id = $_POST["id"];
        $requete = 'DELETE FROM commentaires WHERE id_article='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){ echo mysqli_error($connexion)."<br>"; }
        $requete = 'DELETE FROM likes WHERE id_article='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){ echo mysqli_error($connexion)."<br>"; }
        $requete = 'DELETE FROM articles WHERE id='.$id.';' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){echo mysqli_error($connexion)."<br>";return ;}
      }

      //Choix 2 : Validation
      if (isset($_POST["valider"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ return; }
        $id = $_POST["id"];
        $requete = 'UPDATE articles SET signale=FALSE WHERE id='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){ echo mysqli_error($connexion)."<br>"; return ; }
      }

    }
  } // Si pas admin, on arrive directement ici.
  header('Location: index.php?action=signalement'); return;
}

function supprimerOuValiderCommentaire(){
  if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==true){
        //Choix 1 : Suppression
      if (isset($_POST["supprimer"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ return; }
        $id = $_POST["id"];
        $requete = 'DELETE FROM commentaires WHERE id='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){echo mysqli_error($connexion)."<br>";return ;}
      }
      //Choix 2 : Validation
      if (isset($_POST["valider"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ return; }
        $id = $_POST["id"];
        $requete = 'UPDATE commentaires SET signale=FALSE WHERE id='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){echo mysqli_error($connexion)."<br>";return ;}
      }
    }
  } // Si pas admin, on arrive directement ici.
header('Location: index.php?action=signalement'); return ;
}


function supprimerOuValiderQuestion(){
  if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==true){
        //Choix 1 : Suppression
      if (isset($_POST["supprimer"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ header('Location: index.php?action=signalement'); return; }
        $id = $_POST["id"];
        $requete = 'DELETE FROM reponses WHERE id_question='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){
          echo mysqli_error($connexion)."<br>";
        }
        $requete = 'DELETE FROM questions WHERE id='.$id.';' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){
          echo mysqli_error($connexion)."<br>";
        return ;
        }
      }
      //Choix 2 : Validation
      if (isset($_POST["valider"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ return; }
        $id = $_POST["id"];
        $requete = 'UPDATE questions SET signale=FALSE WHERE id='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){
          echo mysqli_error($connexion)."<br>";
          return ;
        }
      }
    }
  }
  header('Location: index.php?action=signalement'); return;
}

function supprimerOuValiderReponse(){
  if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==true){
        //Choix 1 : Suppression
      if (isset($_POST["supprimer"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ return; }
        $id = $_POST["id"];
        $requete = 'DELETE FROM reponses WHERE id='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){
          echo mysqli_error($connexion)."<br>";
          return ;
        }
      }
        //Choix 2 : Validation
      if (isset($_POST["valider"])) {
        require_once('fonc_bdd.php'); // contient connexionBDD()
        $connexion = connexionBDD();
        if (!$connexion){ return; }
        $id = $_POST["id"];
        $requete = 'UPDATE reponses SET signale=FALSE WHERE id='.$id.' ; ' ;
        $enregistrement = mysqli_query($connexion,$requete);
        if (!$enregistrement){
          echo mysqli_error($connexion)."<br>";
          return ;
        }
      }
    }
  }
  header('Location: index.php?action=signalement'); return ;
}

?>
