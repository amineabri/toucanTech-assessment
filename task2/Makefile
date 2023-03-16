default: clean run-server k6

.PHONY: help
help: ## Print this help with list of available commands/targets and their purpose
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[36m\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

.PHONY: run-server
run-server: ## Run the REST API and its dependencies in Docker containers
	@echo "Starting the server ..."
	@docker-compose up -d

.PHONY: clean
clean:  ## cleanup test cover output
	@echo "Cleaning up..."
	@docker-compose down

.PHONY: k6
k6:
	@make run-server
	k6 run k6.js
	@make clean

.PHONY: k6-stress-test
k6-stress-test:  ## Discover how the system functions with the load of peak traffic.
	@make run-server
	k6 run k6-stress-test.js
	@make clean

.PHONY: k6-soak-test
k6-soak-test:  ## Discover whether or when the system degrades under loads of longer duration.
	@make run-server
	k6 run k6-soak-test.js
	@make clean

.PHONY: migrate
migrate:  ## run the migration
	@docker-compose exec --workdir /usr/src/app backend php artisan migrate:refresh --seed
