run:
	symfony serve -d

install:
	composer install

tests-all:
	php bin/phpunit