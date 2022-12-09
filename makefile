cs: ## Fix CS violations
	vendor/php-cs-fixer/vendor/bin/php-cs-fixer fix src --verbose

cs_dry_run: ## Display CS violations without fixing it
	vendor/php-cs-fixer/vendor/bin/php-cs-fixer fix src --verbose --dry-run

install: ## Install dependencies
	composer install

test: ## Run the tests
	php -d memory_limit=-1 vendor/bin/phpunit tests

.PHONY: help

help: ## Display this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help
