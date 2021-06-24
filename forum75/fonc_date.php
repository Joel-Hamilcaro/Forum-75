<?php
//Ce fichier gère les date et les heures
//Les dates et heures seront des chaînes de caratères de la forme : "le Samedi 5 Mai 2018 à 13:21:16"

//Fonction D.1 :
  // Retourne la date et l'heure sous forme de chaine de caractère
  // Sortie de la forme : "le Samedi 5 Mai 2018 à 13:21:16"
  // Inspiré de l'exercice 9 du TP4 : IO2 (Internet et Outils)

  function date_en_français(){
    date_default_timezone_set("Europe/Paris"); //Paramétrage du fuseau horraire (PHP >= 5.1.0)
    $fr=array(

      //Day => Jours
      "Monday" => "Lundi",
      "Tuesday" => "Mardi",
      "Wednesday" => "Mercredi",
      "Thursday" => "Jeudi",
      "Friday" => "Vendredi",
      "Saturday" => "Samedi",
      "Sunday" => "Dimanche",

      //Month => Mois
      "January"=>"Janvier",
      "February"=>"Février",
      "March"=>"Mars",
      "April"=>"Avril",
      "May"=>"Mai",
      "June"=>"Juin",
      "July"=>"Juillet",
      "August"=>"Août",
      "September"=>"Septembre",
      "October"=>"Octobre",
      "November"=>"Novembre",
      "December"=>"Décembre"
    );

    return 'le '.$fr[date('l')].' '.date('j').' '.$fr[date('F')].' '.date('Y').' à '.date("H:i:s"); //date() (natif PHP >= 4)
  }

  function afficher_date(){
  date_default_timezone_set("Europe/Paris");
  $fr=array(

  //Day => Jours
  "Monday" => "Lundi",
  "Tuesday" => "Mardi",
  "Wednesday" => "Mercredi",
  "Thursday" => "Jeudi",
  "Friday" => "Vendredi",
  "Saturday" => "Samedi",
  "Sunday" => "Dimanche",

  //Month => Mois
  "January"=>"Janvier",
  "February"=>"Février",
  "March"=>"Mars",
  "April"=>"Avril",
  "May"=>"Mai",
  "June"=>"Juin",
  "July"=>"Juillet",
  "August"=>"Août",
  "September"=>"Septembre",
  "October"=>"Octobre",
  "November"=>"Novembre",
  "December"=>"Décembre"

  );

  echo $fr[date('l')]," ",date('j')," ",$fr[date('F')]," ",date('Y');
  }
?>
