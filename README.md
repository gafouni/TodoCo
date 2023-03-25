## Description
* ToDo Co est une application permettant de gerer ses tâches quotidiennes, ce projet a pour objectif d'apprendre à améliorer la qualité d'une application déjà existante.  
## Environnement de développement  
* PHP 8.2.0  
  Symfony 6.2  
  Les diagrammes UML se trouvent dans le dossier "Diagrams".  

---------------------------------
## Installation
* Cloner le depot:  git clone git@github.com:gafouni/TodoCo.git
* Telecharger les dependances:  
  composer install
  
* Parametrer la base de donnees:  
  editer le fichier intitule ".env", modifier les valeurs de parametrage de la base de donnees 
  
* Creer la base de donnees:  
  importer le fichier "todoco.sql" situe a la racine du projet

* Installez les fixtures pour avoir une démo de données fictives en développement :  
  php app/console doctrine:fixtures:load 
  
* Lancer le projet:  
  lancer le serveur de developpement (Xampp ou autre)  
  lancer le serveur de symfony: symfony server:start  

* Tests coverage:  
 Pour générer le test coverage, exécuter cette commande:  
 ./vendor/bin/phpunit --coverage-html Coverage_report  
 Pour consulter le résultat, ouvrez dans le navigateur le fichier "Coverage_report/index.html" situé à la source du projet  

* Documentation technique:  
  Lien vers le guide de l'authentification: Documentation/guide_authentification.pdf  
  Lien vers la documentation technique de contribution: CONTRIBUTING.md (A la racine du projet)
  ou encore dans le dossier Documentation  
  Lien vers l'audit de performance du site: Documentation/audit_de_performance.pdf
  Lien vers l'audit de qualité du code:  https://app.codacy.com/gh/gafouni/TodoCo/dashboard?branch=main
 
