<?php
//Formulaire de connexion

function page_login(){
  echo
    '
	     <h2>Connexion</h2>
	     <form action="index.php?action=connexion" method="post">
	      Pseudonyme :
	      <input type="text" name="pseudo" placeholder="Nom d\'utilisateur"><br>
	      Mot de passe :
	      <input type="password" name="mdp" placeholder="Mot de passe"><br>
	      <input type="submit" name="send" value="Connexion">
	      <input type="reset" name="clear" value="Réinitialiser"><br>
	     </form>';
  echo
    "<p>
    Si vous n'êtes pas inscrit,
    <a href=\"index.php?action=inscription\">créez votre compte</a>.
    </p>

    ";
}

//Formulaire d'inscription

function formulaire(){
  echo
'
          <section class="full">
  				<h2>Inscription</h2>
  				<form action="index.php?action=sauvegarde" method="post">
  					Nom :
  					<input type="text" name="nom" placeholder="Votre nom"><br>
  					Prénom :
  					<input type="text" name="prenom" placeholder="Votre prénom"><br>
            Date de naissance :
            <input type="date" name="birth" placeholder="JJ/MM/AAAA"><br>
            Adresse e-mail :
            <input type="email" name="mail" placeholder="Adresse valide"><br>
  					Pseudonyme :
  					<input type="text" name="pseudo" placeholder="Nom d\'utilisateur"><br>
  					Mot de passe :
  					<input type="password" name="mdp" placeholder="Mot de passe"><br>
  					<input type="submit" name="send" value="Confirmer l\'inscription">
  					<input type="reset" name="clear" value="Réinitialiser"><br>
  					<a href="index.php">Retour à l\'accueil</a>
  				</form>
        </section><aside class="zero">
'
  	;
}

//Formulaire pour poster de question

function poser(){
  echo "<section class='full'>";
if (!isset($_SESSION["user"])){ echo "<h2>Vous devez vous connecter pour poser une question</h2> <a href='index.php'>Veuillez retourner à l'accueil et vous connecter.</a>" ; }
else  {
  $login=$_SESSION["user"];
  echo
'
<h2>Poser une question</h2>
<form action="index.php?action=poser2" method="post">
Titre: <br><input type="text"  name="titre" /><br>
Objet: <br><input type="text"  name="sujet" /><br>
<br> <textarea rows="10" cols="40" name="question" placeholder="Ecrivez ici votre question"></textarea> <br>
Anonyme <input type="radio" name="anonyme" value="1" />oui
<input type="radio" name="anonyme" value="0" checked/>non<br>
<input type="hidden" name="pseudo" value="'.$login.'" />
<input type="submit" name="send" value="Poster la question">
</form>';
  }
echo "</section><aside class ='zero'>";
}

//Fonction II.4 : Formulaire pour répondre à une question

function repondre($id_question){
if (!isset($_SESSION["user"])){ echo "<h2>Vous devez vous connecter pour répondre</h2> <a href='index.php'>Veuillez retourner à l'accueil et vous connecter.</a>" ; }
else  {
  $login=$_SESSION["user"];
  echo
'
<h2>Répondre</h2>
<form action="index.php?action=repondre2" method="post">
<br> <textarea rows="10" cols=“120” name="reponse" placeholder="Ecrivez ici votre réponse"></textarea> <br>
Anonyme <input type="radio" name="anonyme" value="1" />oui
<input type="radio" name="anonyme" value="0" checked/>non<br>
<input type="hidden" name="pseudo" value='.$login.' />
<input type="hidden" name="id_question" value='.$id_question.' />
<input type="submit" name="send" value="Poster la réponse">
</form>
'
	;}
}

//Fonction II.5 : Formulaire pour rédiger un article

function nouvelArticle(){
  echo "<section class='full'>";
  if (!isset($_SESSION["user"])){ echo "<h2>Vous devez vous connecter pour écrire un article</h2> <a href='index.php'>Veuillez retourner à l'accueil et vous connecter.</a>" ; }
  else  {
    $login=$_SESSION["user"];
  require_once('fonc_date.php');
  echo '
  <h2> Ecrire un article </h2>
  <form method=post action="index.php?action=article2">

  Titre : <br>
  <input type="text" name="titre"><br>

  Anonyme <input type="radio" name="anonyme" value="1" />oui
  <input type="radio" name="anonyme" value="0" checked />non<br>

  Texte : <br>
  <textarea name="texte" rows="10" cols="120" > </textarea><br>

  <input type="hidden" name="creation" value='.date_en_français().'>
  <input type="hidden" name="modification" value='.date_en_français().'>
  <input type="hidden" name="pseudo" value='.$login.'>
  <input type="submit" name="enregistrer" value="Poster l\'article">
  </form> ' ;
  }
  echo "</section><aside class='zero'>";

}

//Fonction II.6 : Formulaire pour commenter un article

function commenter($id_article){
if (!isset($_SESSION["user"])){ echo "<h2>Vous devez vous connecter pour commenter l'article</h2><a href='index.php'>Veuillez retourner à l'accueil et vous connecter.</a>" ; }
else  {
  $login=$_SESSION["user"];
  echo
'
<h2>Commenter l\'article</h2>
<p>
<form action="index.php?action=commenter" method="post">
<br> <textarea rows="6" cols=“50” name="commentaire" placeholder="Ecrivez ici votre commentaire"></textarea> <br>
Anonyme <input type="radio" name="anonyme" value="1" />oui
<input type="radio" name="anonyme" value="0" checked/>non<br>
<input type="hidden" name="pseudo" value='.$login.' />
<input type="hidden" name="id_article" value='.$id_article.' />
<input type="submit" name="send" value="Poster le commentaire">
</form>
</p>
'
	;
	}
}

//Fonction II.6 (auxiliaire à II.7): Formulaire de modification d'un article

function edition($id,$titre,$texte){
  require_once('fonc_date.php');
  echo "<section class='full'> <h2> Modifier votre article </h2>";
  echo '
  <form method=post action=index.php?action=edition>
    Titre : <br>
  <input type="text" name="titre" value="'.$titre.'" /><br>
    Texte : <br>
  <textarea name="texte" rows="10" cols="120">'.$texte.'</textarea><br>
  <input type="hidden" name="modification" value="'.date_en_français().'">
  <input type="hidden" name="id" value='.$id.'>
  <input type="submit" name="enregistrerModif" value="Enregistrer les modifications">
  </form> </section><aside class="zero"' ;
}

function editionAux(){
  require_once('fonc_bdd.php');
  $connexion = connexionBDD();
  if (!$connexion){ return; }
  $id = $_POST['id']; //Toujours défini car hidden
  $requete = $connexion->query('SELECT * FROM articles WHERE id='.$id);
  while ($article = $requete->fetch_array(MYSQLI_ASSOC)){
    edition($article['id'],$article['titre'],$article['texte']);
  }
}

// Formulaire de modification du profil

function modifierProfil($nom,$prenom,$birth,$mail,$pseudo){
echo '
<section class="full">
<form action="index.php?action=modifier" method="POST">
<h2> Modifier le profil </h2>
Nom: <br><input type="text" name="nom" value='.$nom.'><br>
Prenom: <br><input type="text" name="prenom" value='.$prenom.'><br>
Date de naissance: <br><input type="date" name="birth" value='.$birth.'><br>
E-mail: <br><input type="text" name="mail" value='.$mail.' ><br>
Nouveau mot de passe : <br><input type="password" name="mdp1" placeholder="Mot de passe"><hr>

Pour valider les modifications, veuillez entrer votre mot de passe actuel : <br><input type="password" placeholder="Mot de passe" name="mdp0" ><br>
<input type="submit"  name ="Confirmer"/>
<input type="hidden" name="pseudo" value='.$pseudo.'>
</form></section><aside class="zero">
';
}

function modifierProfilAux(){
  if (!isset($_SESSION["user"])){ echo "<section class='full'><h2>Vous devez vous connecter pour modifier votre profil</h2><a href='index.php'>Veuillez retourner à l'accueil et vous connecter.</a></section><aside class='zero'>" ; }
  else  {
    $login=$_SESSION["user"];
    require_once('fonc_bdd.php');
    $connexion = connexionBDD();
    if (!$connexion){ return; }
    $requete = $connexion->query('SELECT * FROM utilisateurs WHERE pseudo="'.$login.'"');
    while ($utilisateur = $requete->fetch_array(MYSQLI_ASSOC)){
      modifierProfil($utilisateur['lastname'],$utilisateur['firstname'],$utilisateur['birth'],$utilisateur['mail'],$utilisateur['pseudo']);
    }
  }
}
 ?>
