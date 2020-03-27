# Lits de réanimation COVID-19


Première application dédiée aux professionnels de santé à la recherche d’un lit de réanimation pour leurs malades COVID+.

## Installation (via Docker)

```
git clone git@github.com:rleger/covidrea.git
cd covidrea
make install
```

Plusieurs containers seront disponibles : 

* http://localhost:8000 : Application
* http://localhost:8001 : Adminer (gestion base de données)
* http://localhost:8002 : Mailcatcher (outil de test d'emails)

Commandes utiles :

* `make stop` : Stoppe les containers en cours
* `make up` : (Re) Lance les containers
* `make bash` : Attache le terminal au container

## Contribuer : 

1. **Fork** ce repository sur GitHub
2. **Cloner** le projet forké sur votre machine
3. **Effectuez** les changements souhaités et pushez sur votre branche
4. **Créez** votre pull request

**NOTE: Assurez vous de vous baser sur la branche `develop` avant tout développement et création de pull request**