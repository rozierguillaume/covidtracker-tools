# covidtracker-tools
Ce dépôt contient les sources de quelques pages de CovidTracker.fr, notamment les outils.
Dépôt concernant la gestion des données et graphiques : [covid-19](https://github.com/rozierguillaume/covid-19).

# Afficher le VaccinTracker dans l'environnement de développement (local)

## Pré-requis
[Docker](https://docs.docker.com/get-docker/)

## Mode opératoire

Afin de faciliter le développement, il est possible de lancer VaccinTracker sur une machine locale.
Pour cela, il faut lancer la commande
```bash
docker-compose up -d
```

Les modifications locales sont alors accessibles à l'adresse http://localhost:8100/VaccinTracker/test.php.
:warning: Les modifications n'entrainent pas un rechargement automatique de la page we. Il faut penser à la rafraîchir manuellement.
