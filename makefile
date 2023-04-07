cs: ## Fix CS violations
	vendor/bin/php-cs-fixer fix src --verbose

cs_dry_run: ## Display CS violations without fixing it
	vendor/bin/php-cs-fixer fix src --verbose --dry-run

phpstan: ## Run phpstan
	vendor/bin/phpstan analyse -c phpstan.neon

install: ## Install dependencies
	composer install

test: ## Run the tests
	php -d memory_limit=-1 vendor/bin/phpunit tests

reset_test: ## Delete the test files and reinstall them
	bin/json-ld reset-fixtures --reset

delete_test: ## Delete all test files
	bin/json-ld reset-fixtures

bench: ## Run the benchmark
	vendor/bin/phpbench run tests/Benchmark --report=aggregate

.PHONY: help

help: ## Display this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help
