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

init: start
		docker-compose exec php composer install
		docker-compose exec node yarn install
		make migrate
		make build-front

clean:
		docker system prune -f

clean-hard:
		docker system prune -a --volumes -f
# End of - Docker commands.

# Backend commands.
enter-back:
		docker-compose exec php bash

clear-cache:
		docker-compose exec php bin/console c:c

generate-migration:
		docker-compose exec php bin/console d:m:diff

migrate:
		docker-compose exec php bin/console d:m:m -n

user-register:
		docker-compose exec php bin/console app:user:register $(filter-out $@,$(MAKECMDGOALS))
# End of - Backend commands.

# Frontend commands.
enter-front:
		docker-compose exec node bash

build-front:
		docker-compose exec node npm run build
# End of - Frontend commands.
