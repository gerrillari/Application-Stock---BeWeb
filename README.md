<<<<<<< HEAD
# APPLICATION-STOCK

Accès au repository GitHub du projet : https://github.com/gerrillari/Application-Stock---BeWeb

# Objectif

Concernant le projet interne des CDA (Pauline Ricard) sur un site e-commerce, nous avons divisé le cadre de travail en 4 fonctionnalités :

e-commerce : vente en ligne des produits
application des tests des produits : chaîne de production
gestion des employés (RH) : intégration des nouveaux employés et pointage
gestion du stock : stock de matière première qui évolue vers le produit fini
Notre groupe concerne la gestion du stock.

Ca concerne la gestion des stock, la gestion des flux entrants (livraisons) et des flux sortants (commandes). Ainsi que l'information relative aux entrepôts et produits, mais aussi les commandes-livraisons. Nous avons 3 objets principaux : produits, flux et entrepôts.

Les produits ça va concerner visualiser les informations de chaque produit (prix, quantité, description,...), alerter lorsque le stock d'un produit est insuffisant qui ira vers le dashboard afin de pouvoir modifier les commandes et livraisons, connaître la disponibilité par entrepôt et un graphe avec les informations relatives au stock de ce produit et ses commandes-livraisons.
Les flux ça va concerner les commandes et livraisons. Plus précisément, les informations relatives aux commandes-livraisons (origine-destination) en cours et la modification des livraisons (comme sa destination).
Les entrepôts ça va concerner les informations relatives aux différents entrepôts (adresse, statut,...), le détail par entrepôt comme où il est situé, un graphe avec les informations relatives au stock des produit et les commandes-livraisons dans le temps, ainsi qu'une liste des produits disponibles dans cet entrepôt.

# Organisation

Le projet dure 2 semaines (14 au 25 juin 2021) et on travaille en méthode AGILE, ce qui veut dire que chaque matin on fait un daily scrum de 5 minutes afin de raconter ce qu'on a fait la veille, remonter les difficultés et dire notre programme de la journée. Ainsi, le vendredi 18 juin on va faire une rétrospective de la semaine de 16h30 à 17h, ainsi il faudra envoyer un mail personnel à Loïc avec notre rétrospective de la semaine. Lundi 21 juin on fera un SCRUM pour fixer les objectifs de la semaine et vendredi 25 juin on fera une autre rétrospective de la semaine et la présentation du projet dans l'après-midi.

1 interlocuteur par groupe. 1 branche = 1 feature. Chaque soir à 16h30 il faudra pousser nos commits.

Tous les 3 allons réaliser à peu près le même type de travail de développement web mais sur différents objets :
- Valentin s'occupe des flux entrants et sortants.
- Alexandre s'occupe des produits.
- Tamara s'occupe des entrepôts.

# Agenda

La première semaine va consister en le maquettage de l'interface utilisateur (vues + component -> zoning + wireframing), la conception de la BDD (MCD + MLD + MySQL), la mise en place de la WIKI dans GIT, la mise en place de notre espace de travail et la réflexion (pseudo-code) sur les méthodes à utiliser, les requêtes, les controlleurs, les modèles, ... afin que la semaine suivante on se concentre sur traduire tout ceci sous forme de code sans avoir à perdre du temps sur comment faire.

La deuxième semaine va consister en l'implémentation : coder. On verra aussi ensemble la partie du login et les droits d'accès.

# Fonctionalitées

Permettre à un utilisateur de suivre le stocks, et l'évolution du stock de ses produits.
Permettre à un utilisateur de suivre le stocks, et l'évolution du stock de ses entrepôts.
Permettre à un utilisateur de suivre les livraison en direction des entrepôts et de pouvoir les modifier.

# Membres de l'équipe :
- Tamara ALCALA JIMENEZ
- Alexandre LABSI
- Valentin CREUILLENET

# Technologies présentes dans le projet :
- Bootstrap 4
- Chart JS
- Docker et container PHP.8.0-apache
- Framework beWeb PHP MVC
- MySQL Workbench
- SGBDR mysql dans un container Docker

# Database

![image](https://user-images.githubusercontent.com/36443636/129893757-ff91e434-08fb-447b-b162-7054eaa5822e.png)
