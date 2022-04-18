# Projet PHP-2020
 
Projet individuel de fin d'année réalisé dans le cadre du cours de PHP durant l'année 2019-2020. Le sujet était libre, mais devait être approuvé par le professeur.

## Conception

Les langages autorisés pour ce projet étaient HTML, CSS, Javascript. L'utilisation de Bootstrap était tolérée. PHP était obligatoire. L'utilisation du Design pattern MVC n'était pas requise mais fortement appréciée.

## Base de données MySQL

* Le site devait comprendre une base de données avec au moins trois tables, dont une pour les utilisateurs.
* Il était nécessaire de prévoir une gestions es utilisateurs.
* Les opérations de bases (CRUD) pour les tables devaient être prévues.
* Un utilisateur devait être représenté par un nom, un prénom, une adresse mail et un mot de passe.
* Tout usilisateur devait pouvoir s'enregistrer avec un profil de type « Utilisateur » et devait avoir le droit d'exploiter les fonctionalités du site.
* La connexion devait se faire avec le couple adresse mail / mot d passe.
* Un Administrateur devait être créé, ayant accès à toute la base de données. Le utilisateurs n'avait pas accès à l'entireté de la table.

## Validité & Compatibilité

* Respect des normes W3C
* Le site devait être compatible avec les principaux navigateurs.

## Fonctionnalités requises

* Un Visiteur devait pouvoir consulter le site, se créer un compte ou se connecter
* Un Utilisateur devait pouvoir :
    * Se dé/connecter (session)
    * Modifier ses informations privées
    * Ajouter/Modifier/Supprimer des informations dans au moins deux tables
    * Supprimer définitivement son compte et tous les données liées
    * Communiquer avec l'administrateur
* Un Administrateur devait pouvoir :
    * Accéder aux information d'un client et les modifier
    * Réinitialiser le mot de passe d'un utilisateur
    * Supprimer/bannir un utilisateur
    * Ajouter/Editier/Supprimer du contenu au site
* En terme de sécurité :
    * Les accès devait être sécurisé (Mais il ne fallait pas implémenter HTTPS)
    * La base de Données devait être protégée de toute injection
    * Les données devaient être vérifiées
    * Un utilisateur non logué ne devait pas avoir accès aux données du site
