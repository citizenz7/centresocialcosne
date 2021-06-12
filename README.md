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
La page d'accueil (home) possède plusieurs sections. Ces sections sont des PAGES ou une séldction d'articles, d'activités,...
Chaque PAGE se voit attribuer une "option" correspondant à la section choisie :
* Hero (A la Une) : petit texte principal de présentation du centre social - accroche avec image. Attribut `A LA UNE`.
* A propos : ce texte plus important permet de présenter le centre social plus en détails. Attribut `A PROPOS`.
* Inscription / Adhésion : accroche permettant de faire un focus sur les inscriptions/ Adhésions. Attribut `INSCRIPTION`.
* Services et activités : sélection des 3 dernières activités publiées, par date.
* Les dernières infos / Blog : sélection des 3 derniers articles publiés, par date.
* Tout le Centre Social : sélection des 3 dernières pages publiées, par date.
* Chiffres (count) : chiffres marquants du centre social...
* Nous contacter : coordonnées du centre social avec lien vers formulaire d'envoi de mail
* Pied de page : rappel des principaux liens, coordonnées, logo et texte de présentation nen rappoart avec le centre social ou son environnement...
## Articles - Blog
Il s'agit de la partie BLOG (les infos). Le nom ARTICLE est utilisé pour cette fonctionnalité.
Vous pouvez créer, modifier, supprimer des ARTICLES, en tant qu'administrateur.
Lors de la création d'un article, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (texte principal de l'article)
* une image de présentation (voir la partie Images ci-dessous. Ces images sont préférablement issues de Pixabay)
* une ou plusieurs catégories (pour sélectionner plusieurs catégories, utilisez la touche CTRL de votre clavier)
* définir si l'article est visible ou non (pratique si vous devez désactiver l'article, sans le supprimer, ... pour le réactiver plus tard. Ou po=ur le préparer en avance et l'activer au moment souhaité.)
## Activités
Il s'agit de la partie qui présente tous les services et activités du centre social.
Lors de la création de l'activité, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (texte principal de l'activité)
* une image de présentation (voir la partie Images ci-dessous. Ces images sont préférablement issues de Pixabay)
* vous pourrez choisir jusqu'à 3 fichiers PDF à téléverser. Ces fichiers seront affichés en bas d'article et téléchargeables par les visiteurs.
* une ou plusieurs catégories (pour sélectionner plusieurs catégories, utilisez la touche CTRL de votre clavier)
* définir si l'activité est visible ou non (cf. Article).
## Pages
Il s'agit de la partie qui présente le centre social plus en "détails" (technique, administratif).
Lors de la création de la page, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (texte principal de la page)
* un "attribut" pour la page (A LA UNE, A PROPOS, etc.). Permettra de positionner la page sur la page d'accueil.
* définir si la page est visible ou non (cf. Article).
## Catégories

## Connexion

## Administration

### Création

### Modification

### Suppression

### Listes


# A FAIRE

* Sidebar : nb d'articles / nb d'activités par catégorie

# FACULTATIF - A DEFINIR

* Système de Lettre d'infos [ facultatif - A développer ]
    * périodicité : mensuelle
    * entité : Article
    * inscription / désinscription : e-mail avec stockage dans la base SQL
    * si au moins un nouvel article a été publié durant les 30 derniers jours : envoi d'une newsletter (avec titre, date, auteur, extrait, lien)
    * possibilité d'envoyer tous les articles parus depuis l'envoi de la dernière newsletter