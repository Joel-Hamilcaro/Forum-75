<?php

// Connexion à la base de donnée (à modifier selon la machine)
  function connexionBDD(){
   $connexion = mysqli_connect('localhost' ,'adminForum75' , "mdpForum75", 'dataForum75') ;
   // retourne true si la connexion est réussie (natif PHP >= 5)

   /*

   Au Script :
    $connexion = mysqli_connect('pams.script.univ-paris-diderot.fr' ,LOGIN , MOT-DE-PASSE , LOGIN) ;
   En général :
    $connexion = mysqli_connect($serveur, $login, $mot_de_passe, $base_de_données);

   */

   if (!$connexion){	return $connexion /*false*/;}
   mysqli_set_charset($connexion, "utf8") ; //paramètrage du jeu de caractères en utf-8 (natif PHP >= 5.0.5)
   return $connexion /*true*/;
}

// Pour compter le nombre de ligne d'une requête sans les afficher

  function lineRequete($requete){
    $x = 0 ;
    $connexion = connexionBDD(); // Connexion à la base de donnée
    if (!$connexion) return ;
    $execution = mysqli_query($connexion, $requete) ; //Execution d'une requete (natif PHP >= 5)
    if(!$execution){ echo "Requête incorrecte <br>" ; echo mysqli_error($connexion) ;} //Renvoie un $string de la dernière erreur (natif PHP >= 5)
    else {
      while ($ligne = mysqli_fetch_assoc ($execution) ){ $x = $x+1;} //Lecture d'une ligne de requete dans un tableau associatif (natif PHP >= 4.0.3)
    }
    return $x;
  }

 ?>
