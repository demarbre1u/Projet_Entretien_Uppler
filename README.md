# Projet Entretien Uppler #

## A quoi sert ce projet ##

Ce projet a été réalisé à l'issu de l'entretien d'embauche de l'entreprise Uppler.

## Comment installer le projet ##

Pour l'installer, clonez dans un premier temps le projet : 

``
git@github.com:demarbre1u/Projet_Entretien_Uppler.git
``

Une fois cloné, il est nécessaire d'installer les dépendances requises : 

``
composer install
``

Le projet est maintenant prêt à être utilisé !

### Serveur de développement ###

Une fois le projet installer, vous pouvez lancer un serveur de développement grâce à la commande :

``php bin/console server:start``

Pour que les modifs soient visibles en accédant à l'application servit par Nginx, il faut clear le cache :

``php bin/conole cache:clear --env=prod``

### Serveur de production ###

TODO (Config Nginx, hostname, etc)
