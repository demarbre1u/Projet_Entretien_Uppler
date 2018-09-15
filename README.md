# Projet Entretien Uppler #

## Description ##

Ce projet a été réalisé à l'issu de l'entretien d'embauche de l'entreprise Uppler.

Réalisé par Allan DEMARBRE.

## Comment installer le projet ##

Pour l'installer, clonez dans un premier temps le projet : 

``
git clone git@github.com:demarbre1u/Projet_Entretien_Uppler.git
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

Pour créer la base de données :

``php bin/console doctrine:database:create``

Pour créer les tables :

``php bin/console doctrine:schema:update --force``

Pour supprimer les tablles : 

``php bin/console doctrine:schema:drop --force``

### Serveur de production ###

TODO (Config Nginx, hostname, etc)
