# Digitalendar
Projet de soutenance PHP - Symfony

Pour réinstaller le projet:


1/ Dupliquer le fichier .env 
	le renommer en .env.local
	renseigner les éléments de la base de donnéee 'login / mdp / bdd'
2/ lancer la commande npm install
3/ lancer la commande composer install
4/ lancer la commande php bin/console doctrine:database:create
5/ lancer la commande php bin/console make:migration
6/ lancer la commande php bin/console doctrine:migrations:migrate
