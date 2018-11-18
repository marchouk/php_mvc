# PHP MVC Chat App

un T’chat, construit sur un modèle MVC.  
Chat réalisé avec PHP5, HTML5, CSS3, Bootstrap3, Jquery et Wampserver.


## Installation

1 - Copier le project dans www/ : 

```bash
git clone https://github.com/marchouk/php_mvc.git
```
2 - Importer la base de données:

Le fichier est dans la racine du projet : ```php_mvc/bash chat_db.sql``` .

Le nom de la bd est ```chat``` .

La configuration de la bd est dans le fichier : ```php_mvc/Config/paramaters.ini``` .

## Usage
1 - Pour utiliser l'app, allez sur ```localhost/php_mvc```, voici les logins :

 ```user 1 = mehdi, password = mehdi``` 

 ```user 1 = anas, password = anas``` 

 ```user 1 = kamal, password = kamal``` 

 ```user 1 = hiba, password = hiba``` 

2 - Après avoir être connecté, vous serez dirigé sur la page qui contient ```la liste des utilisateurs en indiquant ceux qui sont en ligne```. 

Pour discuter avec un utilisateur cliquez sur sa rangée (son nom, image, ...) vous serez dirigé sur la page de T'Chat qui contient ```l'historique de conversation avec cet utilisateur```  , et ```la possibilité de dialoguer avec lui``` .

Pour l'affichage ‘temps réel’ j'ai utiliser AJAX

3 - Sécurité des données

Pour les injections SQL , j'ai  utilisé des requêtes paramétrées

Pour l'injection de code sur la page Web (cross-site scripting) j'ai  utilisé la fonction php htmlspecialchars pour tout paramètre GET ou POST


