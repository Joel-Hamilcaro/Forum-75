<?php

require_once('fonc_admin.php');
require_once('fonc_afficherFormulaire.php');
require_once('fonc_afficherTout.php');
require_once('fonc_enregistrement.php');
require_once('fonc_signalement.php');
require_once('fonc_sortieParDefaut.php');


session_start();
tete_de_page(); // (toujours)
menu(); // (toujours)
if ( isset($_GET["action"]) ){ // Si $_GET["action"] défini
							switch ($_GET["action"]) {



									// Si $_GET["action"] est inconnu (ne correspond à aucun "case")
								default :
										 accueil(); connexionFormulaire(); // (défaut)



									// INSCRIPTION
								case "inscription" : //Formulaire d'inscription
									 formulaire(); break;
                case "sauvegarde" : //Enregistrer l'inscription
                inscription(); break;



									// CONNEXION - DECONNEXION
                case "connexion" :  //Ouverture de session
                  accueil(); login_valid(); break;
                case "deconnexion" : //Fermerture de session
                  require_once('logout.php'); break;



									//MODIFIER SON PROFIL
								case "profil" : //Formulaire de modification du profil
									modifierProfilAux(); break;
								case "modifier" : //Enregistrement des modifications
									modifierProfil2(); modifierProfilAux(); break;



									// POSER UNE QUESTION SUR lE FORUM
                case "poser" : //Formulaire pour poser une question
                  poser(); break;
								case "poser2" : //Enregistrer la question
									enregistrerQuestion(); poser(); break;



									//VOIR LES QUESTIONS (SUJETS) DU FORUM
								case "repondre" :
									afficherToutQuestion() ; poser(); break;



									//VOIR LES REPONSES A UNE QUESTION DU FORUM + REPONDRE A UNE QUESTION DU FORUM
								case "reponses" : //Afficher les réponses et formulaire pour répondre
									voirRéponses(); break;
								case "repondre2" : //Enregistrement de la réponse
									enregistrerReponse(); break;



									// ECRIRE UN ARTICLE
								case "poster" : //Formulaire pour ecrire un article
		              nouvelArticle(); break;
								case "article2" : //Enregistrer l'article
									enregistrerArticle(); nouvelArticle(); break;



									//MODIFIER SON ARTICLE
								case "editer" : //Formulaire pour modifier un article
										editionAux(); break;
								case "edition" : //Enregistrer l'article modifié
										enregistrerModif(); break;



									//VOIR LES ARTICLES (-- Source des articles http://www.faux-texte.com )
								case "article" :
									afficherToutArticle(); nouvelArticle(); break;



									//VOIR LES COMMENTAIRES D'UN ARTICLE + COMMENTER UN ARTICLE
								case "commentaires" : //Afficher les commentaires et formulaire pour commenter
										 voirCommentaires(); break;
								case "commenter" : //Enregistrer le commentaire
		 								 enregistrerCommentaire(); break;



									//AIMER UN ARTICLE
								case "aimer" :
		 		 						aimer(); break;



									//SIGNALER DU CONTENU ABUSIF
								case "signalerQuestion" : //Signaler une question
		 			 	 				 signalerQuestion(); break;
								case "signalerReponse" : //Signaler une reponse
			 								signalerReponse(); break;
								case "signalerArticle" : //Signaler un article
										signalerArticle(); break;
								case "signalerCommentaire" : //Signaler un commentaire
	 									 signalerCommentaire(); break;



								 	 //SUPPRIMER OU DÉSIGNALER DU CONTENU (Réservé aux administrateurs)
								case "supprimerQuestion" :
 			 							supprimerOuValiderQuestion(); break;
								case "supprimerReponse" :
					 					supprimerOuValiderReponse(); break;
								case "supprimerCommentaire" :
			 							supprimerOuValiderCommentaire(); break;
								case "supprimerArticle" :
			 							supprimerOuValiderArticle(); break;



									//VOIR TOUT LE CONTENU SIGNALÉ (Réservé aux administrateurs)
								case "signalement" :
										 voirSignalements(); connexionFormulaire(); break;



							}
            }


else { // Si $_GET["action"] pas défini
	accueil(); connexionFormulaire(); // (défaut)
}
pied_de_page(); // (toujours)

?>
