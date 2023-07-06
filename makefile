cs: ## Fix CS violations
	vendor/bin/php-cs-fixer fix src --verbose

cs_dry_run: ## Display CS violations without fixing it
	vendor/bin/php-cs-fixer fix src --verbose --dry-run

# Constructor promoted properties are all on line, which is quite annoying
# We could use https://github.com/kubawerlos/php-cs-fixer-custom-fixers/blob/main/src/Fixer/MultilinePromotedPropertiesFixer.php
# Configuration in this comment https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/issues/6325#issuecomment-1058183314
cs_generated: ## Fix CS violations in generated files. Use with caution! Very SLOW!
	vendor/bin/php-cs-fixer fix generated

phpstan: ## Run phpstan
	vendor/bin/phpstan analyse -c phpstan.neon

install: ## Install dependencies
	composer install

test: ## Run the tests
	php -d memory_limit=-1 vendor/bin/phpunit tests

reset_fixtures: ## Delete the test files and reinstall them
	bin/json-ld remove-fixtures --reset

delete_fixtures: ## Delete all test files
	bin/json-ld remove-fixtures

bench: ## Run the benchmark
	vendor/bin/phpbench run tests/Benchmark --report=aggregate

.PHONY: help

help: ## Display this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help
