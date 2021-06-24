DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS reponses;
DROP TABLE IF EXISTS commentaires;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs (
  id INTEGER AUTO_INCREMENT,
  lastname VARCHAR(80) NOT NULL,
  firstname VARCHAR(80) NOT NULL,
  mail VARCHAR(300) NOT NULL, -- KEY
  pseudo VARCHAR(80) NOT NULL, -- KEY
  birth VARCHAR(10) NOT NULL,
  password CHAR(80) NOT NULL, -- crypté
  admin BOOLEAN DEFAULT FALSE,
	UNIQUE (id), UNIQUE (mail),
  PRIMARY KEY (pseudo) -- PRIMARY KEY
)ENGINE=InnoDB; -- Moteur qui vérifie les clés étrangères
CREATE TABLE questions (
  id INTEGER PRIMARY KEY AUTO_INCREMENT, -- PRIMARY KEY
  anonyme INTEGER DEFAULT 0,
  titre VARCHAR(80) NOT NULL,
  sujet VARCHAR(80) NOT NULL,
  question VARCHAR(8000) NOT NULL,
  pseudo VARCHAR(80) NOT NULL,
  signale BOOLEAN DEFAULT FALSE,
  creation VARCHAR(80) NOT NULL
)
ENGINE=InnoDB; -- Moteur qui vérifie les clés étrangères
ALTER TABLE questions ADD FOREIGN KEY (pseudo) REFERENCES utilisateurs(pseudo);

CREATE TABLE reponses (
  id INTEGER PRIMARY KEY AUTO_INCREMENT, -- PRIMARY KEY
  anonyme INTEGER DEFAULT 0,
  id_question INTEGER NOT NULL,
  reponse VARCHAR(8000) NOT NULL,
  pseudo VARCHAR(80) NOT NULL,
  creation VARCHAR(80) NOT NULL,
  signale BOOLEAN DEFAULT FALSE
)
ENGINE=InnoDB; -- Moteur qui vérifie les clés étrangères
ALTER TABLE reponses ADD FOREIGN KEY (pseudo) REFERENCES utilisateurs(pseudo);
ALTER TABLE reponses ADD FOREIGN KEY (id_question) REFERENCES questions(id);

CREATE TABLE articles (
  titre VARCHAR(80) NOT NULL,
  texte  VARCHAR(8000) NOT NULL,
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  anonyme INTEGER DEFAULT 0 NOT NULL,
  creation VARCHAR(80) NOT NULL,
  modification VARCHAR(80) NOT NULL,
  signale  BOOLEAN DEFAULT FALSE,
  pseudo VARCHAR(80) NOT NULL
)ENGINE=InnoDB;
ALTER TABLE articles ADD FOREIGN KEY (pseudo) REFERENCES utilisateurs(pseudo);

CREATE TABLE likes (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_article INTEGER,
  pseudo VARCHAR(80) NOT NULL,
  UNIQUE (id_article,pseudo)
)ENGINE=InnoDB;
ALTER TABLE likes ADD FOREIGN KEY (pseudo) REFERENCES utilisateurs(pseudo);
ALTER TABLE likes ADD FOREIGN KEY (id_article) REFERENCES articles(id);

CREATE TABLE commentaires (
  id INTEGER PRIMARY KEY AUTO_INCREMENT, -- PRIMARY KEY
  anonyme INTEGER DEFAULT 0,
  id_article INTEGER NOT NULL,
  commentaire VARCHAR(8000) NOT NULL,
  pseudo VARCHAR(80) NOT NULL,
  signale BOOLEAN DEFAULT FALSE,
  creation VARCHAR(80) NOT NULL
)ENGINE=InnoDB; -- Moteur qui vérifie les clés étrangères
ALTER TABLE commentaires ADD FOREIGN KEY (pseudo) REFERENCES utilisateurs(pseudo);
ALTER TABLE commentaires ADD FOREIGN KEY (id_article) REFERENCES articles(id);

-- Insertion d'utilisateurs pour les tests :
  -- ce ne sont pas de personnes réelles :
  -- (Noms et prénoms choisis aléatoirement à partir du calendrier du mois de Janvier)
  -- leur mot de passe est '123' pour tous
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Basile" , "Genneviève" , "Jenny" , "202cb962ac59075b964b07152d234b70" , "basile@genevieve.fr", "1980-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Odilon" , "Edouard" , "Edd" , "202cb962ac59075b964b07152d234b70" , "odilon@edouard.fr", "1990-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Mélaine" , "Raymond" , "Ray" , "202cb962ac59075b964b07152d234b70" , "ray@melaine.fr", "1995-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Alix" , "Lucien" , "Lulu" , "202cb962ac59075b964b07152d234b70" , "lulu@alix.fr", "2000-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Paulin" , "Guillaume" , "gpaul97" , "202cb962ac59075b964b07152d234b70" , "guillaume@paulin.fr", "1999-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Yvette" , "Tatiana" , "Ana" , "202cb962ac59075b964b07152d234b70" , "yvet@tatiana.fr", "1970-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Rémi" , "Nina" , "Nini" , "202cb962ac59075b964b07152d234b70" , "nini@nina.fr", "1998-01-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Roseline" , "Marcel" , "Marco" , "202cb962ac59075b964b07152d234b70" , "marco@roselin.fr", "1980-01-02") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Prisca" , "Marius" , "Sirus" , "202cb962ac59075b964b07152d234b70" , "marius@prisca.fr", "2000-05-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth) VALUES ( "Barnard" , "Sébastien" , "Seb2018" , "202cb962ac59075b964b07152d234b70" , "sebastient@barnard.fr", "1999-09-01") ;
INSERT INTO utilisateurs (lastname, firstname, pseudo, password, mail, birth, admin) VALUES ( "Administrateur" , "1" , "Admin-1" , "202cb962ac59075b964b07152d234b70" , "admin1-groupe75@projet.fr", "2018-01-01", TRUE) ;

-- Insertion de question pour les tests :


INSERT INTO `questions` (`id`, `anonyme`, `titre`, `sujet`, `question`, `pseudo`, `creation`) VALUES
(1, 0, 'Oral', 'IO2', 'Quand passe le groupe 75 ?', 'Jenny', 'le Vendredi 4 Mai 2018 à 20:58:51'),
(2, 1, 'Anonymat', 'Internet', 'Est-ce que vous me voyez en anonyme ?', 'Edd', 'le Vendredi 4 Mai 2018 à 21:00:33'),
(3, 0, 'Equation différentielle du premier ordre', 'Maths', 'Quelle est la formule générale ?', 'Ray', 'le Vendredi 4 Mai 2018 à 21:01:22'),
(4, 0, 'Manger sur Paris', 'Gastronomie', 'Vous connaissez des bons restos abordables sur Paris ?', 'Edd', 'le Vendredi 4 Mai 2018 à 21:01:35'),
(5, 1, 'Polynômes', 'Maths', 'Comment factoriser un polynôme ?', 'Ana', 'le Vendredi 4 Mai 2018 à 21:01:51'),
(6, 0, 'Quizz', 'Culture générale', 'Quelle est la date de naissance de Molière ? (Ne pas tricher)', 'Ana', 'le Samedi 5 Mai 2018 à 12:01:09');

INSERT INTO reponses (signale, id, anonyme, id_question, pseudo, creation, reponse) VALUES
(0,1,1,6, 'Edd', 'le Samedi 5 Mai 2018 à 13:21:12', 'Euh entre les annèes 1000 et 2000 xD'),
(0,2,0,6, 'Ray', 'le Samedi 5 Mai 2018 à 13:21:14', 'Au 17ème siècle.'),
(0,3,0,6, 'Lulu', 'le Samedi 5 Mai 2018 à 13:21:15', 'Salut ! Il est né en 1622 (le 15 janvier 1622) :-)'),
(0,4,0,6, 'gpaul97', 'le Samedi 5 Mai 2018 à 13:21:16', '1625'),
(0,5,0,6, 'Jenny', 'le Samedi 5 Mai 2018 à 13:21:16', '15 janv 1622 :-)'),
(0,6,0,6, 'Nini', 'le Samedi 5 Mai 2018 à 13:23:12', '1622'),
(0,7,0,6, 'Ana', 'le Dimanche 6 Mai 2018 à 13:23:12', 'Question suivante : Quelle est la capitale de la France ?'),
(0,8,0,5, 'Marco', 'le Dimanche 6 Mai 2018 à 13:23:12', 'Il faut trouver les racines'),
(1,9,0,3, 'Sirus', 'le Dimanche 6 Mai 2018 à 13:23:12', 'Je t\'insulte.'),
(0,10,0,3, 'Ray', 'le Dimanche 6 Mai 2018 à 13:23:12', 'Je t\'ai signalé.'),
(0,11,0,2, 'Lulu', 'le Dimanche 6 Mai 2018 à 13:23:12', 'Oui'),
(0,12,0,1, 'admin-1', 'le Dimanche 6 Mai 2018 à 13:23:12', 'Mardi 15 de 17:00 à 17:25 en salle 531C');

-- Source des articles http://www.faux-texte.com
INSERT INTO articles (signale, id, anonyme, pseudo, creation, modification, titre, texte) VALUES
(0,1,0,"Ana", "le Dimanche 6 Mai 2018 à 19:22:41", "le Dimanche 6 Mai 2018 à 19:22:41", "Nihil morati", "Nihil morati post haec militares avidi saepe turbarum adorti sunt Montium primum, qui divertebat in proximo, levi corpore senem atque morbosum, et hirsutis resticulis cruribus eius innexis divaricaturn sine spiramento ullo ad usque praetorium traxere praefecti."  ),
(0,2,0,"Jenny", "le Dimanche 6 Mai 2018 à 19:22:42", "le Dimanche 6 Mai 2018 à 19:23:00", "Nam sole", "Nam sole orto magnitudine angusti gurgitis sed profundi a transitu arcebantur et dum piscatorios quaerunt lenunculos vel innare temere contextis cratibus parant, effusae legiones, quae hiemabant tunc apud Siden, isdem impetu occurrere veloci. et signis prope ripam locatis ad manus comminus conserendas denseta scutorum conpage semet scientissime praestruebant, ausos quoque aliquos fiducia nandi vel cavatis arborum truncis amnem permeare latenter facillime trucidarunt."  ),
(1,3,0,"Marco", "le Dimanche 6 Mai 2018 à 19:22:43", "le Dimanche 6 Mai 2018 à 19:22:43", "Haec subinde", "Haec subinde Constantius audiens et quaedam referente Thalassio doctus, quem eum odisse iam conpererat lege communi, scribens ad Caesarem blandius adiumenta paulatim illi subtraxit, sollicitari se simulans ne, uti est militare otium fere tumultuosum, in eius perniciem conspiraret, solisque scholis iussit esse contentum palatinis et protectorum cum Scutariis et Gentilibus, et mandabat Domitiano, ex comite largitionum, praefecto ut cum in Syriam venerit, Gallum, quem crebro acciverat, ad Italiam properare blande hortaretur et verecunde."  ),
(0,4,1,"Ana", "le Dimanche 6 Mai 2018 à 19:25:00", "le Dimanche 6 Mai 2018 à 19:29:41", "Ipsam vero", "Ipsam vero urbem Byzantiorum fuisse refertissimam atque ornatissimam signis quis ignorat? Quae illi, exhausti sumptibus bellisque maximis, cum omnis Mithridaticos impetus totumque Pontum armatum affervescentem in Asiam atque erumpentem, ore repulsum et cervicibus interclusum suis sustinerent, tum, inquam, Byzantii et postea signa illa et reliqua urbis ornanemta sanctissime custodita tenuerunt"  ),
(0,5,0,"Sirus", "le Dimanche 6 Mai 2018 à 19:27:41", "le Dimanche 6 Mai 2018 à 19:27:41", "Superatis Tauri", "Superatis Tauri montis verticibus qui ad solis ortum sublimius attolluntur, Cilicia spatiis porrigitur late distentis dives bonis omnibus terra, eiusque lateri dextro adnexa Isauria, pari sorte uberi palmite viget et frugibus minutis, quam mediam navigabile flumen Calycadnus interscindit."  ) ;

INSERT INTO likes (id_article, pseudo) VALUES
(1,"Edd"),
(1,"Jenny"),
(1,"Lulu"),

(2,"Ana"),
(2,"Sirus"),
(2,"gpaul97"),
(2,"Ray"),
(2,"Seb2018"),
(2,"Nini"),
(2,"Lulu"),
(2,"Edd"),

(4,"Sirus"),
(4,"Marco"),
(4,"Jenny"),

(5,"Seb2018"),
(5,"gpaul97");


INSERT INTO commentaires (anonyme, id_article, pseudo, creation, commentaire) VALUES
(0,1,'Edd', 'le Dimanche 6 Mai 2018 à 19:25:41', 'Très bon article !'),
(0,2,'Lulu', 'le Dimanche 6 Mai 2018 à 19:25:42', 'Pas mal'),
(0,2,'Ana', 'le Dimanche 6 Mai 2018 à 19:25:43', 'L\'article est bon, mais je ne suis pas d\'accord'),
(0,4,'Marco', 'le Dimanche 6 Mai 2018 à 19:30:44', 'Cool !'),
(1,3,'Jenny', 'le Dimanche 6 Mai 2018 à 13:23:12', 'J\'ai signalé l\'article');
