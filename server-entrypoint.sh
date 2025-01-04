#!/bin/sh

symfony console doctrine:migrations:migrate --no-interaction

symfony local:server:start --listen-ip=0.0.0.0 --port=8080 --no-tls
