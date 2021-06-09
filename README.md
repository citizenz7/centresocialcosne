# centresocialcosne
centresocialcosne est un projet de site web pour le Centre Social et Culturel Suzanne Coulomb de Cosne-Cours-sur-Loire (58200).

## Pré-requis
* PHP 7.4
* MySQL (Mariadb)
* Symfony CLI (5)
* Composer

## Initialisation du projet
* git clone
* configurer le .env.local (MAILER DSN et MySQL)
* symfony console doctrine:database:create
* symfony console doctrine:migrations:migrate
* composer install
* symfony console ckeditor:install
* symfony console assets:install public
* symfony console elfinder:install
* symfony serve -d

## Présentation
* Genre : site web
* Langage/technologie/framework utilisé : PHP (Symfony 5), MySQL
* Type : site vitrine + blog
* Particularité : semi-modulable (chaque "partie" du site peut se voir attribuer une page par simple "sélection"...)
* comptes Administrateurs ou Utilisateurs
* partie administration avec droits limités
* la partie CONNEXION n'est pas "mise en avant". Ce site n'ets pas conçu pour l'inscription de membres "extérieurs"

### Les composants du site :
* Activités : les activités et services proposés par le CS
* Articles : les infos (blog)
* Catégories : les "secteurs" du CS
* Users : les utilisateurs (Utilisateur/Administrateur)
* Pages : présentation et composantes du CS (ne change que rarement)

# A FAIRE
* public index pour Activite
* public index pour Page
* public index pour Categorie

* Liste des articles pour l'admin avec Création/Edition/Suppression
* Liste des activités pour l'admin avec Création/Edition/Suppression
* Liste des pages pour l'admin avec Création/Edition/Suppression
* Liste des catégories pour l'admin avec Création/Edition/Suppression
* Liste des users pour l'admin avec Création/Edition/Suppression

* Système de recherche

* Système de Contact (mail)

* Système de Lettre d'infos

* Sidebar : nb d'articles / nb d'activités par catégorie
