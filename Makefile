# Default ENV
ENV ?= local

COMPOSE = docker compose --env-file .env.$(ENV) \
	-f Docker/docker-compose.yml \
	-f Docker/$(ENV)/docker-compose.override.yml

init:
	@if [ ! -f .env.$(ENV) ]; then cp .env.$(ENV).example .env.$(ENV); fi
	$(COMPOSE) run --rm app composer install
	$(COMPOSE) run --rm app npm install
	$(COMPOSE) run --rm app php artisan key:generate

up:
	$(COMPOSE) up -d --build
	$(COMPOSE) exec app php artisan migrate
	ifeq ($(ENV),local)
		$(COMPOSE) exec app php artisan db:seed
	endif

down:
	$(COMPOSE) down -v --remove-orphans

restart:
	$(MAKE) down ENV=$(ENV)
	$(MAKE) up ENV=$(ENV)

logs:
	$(COMPOSE) logs -f

ps:
	$(COMPOSE) ps

sh:
	$(COMPOSE) exec app bash

migrate:
	$(COMPOSE) exec app php artisan migrate

migrate-fresh:
	$(COMPOSE) exec app php artisan migrate:fresh

seed:
	$(COMPOSE) exec app php artisan db:seed

cache-clear:
	$(COMPOSE) exec app php artisan config:clear
	$(COMPOSE) exec app php artisan route:clear
	$(COMPOSE) exec app php artisan view:clear
	$(COMPOSE) exec app php artisan cache:clear


npm-dev:
	$(COMPOSE) exec app npm run dev

npm-build:
	$(COMPOSE) exec app npm run build
