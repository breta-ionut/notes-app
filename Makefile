# Docker commands.
start:
		docker-compose up -d

start-rebuild:
		docker-compose up -d --build

stop:
		docker-compose down

restart: stop
		make start

restart-rebuild: stop
		make start-rebuild

configure-env-vars:
		cp -f .env.dist .env

reload-env-vars: configure-env-vars
		make restart

init: configure-env-vars
		make start
		docker-compose exec php composer install
		docker-compose exec node npm install

clean:
		docker system prune -f

clean-hard:
		docker system prune -a --volumes -f
# End of - Docker commands.

# Backend commands.
enter-back:
		docker-compose exec php bash

generate-migration:
		docker-compose exec php bin/console d:m:diff

migrate:
		docker-compose exec php bin/console d:m:m
# End of - Backend commands.
