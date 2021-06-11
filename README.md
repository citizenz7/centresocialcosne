# centresocialcosne
centresocialcosne est un projet de site web pour le Centre Social et Culturel Suzanne Coulomb de Cosne-Cours-sur-Loire (58200).
Il est réalisé grâce au framework SYMFONY 5.

## Pré-requis
* PHP 7.4
* MySQL (Mariadb)
* Symfony CLI (5)
* Composer

## Présentation
* Genre : site web
* Langages/technologies/frameworks utilisés : 
    * Symfony 5 (framework)
    * PHP 7.4.3, 
    * MySQL, 
    * Composer, 
    * CSS, 
    * HTML, 
    * Javascript
* Type : site vitrine + blog
* Fonctionnalités : 
    * modulable (chaque "partie" du site peut se voir attribuer une page par simple "sélection"...)
    * espace d'administration avec droits limités (comptes Administrateurs ou Utilisateurs)
    * blog
    * recherche
    * contact
    * lettre d'info (optionnel...)
#### La partie CONNEXION n'est pas "mise en avant". Ce site n'est pas conçu pour l'inscription de membres "extérieurs".

## Initialisation du projet
* Cloner le repo : `git clone https://github.com/citizenz7/centresocialcosne.git`
* configurer le .env.local (MAILER DSN et MySQL)
* Créer la base SQL : `symfony console doctrine:database:create`
* Importer les tables dans la base SQL : `symfony console doctrine:migrations:migrate`
* Installer tous les packages : `composer install`
* Installer CKEditor : `symfony console ckeditor:install`
* Installer les "assets" de CKEditor : `symfony console assets:install public`
* Installer Elfinder (navigateur de fichiers dans CKEditor) : `symfony console elfinder:install`
* Pour passer en PRODUCTION : dans .env.local `APP_ENV=prod`
* Vider le cache : `symfony console c:c`

### Les composants du site :
* Activités : les activités et services proposés par le CS
* Articles : les infos (blog)
* Catégories : les "secteurs" du CS
* Users : les utilisateurs (Utilisateur/Administrateur)
* Pages : présentation "administrative" du CS (ne change que rarement)

# UTILISATION
## Images
Pixabay (https://pixabay.com/fr/) - Images libres et gratuites
* sélectionner l'image -> cliquer sur Télécharger gratuitement -> sélectionner **le deuxième choix** (1280x854 ou taille légèrement différente..., en JPG)
* cliquer sur télécharger -> cocher la case "Je ne suis pas un robot" -> cliquer sur Télécharger
* enregistrer l'image dans un dossier de votre ordinateur (sur votre Bureau par exemple...)
* Sélectionner cette image lors de la création d'un Article, d'une Activité ou d'une Catégorie
## Fichiers (Activités)
Lorsque vous créer une activité, vous pouvez téléverser jusqu'à 3 fichiers au format PDF. Si au moins un fichier a été téléversé, il sera automatiquement affiché en bas du texte de l'activité et sera directement téléchargeable par le visiteur.
#### LES PAGES N'ONT PAS D'IMAGE

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

* Show Categorie : afficher tous les ARTICLES de la catégorie ET toutes les ACTIVITES de la catégorie

* Droits utilisateurs : 
    * attribuer un role "ROLE_USER" a tout nouvel utilisateur ?

* Système de Lettre d'infos [ fonctionnalité facultative ]

* Sidebar : nb d'articles / nb d'activités par catégorie

* Affichage des messages au visiteur : mail ok, enregistrement ok, etc. (flash messages)

* Meta et SEO

* Files upload pour PAGES