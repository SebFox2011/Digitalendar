# Digitalendar
Projet de soutenance PHP - Symfony

1/ Dupliquer le fichier .env 
	le renommer en .env.local
	renseigner les éléments de la base de donnéee 'login / mdp / bdd'
2/ npm install
3/ composer install
4/ php bin/console doctrine:database:create
5/ php bin/console make:migration
6/ php bin/console doctrine:migrations:migrate
