![YouCook](https://media.discordapp.net/attachments/1139998900468592740/1173342915825778768/output-onlinepngtools.png?ex=65639bbe&is=655126be&hm=66bb8ec9aa7d7c3973f31736b9dae541cf87b5d0284eb6ddfe54cfaa171a7267&=)

# SAé 4.01 - YouCook (Back-end)

![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![API Platform](https://img.shields.io/badge/API%20Platform-333.svg?style=for-the-badge&logo=api-platform&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

YouCook est un site web de recettes de cuisine. Il permet de consulter des recettes, de les filtrer par catégorie, de les trier par nom, de les rechercher par nom et de les noter. Il permet également de créer un compte utilisateur, de se connecter et de créer des recettes.

## Pré-requis

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Symfony CLI](https://symfony.com/download)
- [Composer](https://getcomposer.org/)

## Installation / Configuration

1. Clonez le dépôt distant sur votre ordinateur

```shell
git clone https://iut-info.univ-reims.fr/gitlab/minn0004/sae4-01-api.git
```

2. Rendez-vous dans le répertoire du projet

```shell
cd sae4-01-api/
```

3. Installez les différentes dépendances du projet

```shell
composer install
```

4. Créez le fichier `.env.local` à partir du fichier `.env` et modifiez les variables d'environnement

5. Lancez les conteneurs Docker

```shell
docker compose up -d
```

## Serveur web local

Vous pouvez lancer le serveur web local en exécutant la commande suivante :

```shell
composer start
```

## Style de codage

Nous suivons les bonnes pratiques de `Symfony`, afin de vérifier la conformité du code veuillez taper la commande suivante :

```shell
composer test:cs
```

Afin de corriger votre code selon les standards de Symfony, veuillez taper :

```shell
composer fix:cs
```

## Données factices

Afin de générer le jeu de données de l'application, veuillez taper la commande suivante :

```shell
composer db
```

## Tests

Afin de lancer les tests de l'application, veuillez taper la commande :

```shell
composer test
```

## Style de l'application

Afin de charger le style de l'application faite grâce à TailwindCSS, veuillez exécuter la commande :

```shell
npm run watch
```
