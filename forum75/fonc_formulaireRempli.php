<?php

// Verification : champ de formulaire bien rempli (s'applique à un seul champ de formulaire)

  function correctement_rempli($champ_du_formulaire){
    if( !isset($_POST[$champ_du_formulaire]) ){
      return false;
    }
    if( htmlspecialchars($_POST[$champ_du_formulaire])==""){
      return false;
    }
    return true;
  }

// Verification du remplissage du formulaire de connexion

  function toutRempliConnexion(){
    return(
      correctement_rempli("pseudo")
      && correctement_rempli("mdp")
    );
  }

// Verification : remplissage du formulaire pour poster un article
  function toutRempliArticle(){
    return(
          correctement_rempli("titre") // Verification : champ de formulaire bien rempli
    &&        correctement_rempli("texte") // Verification : champ de formulaire bien rempli
    &&        correctement_rempli("anonyme") // Verification : champ de formulaire bien rempli
    &&        correctement_rempli("creation") // Verification : champ de formulaire bien rempli
    &&        correctement_rempli("modification") // Verification : champ de formulaire bien rempli
    &&        correctement_rempli("pseudo") // Verification : champ de formulaire bien rempli

    );
  }

// Verification : remplissage du formulaire pour poster un commentaire

  function toutRempliCommentaire(){
      return(
            correctement_rempli("commentaire") // Verification : champ de formulaire bien rempli
      &&        correctement_rempli("anonyme") // Verification : champ de formulaire bien rempli
      &&        correctement_rempli("pseudo") // Verification : champ de formulaire bien rempli
      &&        correctement_rempli("send") // Verification : champ de formulaire bien rempli
      &&        correctement_rempli("id_article") // Verification : champ de formulaire bien rempli

      );
    }

// Verification : remplissage du formulaire pour modifier son profil

  function toutRempliModifier(){
      return(
                correctement_rempli("pseudo") // Verification : champ de formulaire bien rempli
          &&        correctement_rempli("nom") // Verification : champ de formulaire bien rempli
          &&        correctement_rempli("prenom") // Verification : champ de formulaire bien rempli
          &&        correctement_rempli("birth") // Verification : champ de formulaire bien rempli
          &&        correctement_rempli("mdp0") // Verification : champ de formulaire bien rempli
          &&        correctement_rempli("mdp1") // Verification : champ de formulaire bien rempli
          &&        correctement_rempli("mail") // Verification : champ de formulaire bien rempli
          );
  }

// Verification : remplissage du formulaire pour poster une question

  function toutRempliQuestion(){
      
      return(
              correctement_rempli("pseudo") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("anonyme") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("titre") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("sujet") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("question") // Verification : champ de formulaire bien rempli

      );
  }

// Verification : remplissage du formulaire pour poster une réponse

  function toutRempliReponse(){
      return(
              correctement_rempli("reponse") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("anonyme") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("pseudo") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("send") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("id_question") // Verification : champ de formulaire bien rempli

      );
  }

// Verification : remplissage du formulaire d'inscription

  function toutRempli(){
      return(
        correctement_rempli("pseudo") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("prenom")  // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("nom") // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("mdp")  // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("mail")  // Verification : champ de formulaire bien rempli
        &&        correctement_rempli("birth")  // Verification : champ de formulaire bien rempli

      );
  }

 ?>
