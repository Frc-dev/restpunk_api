run:
	symfony serve -d

install:
	composer install

tests-all:
	php bin/phpunit

cs-fix:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src