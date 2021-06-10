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

# UTILISATION
## Images
Pixabay (https://pixabay.com/fr/) - Images libres et gratuites
* sélectionner l'image -> cliquer sur Télécharger gratuitement -> sélectionner le deuxième choix (1280x854 ou taille légèrement différente..., en JPG
* cliquer sur télécharger -> cocher la case "Je ne suis pas un robot" -> cliquer sur Télécharger
* enregistrer l'image dans un dossier (sur votre Bureau par exemple...)
* Sélectionner cette image lors de la création d'un Article, d'une Activité ou d'une Catégorie
## Fichiers (Activités)
Lorsque vous créer une activité, vous pouvez téléverser jusqu'à 3 fichiers de PDF. Si au moins un fichier a été téléversé, il sera automatiquement afficher en bas du texte de l'activité et sera directement téléchargeable par le visiteur
### LES PAGES N'ONT PAS D'IMAGE

## Page d'accueil

## Articles - Blog

## Activités

## Pages

## Catégories

## Connexion

## Administration
### Création

### Modification

### Suppression

### Listes


# A FAIRE
* public index pour Activite

* Liste des activités pour l'admin avec Création/Edition/Suppression

* Show Categorie : afficher tous les ARTICLES de la catégorie ET toutes les ACTIVITES de la catégorie

* Droits utilisateurs : 
    * attribuer un role "ROLE_USER" a tout nouvel utilisateur ?

* Système de recherche

* Système de Contact (mail)

* Système de Lettre d'infos

* Sidebar : nb d'articles / nb d'activités par catégorie

* Affichage des messages au visiteur : mail ok, enregistrement ok, etc. (flash message)

* suppression FILES on Update pour Activite
