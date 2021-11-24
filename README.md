
# Projet 8 - OpenClassrooms - ToDo & Co
## _Parcours Développeur d'application - PHP / Symfony_


### Descriptif du besoin
Améliorer la qualité de l’application. La qualité est un concept qui englobe bon nombre de sujets : on parle souvent de qualité de code, mais il y a également la qualité perçue par l’utilisateur de l’application ou encore la qualité perçue par les collaborateurs de l’entreprise, et enfin la qualité que vous percevez lorsqu’il vous faut travailler sur le projet.

## Documentation dédiée aux développeurs
- Comment procéder pour modifier le code de l'app : (Soon)
- Le système d'authentification : [Cliquez-ici](https://github.com/AxelVllR/todoandco_v2/blob/main/documentation/authentication.md)


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

