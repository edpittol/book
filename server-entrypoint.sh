#!/bin/sh

/usr/local/bin/php bin/console doctrine:database:create
/usr/local/bin/php bin/console doctrine:migrations:migrate

/usr/local/bin/php -S 0.0.0.0:8080 --docroot /app/public
