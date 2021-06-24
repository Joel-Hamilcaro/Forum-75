<?php
// Enregistrement d'un nouvel utilisateur
require_once('fonc_formulaireRempli.php'); //contient toutRempli(), toutRempliArticle(), ...
require_once('fonc_bdd.php'); // contient connexionBDD()

function inscription(){
		if(!toutRempli() ){
      echo "<section class='full'>
      Veuillez remplir correctement le formulaire <br> <a href='index.php?action=inscription''>Retour à l'inscription</a></section><aside class='zero'>
      "; return ; } // Verification : remplissage du formulaire d'inscription

		$connexion = connexionBDD();
		if (!$connexion){ echo "<section class='full'>
      Désolé, la connexion à la base de donnée a échouée <br><a href='index.php?action=inscription''>Retour à l'inscription</a></section><aside class='zero'>

      "; return ; }
		$nom = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['nom'])) ;
		$prenom = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['prenom']));
		$pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo']));
		$mdp = htmlspecialchars(mysqli_real_escape_string($connexion, md5($_POST['mdp']) ));
    $mail = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['mail']));
    $birth = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['birth']));
    $requete = 'INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "'.$nom.'" , "'.$prenom.'" , "'.$pseudo.'" , "'.$mdp.'" , "'.$mail.'", "'.$birth.'") ;' ;
		$enregistrement = mysqli_query($connexion,$requete);
		if (!$enregistrement){   echo "<section class='full'>
      Désolé, ce nom d'utilisateur existe déjà <br><a href='index.php?action=inscription''>Retour à l'inscription</a><br></section><aside class='zero'>
      ";  return ; }
    echo "<section class='full'>
            Inscription réussie ! <br>" ;
    echo "<a href='index.php'>Veuillez retourner à l'accueil et vous connecter.</a></section><aside class='zero'>
          " ; return ;
}

// Verification du mot de passe

function login_valid(){
  if (!isset($_POST['send'])) { require_once('fonc_afficherFormulaire.php'); page_login();  return ; }
  if(!toutRempliConnexion()){
    echo "<p>Veuillez remplir correctement le formulaire <br> <a href='index.php'>Réessayer</a></p>";
    return ;
  }
  $connexion = connexionBDD();
  if (!$connexion){ echo "Désolé, la connexion à la base de donnée a échouée <br><a href='index.php'>Réessayer</a>"; return ; }
  $pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo']));
  $mdp = htmlspecialchars(mysqli_real_escape_string($connexion, md5($_POST['mdp']) ));
	$requete = 'SELECT * FROM utilisateurs where pseudo="'.$pseudo.'" AND password="'.$mdp.'" AND admin=TRUE ; ' ;
	if (lineRequete($requete)==1){
    $_SESSION["user"]=$pseudo;
		$_SESSION["admin"]=true;
    header('Location:index.php');
    return;
  }
  $requete = 'SELECT * FROM utilisateurs where pseudo="'.$pseudo.'" AND password="'.$mdp.'" ; ' ;
  if (lineRequete($requete)==1){
    $_SESSION["user"]=$pseudo;
    header('Location:index.php');
    return;
  }
  else {
    echo "Vous avez entré un pseudonyme et/ou un mot de passe invalide <br><a href='index.php'>Réessayer</a>";
    return ;
  }
}


// Modifier profil

function modifierProfil2(){
  if (!toutRempliModifier()){ echo "<aside class='gauche'>Veuillez remplir correctement tous les champs<br></aside>"; return;}
  $con = connexionBDD();
  $nom = htmlspecialchars(mysqli_real_escape_string($con, $_POST["nom"]));
  $prenom = htmlspecialchars(mysqli_real_escape_string($con, $_POST["prenom"]));
  $birth = htmlspecialchars(mysqli_real_escape_string($con, $_POST["birth"]));
  $mail = htmlspecialchars(mysqli_real_escape_string($con, $_POST["mail"]));
  $pseudo = htmlspecialchars(mysqli_real_escape_string($con, $_POST["pseudo"]));
  $mdp0 = htmlspecialchars(mysqli_real_escape_string($con,md5($_POST["mdp0"])));
  $mdp1 = htmlspecialchars(mysqli_real_escape_string($con,md5($_POST["mdp1"])));


    $sql="select * from utilisateurs where pseudo='$pseudo'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        echo mysqli_error($con);
        return ;
    }
    $row=mysqli_fetch_assoc($res);

      if($row["password"]!=$mdp0){
        echo "<aside class='gauche'>Votre mot de passe est invalide.</aside>" ;
        return;
      }
      $sq=" update utilisateurs
          set lastname='$nom' ,
              firstname='$prenom',
              birth='$birth' ,
              mail='$mail' ,
              password='$mdp1'
          where  pseudo = '$pseudo' ;
          ";

      $res = mysqli_query($con,$sq);
        if(!$res){
          echo mysqli_error($con);
        }
      echo "<aside class='gauche'>Modifications enregistrées.</aside>" ;
      header('Location:index.php');

  }

  function enregistrerQuestion(){
  	   if(!toutRempliQuestion() ){
         echo "<aside class='gauche'> Veuillez remplir correctement tous les champs <br> </aside>" ;
         return ;
       } // Verification : remplissage du formulaire pour poster une question
  	$connexion = connexionBDD(); // Connexion à la base de donnée
  	   if (!$connexion){
         echo "Désolé, la connexion à la base de donnée a échouée." ;
         return ;
       }
    $anonyme =  intval($_POST['anonyme']) ; //Force à retourner la valeur entière (natif PHP>=4)
  	$titre = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['titre'])) ; //Protège une commande SQL (natif PHP>=4.3.0)
  	$sujet = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['sujet'])); //Protège une commande SQL (natif PHP>=4.3.0)
  	$question = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['question'])); //Protège une commande SQL (natif PHP>=4.3.0)
    $pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo'])); //Protège une commande SQL (natif PHP>=4.3.0)
    require_once('fonc_date.php'); //Contient date_en_français()
    $creation = date_en_français();
  		$requete = 'INSERT INTO questions (anonyme, titre, sujet, question, pseudo, creation) VALUES ( '.$anonyme.' , "'.$titre.'" , "'.$sujet.'" , "'.$question.'" , "'.$pseudo.'" , "'.$creation.'" ) ;' ;
  	  $enregistrement = mysqli_query($connexion,$requete); //Execution d'une requete (natif PHP >= 5)
  	  if (!$enregistrement){
        echo $requete;
        echo mysqli_error($connexion)."<br>";
        echo "La question n'a pas été enregistrée, veuillez réessayer." ;
        return ;
      }
      header('Location: index.php?action=repondre');
      return ;
  }

  function enregistrerReponse(){
    $id_question =  intval($_POST['id_question']) ; //Force à retourner la valeur entière (natif PHP>=4)
    //Toujours défini car hidden
  	   if(!toutRempliReponse() ){
         header('Location: index.php?action=reponses&id_question='.$id_question.'');
         return ;
       } // Verification : remplissage du formulaire pour poster une question
  	$connexion = connexionBDD(); // Connexion à la base de donnée
  	   if (!$connexion){
         echo "Désolé, la connexion à la base de donnée a échouée." ;
         return ;
       }
    $anonyme =  intval($_POST['anonyme']) ; //Force à retourner la valeur entière (natif PHP>=4)
  	$reponse = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['reponse'])); //Protège une commande SQL (natif PHP>=4.3.0)
    $pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo'])); //Protège une commande SQL (natif PHP>=4.3.0)
    require_once('fonc_date.php'); //Contient date_en_français()
    $creation = date_en_français();
  		$requete = 'INSERT INTO reponses (anonyme, id_question, reponse, pseudo, creation) VALUES ( '.$anonyme.' , '.$id_question.' ,"'.$reponse.'" , "'.$pseudo.'" , "'.$creation.'" ) ;' ;
  	  $enregistrement = mysqli_query($connexion,$requete); //Execution d'une requete (natif PHP >= 5)
  	  if (!$enregistrement){
        echo $requete;
        echo "<br> La question n'a pas été enregistrée, veuillez réessayer." ;
        return ;
      }
      header('Location: index.php?action=reponses&id_question='.$id_question.'');
      return ;
  }

  function enregistrerArticle(){
  	   if(!toutRempliArticle() ){
         echo "<aside class='gauche'>Veuillez remplir correctement tous les champs<br></aside>" ;
         return;
       } // Verification : remplissage du formulaire pour poster une question
  	$connexion = connexionBDD(); // Connexion à la base de donnée
  	   if (!$connexion){
         echo "Désolé, la connexion à la base de donnée a échouée." ;
         return ;
       }
    $anonyme =  intval($_POST['anonyme']) ; //Force à retourner la valeur entière (natif PHP>=4)
  	$titre = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['titre'])) ; //Protège une commande SQL (natif PHP>=4.3.0)
  	$texte = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['texte'])); //Protège une commande SQL (natif PHP>=4.3.0)
    $pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo'])); //Protège une commande SQL (natif PHP>=4.3.0)
    require_once('fonc_date.php'); //Contient date_en_français()
    $creation = date_en_français();
    $modification = $creation;
  		$requete = 'INSERT INTO articles (anonyme, titre, texte, pseudo, creation, modification) VALUES ('.$anonyme.' , "'.$titre.'" , "'.$texte.'" , "'.$pseudo.'" ,  "'.$creation.'" ,"'.$modification.'" ) ; ' ;
  	  $enregistrement = mysqli_query($connexion,$requete); //Execution d'une requete (natif PHP >= 5)
  	  if (!$enregistrement){
        echo mysqli_error($connexion)."<br>";
        echo $requete;
        echo "<br> L'article n'a pas été enregistrée, veuillez réessayer. <br>" ;
        return ;
      }
      header('Location: index.php?action=article');
      return ;
  }

  function enregistrerModif(){
    $connexion = connexionBDD();
    if (!$connexion){ return; }
    $titre= htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['titre']));
    $texte= htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['texte']));
    $modification=htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['modification']));
    $id=htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['id']));
    $requete = 'UPDATE articles SET titre="'.$titre.'" , texte="'.$texte.'" , modification="'.$modification.'" WHERE id='.$id.';' ;
    $enregistrement = mysqli_query($connexion,$requete);
    if (!$enregistrement){
      echo mysqli_error($connexion)."<br>";
      echo "<br> L'article n'a pas été enregistrée, veuillez réessayer." ;
      return ;
    }
    header('Location: index.php?action=article');
    return ;
  }

  function enregistrerCommentaire(){
    $id_article =  intval($_POST['id_article']) ; //Force à retourner la valeur entière (natif PHP>=4)
    //Toujours défini car hidden
  	   if(!toutRempliCommentaire() ){
         header('Location: index.php?action=commentaires&id_article='.$id_article.'');
         return ;
       } // Verification : remplissage du formulaire pour poster une question
  	$connexion = connexionBDD(); // Connexion à la base de donnée
  	   if (!$connexion){
         echo "Désolé, la connexion à la base de donnée a échouée." ;
         return ;
       }
    $anonyme =  intval($_POST['anonyme']) ; //Force à retourner la valeur entière (natif PHP>=4)
  	$commentaire = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['commentaire'])); //Protège une commande SQL (natif PHP>=4.3.0)
    $pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo'])); //Protège une commande SQL (natif PHP>=4.3.0)
    require_once('fonc_date.php'); //Contient date_en_français()
    $creation = date_en_français();
  		$requete = 'INSERT INTO commentaires (anonyme, id_article, commentaire, pseudo, creation) VALUES ( '.$anonyme.' , '.$id_article.' ,"'.$commentaire.'" , "'.$pseudo.'" , "'.$creation.'" ) ;' ;
  	  $enregistrement = mysqli_query($connexion,$requete); //Execution d'une requete (natif PHP >= 5)
  	  if (!$enregistrement){
        echo mysqli_error($connexion)."<br>";
        echo "<br> Le commentaire n'a pas été enregistrée, veuillez réessayer." ;
        return ;
      }
      header('Location: index.php?action=commentaires&id_article='.$id_article.'');
      return ;
  }

  function aimer(){
    require_once('fonc_bdd.php'); // contient connexionBDD()
    $id_article =  intval($_POST['id_article']) ; //Force à retourner la valeur entière (natif PHP>=4)
    //Toujours défini car hidden
  	$connexion = connexionBDD(); // Connexion à la base de donnée
  	   if (!$connexion){
         echo "Désolé, la connexion à la base de donnée a échouée." ;
         return ;
       }
    $pseudo = htmlspecialchars(mysqli_real_escape_string($connexion, $_POST['pseudo'])); //Protège une commande SQL (natif PHP>=4.3.0)
      if (isset($_POST['aimer'])){
  		    $requete = 'INSERT INTO likes (id_article, pseudo) VALUES ( '.$id_article.' ,  "'.$pseudo.'" ) ;' ;
      } else {
        $requete = 'DELETE FROM likes WHERE id_article = '.$id_article.' AND pseudo="'.$pseudo.'";' ;
      }
      $enregistrement = mysqli_query($connexion,$requete); //Execution d'une requete (natif PHP >= 5)
  	  if (!$enregistrement){
        header('Location: index.php?action=commentaires&id_article='.$id_article.'');
        return ;
      }
      header('Location: index.php?action=commentaires&id_article='.$id_article.'');
      return ;
  }
?>
