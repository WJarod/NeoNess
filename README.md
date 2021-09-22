# NeoNess
Formation BeWeb comprendre le MVC : Projet NeoNess 


               EVALUATION
              PHP/MYSQL
1. PRÉSENTATION DU PROJET
Votre nouveau client NeoNess (salles de sport) vous demande de lui proposer une mini-application permettant de suivre l’évolution de l’activité de chaque inscrit au club.
Le site web se décline en 3 pages incluant les fonctionnalités suivantes :
- page d’accueil (index) : permet d’enregistrer un nouvel utilisateur et/ou d’entrer les références de l’utilisateur. Pour une première inscription, l’utilisateur doit entrer certaines informations (nom, prénom, tel, âge, poids, taille, objectif de poids ) et son mot de passe. On pourra calculer ainsi l’IMC de chaque individu à chaque instant. (formule IMC : poids / (taille au carré), normal entre 18,5 et 25)
L’utilisateur inscrit peut, suite à la saisie correcte de ses identifiants, accéder à sa page individuelle de suivi, même si sa connexion précédente a été interrompue (cookies+session pris en charge)
- page personnelle : permet de préciser l’activité du jour et la restitution sous forme tabulaire (et en option graphiquement) de l’évolution de son activité. L’utilisateur précise à partir d’un formulaire l’activité et le temps de pratique (voir icônes fournies), par exemple « 2h de vélo » ou « 10mn d’haltères », et on proposera sous
     beWeb par Fondespierre – 291 chemin de Fondespierre, 34160 Castries

 forme de tableau dynamique (modifiable) une visualisation de l’activité journalière. Une fois ce tableau finalisé, l’utilisateur pourra valider son activité en postant les informations de ce tableau. Tout sera stocké en base de données pour présenter le récapitulatif global de l’activité sur une période plus importante (1 semaine / 1 mois)
On pourra également inclure une projection de l’IMC pour proposer à l’utilisateur une activité en fonction de ses objectifs si ils ne sont pas remplis.
On trouvera une présentation graphique sous forme de diagramme avec comme axe horizontal (abscisse) le temps et en axe vertical (ordonnée) l’indice IMC.
- page d’administration (back-office) :
- L’utilisateur-administrateur a un compte déjà enregistré et unique,
permettant d’afficher l’ensemble des données des utilisateurs (sous forme de tableau/liste), et de modifier les informations individuellement.
- Etapes de réalisation :
- analyser et formaliser les problématiques et leurs solutions
- préparer/modéliser les données et les tables correspondantes
- implémenter les fonctions de back-end (crud) des données
- implémenter les fonctions de front-end pour gérer les affichages et les formulaires - proposer une maquette fonctionnelle dont la finalisation déterminera votre note
En annexe sont fournies les icônes des sports proposés, avec pour chaque sport, la consommation moyenne d’énergie pour une heure de pratique, ceci permettra de calculer la perte de poids selon une formule à expliciter ...
beWeb par Fondespierre – 291 chemin de Fondespierre, 34160 Castries
