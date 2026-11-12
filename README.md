# Réservation Animaux - Architecture Multi-Bases

Ce projet est une application web conteneurisée permettant de gérer des réservations d'animaux. Il démontre la persistance simultanée des données vers une base de données relationnelle et un magasin de données en mémoire.

## Architecture Technique
* **web** : Serveur web Apache avec image PHP (compilation pdo_pgsql et redis).
* **postgres** : Base de données relationnelle (PostgreSQL).
* **redis** : Base NoSQL en mémoire (Redis).

## Déploiement
`docker compose up -d --build`

## Dépendances
* Docker
* Docker Compose

## Informations Base de Données
* **Nom de la base** : db_refuge
* **Nom d'utilisateur** : admin_refuge

## Auteur
**Anitta KANGPAPHANH**
**Ilian JEAN**
