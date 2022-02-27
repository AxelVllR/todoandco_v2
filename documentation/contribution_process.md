# Process de contribution de ToDo & Co (v2)
    

### Philosophie du projet

Ce projet à été mis à jour en Janvier 2022, nous souhaitons conserver une application pérenne et performante pour nos utilisateurs, c'est pourquoi nous avons décider d'adopter une méthodologie pour la mettre à jour.

## Étapes pour contribuer au projet
### 1 -  Créer une banche

Rien de plus simple, vous créez une branche 'from master', ou vous coderez toutes vos features.

### 2 - Tester

Vous avez terminé de coder votre/vos feature(s). Il vous faut maintenant, tester votre code : 
- Installez l'extension php [XDebug](https://xdebug.org/docs/install), écrivez vos tests puis rendez-vous a la racine du projet et lancez la commande : `php -d xdebug.mode=coverage bin/phpunit --coverage-html=php-unit` 
 Vérifiez que l'output de la commande ne vous retourne AUCUNE erreur, vérifiez également que le code coverage de l'app ne passe pas en dessous de 80%. 

 - Testez les performances de votre feature à l'aide de [blackfire](https://www.blackfire.io/)

  

  

## Merge

Si tout s'est bien passé jusque la, il ne vous restes plus qu'à merge votre branche sur master (Veillez à rebase votre branche depuis master si cela fait quelque temps que vous travaillez sur celle-ci).