# centresocialcosne
centresocialcosne est un projet de site web pour le Centre Social et Culturel Suzanne Coulomb de Cosne-Cours-sur-Loire (58200).
Il est réalisé grâce au framework SYMFONY 5.

## Pré-requis logiciels
* PHP 7.4.3=+
* MySQL
* Symfony CLI (5)
* Composer
* Serveur web (Apache, Nginx)
* Serveur mail SMTP : envoi mail d'inscription, lettres d'infos, etc.
## Pré-requis matériels
Un serveur type VPS avec les caractéristiques minimales suivantes (OVH, Hetzner, Scaleway, etc.) :
* 2 cores
* 4 GB RAM
* 80 GB Disk (la taille du disque permettra de stocker plus ou moins d'images, de fichiers, etc.)
## Présentation
* Genre : site web
* Type : site vitrine + blog
* Langages/technologies/frameworks utilisés : 
    * Symfony 5 (framework)
    * PHP 7.4.3, 
    * MySQL (MariaDB), 
    * Composer (v2), 
    * Bootstrap (v5),
    * CSS, 
    * HTML, 
    * Javascript
* Fonctionnalités : 
    * page d'accueil
    * blog (articles d'actualité par catégorie)
    * présentation des activités par catégorie
    * présentation administrative de la structrure : page
    * recherche par article, activité, page
    * formulaire de contact
    * lettre d'infos
    * espace d'administration avec droits limités (compte Administrateur)
#### La partie CONNEXION n'est pas "mise en avant". Ce site n'est pas conçu pour l'inscription d'utilisateurs "extérieurs" à l'équipe du Centre Social et Culturel.

## Initialisation du projet
* Cloner le repo Github : `git clone https://github.com/citizenz7/centresocialcosne.git`
* Créer et configurer un fichier .env.local (MAILER DSN et MySQL) à la racine
* Créer la base SQL : `symfony console doctrine:database:create`
* Importer les tables dans la base SQL : `symfony console doctrine:migrations:migrate`
* Installer tous les packages : `composer install`
* Installer CKEditor : `symfony console ckeditor:install`
* Installer les "assets" de CKEditor : `symfony console assets:install public`
* Installer Elfinder (navigateur de fichiers dans CKEditor) : `symfony console elfinder:install`
* Pour passer en PRODUCTION : mettre `APP_ENV=prod` dans .env.local 
* Vider le cache : `symfony console c:c`
* Configurer le serveur web (https://symfony.com/doc/current/setup/web_server_configuration.html)
* Vérifier les droits d'accès (répertoires, index.php, ...)

### Les composants du site :
* Activités : les activités et services proposés par le Centre Social et Culturel
* Articles : les infos/actualités (blog)
* Catégories : les "secteurs" du Centre Social et Culturel
* Users : les utilisateurs/l'équipe (Utilisateur/Administrateur)
* Pages : présentation "administrative" du Centre Social et Culturel (ne change que rarement)
* Newsletters : lettre d'infos
* Abonnes : adhérents abonnés à la lettre d'infos

# UTILISATION
## Images (Articles / Activites / Categorie)
Pixabay (https://pixabay.com/fr/) - Images libres et gratuites
* sélectionner l'image -> cliquer sur Télécharger gratuitement -> sélectionner **le deuxième choix** (1280x854 ou taille légèrement différente..., en JPG)
* cliquer sur télécharger -> cocher la case "Je ne suis pas un robot" -> cliquer sur Télécharger
* enregistrer l'image dans un dossier de votre ordinateur (sur votre Bureau par exemple...)
* Sélectionner cette image lors de la création d'un Article, d'une Activité ou d'une Catégorie
## Fichiers (Articles / Activites / Pages)
Lorsque vous créez un article, une activité ou une page vous pouvez téléverser jusqu'à 5 fichiers au format PDF. Si au moins un fichier a été téléversé, il sera automatiquement affiché en bas du texte de l'activité et sera directement téléchargeable par le visiteur.
#### LES PAGES N'ONT PAS D'IMAGE

## Page d'accueil
La page d'accueil (home) possède plusieurs sections. Ces sections sont des PAGES ou une séldction d'articles, d'activités,...
Chaque PAGE se voit attribuer une "option" correspondant à la section choisie :
* **Hero** (A la Une) : petit texte principal de présentation du centre social - accroche avec image. Attribut `A LA UNE`.
* **A propos** : ce texte plus important permet de présenter le centre social plus en détails. Attribut `A PROPOS`.
* **Inscription / Adhésion** : accroche permettant de faire un focus sur les inscriptions/ Adhésions. Attribut `INSCRIPTION`.
* **Services et activités** : sélection des 3 dernières activités publiées, par date.
* **Les dernières infos / Blog** : sélection des 3 derniers articles publiés, par date.
* **Tout le Centre Social** : sélection des 3 dernières pages publiées, par date.
* **Chiffres (count)** : chiffres marquants du centre social...
* **Nous contacter** : coordonnées du centre social avec lien vers formulaire d'envoi de mail
* **Pied de page** : rappel des principaux liens, coordonnées, logo et texte de présentation nen rappoart avec le centre social ou son environnement...
## Articles - Blog
Il s'agit de la partie BLOG (les infos/actualités).
Vous pouvez créer, modifier, supprimer des ARTICLES, en tant qu'administrateur.
Lors de la création d'un article, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (texte principal de l'article)
* une image de présentation (voir la partie Images ci-dessus. Ces images sont préférablement issues de Pixabay)
* vous pourrez choisir jusqu'à 3 fichiers PDF à téléverser. Ces fichiers seront affichés en bas d'article et téléchargeables par les visiteurs.
* une ou plusieurs catégories (pour sélectionner plusieurs catégories, utilisez la touche CTRL de votre clavier)
* définir si l'article est visible ou non (Actif) (pratique si vous devez désactiver l'article, sans le supprimer, ... pour le réactiver plus tard. Ou pour le préparer en avance et l'activer au moment souhaité.)
## Activités
Il s'agit de la partie qui présente tous les services et activités du Centre Social et Culturel.
Lors de la création de l'activité, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (texte principal de l'activité)
* une image de présentation (voir la partie Images ci-dessous. Ces images sont préférablement issues de Pixabay)
* vous pourrez choisir jusqu'à 3 fichiers PDF à téléverser. Ces fichiers seront affichés en bas de l'activité et téléchargeables par les visiteurs.
* une ou plusieurs catégories (pour sélectionner plusieurs catégories, utilisez la touche CTRL de votre clavier)
* définir si l'activité est visible ou non (cf. Articles - Blog).
## Pages
Il s'agit de la partie qui présente le centre social plus en "détails" (technique, administratif).
Lors de la création de la page, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (texte principal de la page)
* vous pourrez choisir jusqu'à 5 fichiers PDF à téléverser. Ces fichiers seront affichés en bas de page et téléchargeables par les visiteurs.
* un "attribut" pour la page (A LA UNE, A PROPOS, etc.). Permettra de positionner la page sur la page d'accueil.
* définir si la page est visible ou non (cf. Articles - Blog).
## Catégories
Il s'agit de la partie qui présente les "secteurs d'activité" du Centre Social et Culturel.
Cette partie est commune aux Articles et aux Activités.
Lors de la création de la catégorie, vous devrez choisir OBLIGATOIREMENT :
* un titre
* un contenu (petit texte de présentation de la catégorie)
* une image de présentation (cf. Articles)
## Barre de menu
La barre de menu (top menu) possède plusieurs liens qui orientent le visiteur vers des sections de la page d'Accueil.
Si vous êtes connecté(e), un lien supplémentaire avec votre prénom et un menu déroulant apparait.
## Connexion / Inscription
### Connexion
Le site n'étant pas prévu pour l'inscription d'utilisateurs "extérieurs" à l'équipe du Centre Social et Culturel, le lien de connexion à l'espace personnel et d'administration (si rôle Administrateur) est remisé dans le pied de page.
Si vous possédez un compte, vous pouvez vous connecter avec votre e-mail + mot de passe.
Une fois connecté, un nouveau lien apparait dans la barre de menu avec votre prénom.
Selon votre ROLE, vous pourrez :
* Utilisateur : vous rendre sur votre page de profil, vous déconnecter
* Administrateur : vous rendre sur l'espace d'administration du site, vous rendre sur votre page de profil, vous déconnecter
### Inscription
Un lien d'inscription apparait sur la page CONNEXION. Il vous permet de créer un compte.
Il faudra définir avec l'équipe du Centre Social et Culturel si ce lien est utile et s'il ne constitue pas un "problème" de sécurité (en effet, il n'est pas du tout souhaitable que les visiteurs aient accès à ce lien et puissent créer un compte, ce n'est pas l'objectif de ce site).
Lors de l'inscription vous renseignerez les infos suivantes :
* adresse e-mail
* prénom
* nom
* mot de passe
* Petit text de présentation (facultatif mais conseillé)
* image de profil (facultatif... mais conseillé)
* fonctions au centre social
* profils Facebook/Twitter/Instagram (facultatif)
Vous devrez cocherla case d'acceptation des CGU / Mentions légales
Vous devrez enfin valider votre adresse e-mail grâce à un lien qui vous sera envoyé par mail.

Par "défaut", tout nouvel utilisateur possède le ROLE `Utilisateur` (ROLE_USER) et n'a pas accès à l'espace d'administration.
Il faut une intervention manuelle, dans la base de données, pour passer un utilisateur en Administrateur (ROLE_ADMIN). A Définir.
## Administration
Si vous avez le ROLE "Administrateur" vous pourrez gérer différentes sections :
* création/édition/suppression d'articles
* création/édition/suppression d'activités
* création/édition/suppression de pages
* création/édition/suppression de catégories
* création/édition/suppression d'utilisateurs
* création/édition/suppression de lettres d'infos
* création/édition/suppression d'abonnés à la lettre d'infos

Une fois connecté, vous aurez accès à l'espace d'administration grâce au nouveau lien `Administration` qui apparaitra dans le menu principal (menu déroulant en-dessous de votre prénom).
## Formulaire de contact
Un formulaire de contact est accesible à tous les visiteurs sur le site depuis le bas de la page d'accueil.
Le formaulaire de contact est protégé des robots informatiques par un antispam "captcha".
Le mail ainsi envoyé arrive dans la boite mail du Centre Social et Culturel (adresse finale à définir).
## Lettre d'infos
* Système manuel de Lettre d'infos 
    * La lettre d'info permet de créer un texte avec un titre, un contenu et des images et de l'envoyer à des abonnés.
    * Il s'agit d'un système manuel. Il ne se base pas sur les articles du site et le texte qui sera envoyé est totalement libre. Les abonnés sont inscrits un par un par l'administrateur.
    * La lettre d'info créée peut être mise en attente ou envoyée.
    * Une fois cliqué sur le bouton ENVOYER, la lettre d'info est envoyée à TOUS les abonnés, par e-mail.