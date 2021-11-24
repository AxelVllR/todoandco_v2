# Authentification de ToDo & Co (v2)
## Comprenez le fonctionnement de notre système d'authentification


### Principes de base

Le client souhaitant s'authentifier se rend sur la route '/login' de l'application, ainsi, le formulaire de login lui est renvoyé. vous pouvez y accéder en lançant votre serveur local, rendez-vous sur l'URL suivante
>127.0.0.1:8000/login
>
## Structure de nos fichiers relatifs à l'authentification
- `/src/Controller/SecurityController.php` : Ce controller fonctionne comme un controller symfony standard. Il renvoie la vue lorsque nous souhaitons accéder aux URL
>/login
>/register
>/logout
- `/src/Controller/Security/AppAuthenticator.php` : Ici se trouve toute la logique relative a l'authentification de nos utilisateurs.
 - `/templates/security/login.html.twig` : Vue twig contenant le formulaire de login.
 
## Je souhaite modifier le système d'authentification

Pour se faire, vous allez devoir vous rendre dans le fichier `/src/Controller/Security/AppAuthenticator.php`. Cette classe étend de la classe ***AbstractLoginFormAuthenticator***, composant de Symfony permettant de faciliter et de sécuriser au mieux l'authentification de nos utilisateurs. Dans cette classe ***AppAuthenticator*** vous pouvez observer deux méthodes 

- authenticate : qui gère l'enregistrement des données utilisateur en session lors de son authentification.
- onAuthenticationSuccess : Celle-ci permet de renvoyer l'utilisateur sur la page à laquelle il souhaitait avant qu'il ne soit connecter, sinon, de renvoyer sur une page générale, par exemple : 'homepage'.

## Modifier la partie Front
Si vous souhaitez modifier la partie front du login, il vous suffit de modifier le fichier twig cité plus haut : `/templates/security/login.html.twig` et/ou `/src/Controller/SecurityController.php` 