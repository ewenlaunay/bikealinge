# bikealinge
#Création du projet

`composer create-project symfony/website-skeleton salutem`

Créer fichier .env.local et copier la ligne de la DATABASE. Remplir avec les informations correspondantes

#Installer le WebPack Encore

`composer require symfony/webpack-encore-bundle`

`npm install`

#Activer SASS

Décommenter la ligne suivante du fichier webpack.config.js

`.enableSassLoader()`

Renommer le fichier assets/css/style.css enassets/css/style.scss

Modifier la ligne suivante dans le fichier assets/js/app.js

`import '../css/app.scss';`

Installer les dépendances pour SASS puis compiler les fichiers

`npm install sass-loader@^7.0.1 node-sass --save-dev`

`npm run watch`

#Intégrer le code HTML dans les fichiers Twig

Créer un controller pour la page d'accueil

`php bin/console make:controller DefaultController`

#Création des entités

Créer la base de données avec MySQL Workbench

Créer les classes (entités) PHP

`php bin/console make:entity`

Créer le fichier de migration

`php bin/console make:migration`

Exécuter les migrations

`php bin/console doctrine:migrations:migrate`

#Création des données de test

`composer req --dev orm-fixtures`

Générer des fichiers de fixtures

`php bin/console make:fixtures`

Exécuter les fixtures :

`php bin/console doctrine:fixtures:load`
