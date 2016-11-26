<h2>Prérequis</h2>
<ul>
<li>PHP version : supérieur ou égale à 5.3.9,</li>
<li>Serveur http : Apache, IIS, etc,</li>
<li>Système de base de données : MySQL, PostGreSQL, SQLite, etc.</li>
</ul>

Pour faire fonctionner le projet en local sur votre ordinateur vous pouvez utiliser WAMP ou LAMP.

<h2>Installation</h2>
Télécharger le projet sur votre ordinateur :</br>
$ git clone https://github.com/alicedu38/ani-grenoble.git ou cliqué sur le bouton "Download".

Se déplacer dans le fichier ani-grenoble/site :</br>
$ cd /www/ani-grenoble/site ou via l'interface de votre système.

Récupérer les dépandances de Composer + configurer la base de données :</br>
$ composer install</br>
pour Linux : $ sudo apt install composer puis $ composer install</br>
database_url : 127.0.0.1</br>

Import de la base de données dans MySQL (le fichier de la base de données se situe dans site/db)

Configuration de la base de données dans Synfony, le fichier site/app/config/parameters.yml:</br>
parameters:</br>
    database_host: 127.0.0.1</br>
    database_port: null</br>
    database_name: ani_grenoble</br>
    database_user: Votre_identifiant_base_de_donnees</br>
    database_password: Votre_mdp_base_de_donnees</br>
    
<h2>Execution du projet</h2>
Avec votre serveur : </br>
<ul>
<li>Démarrer le serveur (votre serveur, WAMP ou LAMP)</li>
<li>www.votre-serveur.com ou en local http://localhost/ani-grenoble/site/web/app_dev.php/ </li>
</ul>

Avec le serveur de symfony : </br>
<ul>
<li>Dans ani-grenoble/site : $ php app/console server:run</li>
<li>Se rendre à l'URL indiqué dans la console</li>
</ul>


