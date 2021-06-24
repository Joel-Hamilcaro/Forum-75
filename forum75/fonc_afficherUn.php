<?php

function afficherUneQuestion($id,$anonyme,$sujet,$titre,$question,$pseudo, $creation){
  echo "<message>";
  if ($anonyme == 1) $pseudo = "Anonyme" ;
  echo
  '
  <h2> ['.$sujet.'] '.$titre.'</h2> '.$creation.'. </br>
  <h3> '.$pseudo.'</h3>
  <p> '.$question.' </p> <br>
  ';
  if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==true){
      echo '
        <form action="index.php?action=supprimerQuestion&id='.$id.'" method=post>
        <input type="hidden" name="id" value='.$id.' />
        <input type="submit" name="valider" value="Valider la question">
        <input type="submit" name="supprimer" value="Suppression">
        </form>' ;
        echo '<a href="index.php?action=reponses&id_question='.$id.'">Voir et actualiser les réponses</a></li>';
        return;
    }
  }
  echo '
    <form action="index.php?action=signalerQuestion&id='.$id.'" method=post>
    <input type="hidden" name="id" value='.$id.' />
    <input type="submit" name="signaler" value="Signaler en cas d\'abus">
    </form>' ;
  echo '<a href="index.php?action=reponses&id_question='.$id.'">Voir et actualiser les réponses</a></li>';
  echo "</message><hr>";

}

function afficherUneReponse($id, $anonyme, $id_question, $reponse, $pseudo, $creation){
  echo "<messages>";
  if ($anonyme == 1) $pseudo = "Anonyme" ;
  echo
  '
  <h3> '.$pseudo.'</h3> '.$creation.'. </br>
  <p> '.$reponse.' </p> <br>
  ';
  if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==true){
      echo '
        <form action="index.php?action=supprimerReponse&id='.$id.'" method=post>
        <input type="hidden" name="id" value='.$id.' />
        <input type="hidden" name="id_question" value='.$id_question.' />
        <input type="submit" name="valider" value="Valider le message">
        <input type="submit" name="supprimer" value="Suppression">
        </form>' ;   echo "</messages><hr>";
return ;
    }
  }
  echo '
    <form action="index.php?action=signalerReponse&id='.$id.'" method=post>
    <input type="hidden" name="id" value='.$id.' />
    <input type="hidden" name="id_question" value='.$id_question.' />
    <input type="submit" name="signaler" value="Signaler en cas d\'abus">
    </form>' ;   echo "</message><hr>";

}

function afficherUnArticle($id,$titre,$texte,$creation,$modification, $pseudo, $anonyme, $likes){
  echo '<h2> '.$titre.' </h2>';
  echo 'écrit';
  if ($anonyme==0){
    echo ' par <strong> '.$pseudo.' </strong>,';
  }
  echo ' '.$creation.'';
  if ($modification != $creation) echo  ' (Modifié '.$modification.') </br>' ;
  echo '<p> '.$texte.' <br>' ;
  echo '<em> (Aimé par '.$likes.' personne(s)) </em></p> <br>' ;

  if (isset($_SESSION['user'])){
    if ($_SESSION['user']==$pseudo){
      echo '
        <form action="index.php?action=editer" method=post>
        <input type="hidden" name="id" value='.$id.' >
        <input type="submit" name="editer" value="Modifier votre article">
        </form>
        ';
      }
      else {
        echo '<form action="index.php?action=aimer&id='.$id.'" method=post>
          <input type="hidden" name="id_article" value='.$id.' />
          <input type="hidden" name="pseudo" value='.$_SESSION['user'].' />
          <input type="submit" name="aimer" value="J\'aime">
          <input type="submit" name="disliker" value="Je n\'aime pas">
          </form>' ;
      }
      if (isset($_SESSION['admin'])){
        if ($_SESSION['admin']==true){
          echo '
            <form action="index.php?action=supprimerArticle&id='.$id.'" method=post>
            <input type="hidden" name="id" value='.$id.' />
            <input type="submit" name="valider" value="Valider l\'article">
            <input type="submit" name="supprimer" value="Suppression">
            </form>' ;
          echo '<a href="index.php?action=commentaires&id_article='.$id.'">Voir et actualiser les commentaires</a></li>';
            return;
        }
      }
  }
  echo '
          <form action="index.php?action=signalerArticle&id='.$id.'" method=post>
          <input type="hidden" name="id" value='.$id.' />
          <input type="submit" name="signaler" value="Signaler en cas d\'abus">
          </form>' ;

  echo '<a href="index.php?action=commentaires&id_article='.$id.'">Voir et actualiser les commentaires</a></li>';
  echo "<hr>";
}

function afficherUnCommentaire($id, $anonyme, $id_article, $commentaire, $pseudo, $creation){
  if ($anonyme == 1) $pseudo = "Anonyme" ;
  echo
  '
  <h3> '.$pseudo.'</h3> '.$creation.'. </br>
  <p> '.$commentaire.' </p> <br>
  ';
  if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==true){
      echo '
        <form action="index.php?action=supprimerCommentaire&id='.$id.'" method=post>
        <input type="hidden" name="id" value='.$id.' />
        <input type="hidden" name="id_article" value='.$id_article.' />
        <input type="submit" name="valider" value="Valider le message">
        <input type="submit" name="supprimer" value="Suppression">
        </form>' ; return ;
    }
  }
  echo '
    <form action="index.php?action=signalerCommentaire&id='.$id.'" method=post>
    <input type="hidden" name="id" value='.$id.' />
    <input type="hidden" name="id_article" value='.$id_article.' />
    <input type="submit" name="signaler" value="Signaler en cas d\'abus">
    </form>' ;
  echo "<hr>";
}
 ?>
