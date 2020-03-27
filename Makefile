#!make
 
.DEFAULT_GOAL := help
.PHONY: help
help:
	@echo "\033[33mUsage:\033[0m\n  make [target] [arg=\"val\"...]\n\n\033[33mTargets:\033[0m"
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' Makefile| sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-15s\033[0m %s\n", $$1, $$2}'

.PHONY: bash
bash: ## Get a shell into app container
	docker-compose exec web bash

.PHONY: logs
logs: ## Get a shell into app container
	docker-compose logs -f web

.PHONY: install
install: up ## Install project
	docker-compose exec web composer install
	docker-compose exec web yarn install
	docker-compose exec web yarn production
	docker-compose exec web php artisan migrate
	docker-compose exec web php artisan db:seed

.PHONY: up
up: ## Start containers
	docker-compose up -d

.PHONY: stop
stop: ## Stop containers
	docker-compose stop

.PHONY: restart
restart: ## Restart containers
	docker-compose stop
	docker-compose up -d