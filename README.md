# FORUM 75

<img alt="HTML5" src="https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white"/><img alt="CSS3" src="https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white"/><img alt="PHP" src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white"/><img alt="MySQL" src="https://img.shields.io/badge/mysql-%2300f.svg?&style=for-the-badge&logo=mysql&logoColor=white"/>

## Rapport

### But et fonctionnalités du site
Le Forum 75 est un site web où vous pouvez poser des questions et partager vos connaissances.
L’objectif de ce site est d’offrir, aux utilisateurs, du contenu qui soit entièrement fait par eux-même, créant ainsi une communauté de partage de savoirs. Les utilisateurs pourront écrire leurs propres articles, et commenter ceux des autres. De plus, le boutton "J’aime" qui accompagne chaque article, servira de système de vote afin de placer le meilleur article en page en d’acceuil du site. Il n’y a pas de thèmes prédéfinis, les discussions sont libres, le but étant d’inciter les utilisateurs à s’interesser aux différents sujets abordés. Nous avons décidés d’offrir aux utilisateurs inscrits la possibilité de :  

— Poser une question sur le forum
— Répodre aux question du forum
— Publier un article
— Modifier les articles qu’ils ont publiés
— Commenter un article
— Aimer un article avec possibilité d’annuler
— Modifier son profil  

Un système de modération permettra à des comptes admnistrateurs d’accéder à d’autres fonction-
nalités supplémentaires :  

— Accéder à une page du site qui rencense tout le contenu qui a été signalé
— Supprimer du contenu  

### Choix techniques

#### La structure du code  

Nous avons décidé de structurer le code en les séparant dans différents fichiers .php. Le fichier
"index.php" est le fichier qui sera chargé par le navigateur et qui gèrera l’ensemble des pages du
site. Le fichier "index.php" servira d’intermédiaire par lequel les fonctions des autres fichiers .php
seront appelées. Ces autres fichiers sont séparés selon les fonctions qu’elles possèdent, de la manière
suivante :  

1. fonc_admin.php contient les fonctions de suppression et de désignalement (ces fonctions sont
appelées uniquement sous une session d’administrateur)
2. fonc_afficherFormulaire.php contient les fonctions d’affichage de formulaires html (par
exemple les formulaire de connexion, d’inscription, pour ecrire un article, ...)
3. fonc_afficherTout.php contient les fonctions qui affichent une liste spécifiques du contenu
issus de la base de donnée (par exemple, l’affichage de tous les articles du plus récent au plus
ancien, affichage de tout le contenu signalé, ...)
4. fonc_afficherUn.php contient les fonctions qui affichent un élément de la base de donnée
(par exemple, un article). Ces fonction sont appelés par le fichier fonc_afficherTout.php.
5. fonc_bdd.php contient une fonction de connexion à la base de donnée, et une fonction qui
compte les lignes d’une requête SQL.
6. fonc_date.php contient une fonction qui retourne la date et l’heure courante sous forme de
chaine de caractère, et une fonction qui affiche la date du jour courant.
7. fonc_enregistrement.php contient les fonctions qui gèrent l’essentiel des modification de
la base de données (par exemple, l’enregistrement d’un nouvel utilisateur, l’enregistrement
d’un nouveau message, ...)
8. fonc_formulaireRempli.php contient les fonctions verifient si les formulaires sont bien rem-
plis.
9. fonc_signalement.php contient les fonctions qui permettent de signaler du contenu.
10. fonc_sortieParDefaut.php contient les fonctions d’affichage de la structure de la page
HTML par défaut (en tête "<header>", "<nav>", "<section>", "<aside>")
11. logout.php arrête la session en cours lorsqu’il est chargé.
  
### Le format de date des messages 
  
Pour simplifier l’affichage des messages, nous avons choisi de stocker, dans la base de données,
les dates des messages sous forme de chaînes de caractères du type "le Samedi 5 Mai 2018 à
13:21:16". En effet, les dates de messages sont utilisées, dans la base de donnée, uniquement à
des fins d’affichage (c’est l’id des messages qui gère la chronologie).

### La conception de la base de données

Nous avons décider de créer six tables pour concevoir notre base de donées :  

1. articles
2. commentaires (d’un article)
3. likes (personnes ayant aimé un article)
4. questions
5. reponses (d’une question)
6. utilisateurs
Les utilisateurs peuvent modifier la base données comme expliquer dans la partie 1 (en publiant
des articles, posant des questions, etc...)
Toutes les tables (sauf utilisateurs) possèdent un attribut (colonne) "signale" de type booléen,
qui sert au sytème de modération du site. Sa valeur est TRUE quand le contenu est signalé. Les
administrateurs pourront remettre sa valeur à FALSE.

## INITIALISATION DE LA DATABASE

- Se placer dans le répertoire 'forum75/'

- Dans le terminal :

```
sudo mysql
```

- Dans mysql :

```
CREATE USER 'adminForum75'@'localhost' IDENTIFIED WITH mysql_native_password BY 'mdpForum75';
SELECT user, host FROM mysql.user;
CREATE DATABASE dataForum75;
GRANT ALL ON dataForum75.* TO 'adminForum75'@'localhost';
FLUSH PRIVILEGES;
SHOW databases;
```

- Dans le terminal :

```
mysql -u adminForum75 -p dataForum75
```
(password : mdpForum75)

- Dans mysql :

```
source create_table.sql;
```

## DEMARRAGE DU SERVEUR

- Dans le terminal :

```
php -S localhost:8080
```

## Utilisation du site

#### Mot de passe des utilisateurs déjà présents dans le BDD

Mot de passe : 123

#### Se connecter au compte admnistrateur :

Pseudo : admin-1
Mot de passe : 123

## SUPPRESSION DE LA DATABASE

- Dans le terminal :

```
sudo mysql
```

- Dans mysql :

```
drop database dataForum75;
drop user 'adminForum75'@'localhost';
```
