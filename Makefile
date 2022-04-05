# Start dev environment
up:
	docker-compose -f .docker/docker-compose.yml up -d --remove-orphans;
	@echo 'App is running on http://localhost:8081';

# Start dev environment with forced build
up\:build:
	docker-compose -f .docker/docker-compose.yml up -d --build;

# Stop dev environment
down:
	docker-compose -f .docker/docker-compose.yml down;

# Show logs - format it using less
logs:
	docker-compose -f .docker/docker-compose.yml logs -f --tail=10 | less -S +F;

# Exec sh on php container
exec\:php:
	docker-compose -f .docker/docker-compose.yml exec php sh;

# Mazání temp/cache
clean:
	docker-compose -f .docker/docker-compose.yml exec php rm -rf temp/cache