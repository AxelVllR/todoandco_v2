
  

# Projet 8 - OpenClassrooms - ToDo & Co
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/d6834e4f5c0a4d20ba0693ed986548c9)](https://www.codacy.com/gh/AxelVllR/todoandco_v2/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=AxelVllR/todoandco_v2&amp;utm_campaign=Badge_Grade)
## _Parcours Développeur d'application - PHP / Symfony_

  
  

### Descriptif du besoin

Améliorer la qualité de l’application. La qualité est un concept qui englobe bon nombre de sujets : on parle souvent de qualité de code, mais il y a également la qualité perçue par l’utilisateur de l’application ou encore la qualité perçue par les collaborateurs de l’entreprise, et enfin la qualité que vous percevez lorsqu’il vous faut travailler sur le projet.

  

## Documentation dédiée aux développeurs

- Comment procéder pour modifier le code de l'app : [Cliquez-ici](https://github.com/AxelVllR/todoandco_v2/blob/main/documentation/contribution_process.md) 

- Le système d'authentification : [Cliquez-ici](https://github.com/AxelVllR/todoandco_v2/blob/main/documentation/authentication.md)

- Comprendre les fichiers de symfony : Dans ce projet, nous avons généré une documentation, vous permettant de comprendre chacun des Controllers / Entities de ce projet Symfony. 
Pour la visionner, une fois le repo cloné sur votre machine, ouvrez le fichier index.html inclu dans le dossier /documentation/file_system, ou alors, si vous utilisez Google Chrome, rendez vous dans le terminal, a la racine du projet, et lancez la commande `google-chrome documentation/file_system/index.html`.

  
## Performances (Blackfire)

Si vous souhaitez visionner les profilages que j'ai pu effectuer sur chacune des routes de l'app :

  - [Connexion](https://blackfire.io/profiles/deb38f3d-76fc-4c93-b137-afa14f86e8b5/graph)
  - [Création d'un utilisateur](https://blackfire.io/profiles/5ae475ae-f51e-4bea-b03e-b97626ef152e/graph) (ADMIN)
  - [Liste des utilisateurs](https://blackfire.io/profiles/553a84cd-89ed-410f-b9a2-f74f390d1d85/graph) (ADMIN)
  - [Création d'une tache](https://blackfire.io/profiles/c7a3ddc8-f815-4c6f-97d4-e04338454ec6/graph)
  - [Liste des taches](https://blackfire.io/profiles/dc4ca6fa-4bf7-49e2-8e7e-b3d8d27a6edd/graph)
  - [Edition d'une tache](https://blackfire.io/profiles/deb38f3d-76fc-4c93-b137-afa14f86e8b5/graph)

## Installer le Projet

  

- Clonez le Repo sur votre machine

- Rendez-vous dans l'invite de commande, puis dans le dossier du projet, lancez la commande

```sh

composer install

```

- Modifiez le fichier .env à la racine du projet afin d'entrer votre configuration (DATABASE_URL).

  

- Lancez les commandes suivante :

```

php bin/console d:d:c (creation de la db)

php bin/console d:m:m (Migrations)

php bin/console doctrine:fixtures:load (enregistrement des données de tests)

```

  

- Il ne vous restes plus qu'à lancer le serveur :

  

```

php bin/console server:run OU symfony serve

```

  

- Accédez à l'url '127.0.0.1:8000' afin de visualiser l'app

  

- ENJOY !

## Identifiants de l'utilisateur par défaut

  

MAIL :

  

> test@gmail.com

  

Mot de passe :

  

> test