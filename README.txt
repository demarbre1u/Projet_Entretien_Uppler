Pour lancer le serveur de dev :
`php bin/console server:start`

Pour que les modifs soient visibles en accédant à l'application servit par Nginx, il faut clear le cache :
`php bin/conole cache:clear --env=prod` 
