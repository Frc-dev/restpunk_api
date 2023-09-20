run:
	symfony serve -d

install:
	composer install

tests-all:
	php bin/phpunit
	vendor/bin/behat

tests-unit:
	php bin/phpunit

tests-api:
	vendor/bin/behat

cs-fix:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix tests