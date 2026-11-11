# Projet BAWE 2025 - Anitta Kangpaphanh

## Dépendances nécessaires 

- PHP
- PostgreSQL

Ajouter les variables d'environnements correspondantes.

Il faut également avoir de la connexion pour voir les images (images uploadées sur GitHub).

## Création et remplissage de la base de données

### Se connecter à la base de données distante 

Dans un terminal situé dans le dossier du projet :

Connexion simple à la base :
```
psql -h pgsql.pedago.ensiie.fr -U [user] -W
```

Création de la base de données :
```
CREATE DATABASE refugetichats;
```

Accéder à la base :
```
\c refugetichats
```

### Se connecter et remplir la base de données avec les données du fichier /db/dbCreation.sql :

Dans un terminal situé dans le dossier du projet : 
```
psql -h pgsql.pedago.ensiie.fr -U [user] -d refugetichats -f ./db/dbCreation.sql
```

### Créer la base localement 

Création de la base de données :
```
CREATE DATABASE refugetichats;
```

Accéder à la base :
```
\c refugetichats
```

Remplir la base en exécutant chaque requête dans le fichier db/dbCreation.sql

## Lancer le site web

Dans le dossier où se trouve la page à afficher (index.php):

```
php -S localhost:8000
```

Dans le navigateur :

```
http://localhost:8000/<chemin>/projet-bawe-s1/client/index.php
```

## Fichier de configuration pour accéder à la base de données

Remplir le fichier /serveur/config.php avec l'username et le mot de passe.

```
define("DB_USER", <mettre son username>);
define("DB_PASS", <mettre son mdp>);
```