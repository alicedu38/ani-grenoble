<h2>Prérequis</h2>
<ul>
<li>PHP version : supérieur ou égale à 7.0.8,</li>
<li>Serveur http : Apache, IIS, etc,</li>
<li>Système de base de données : MySQL, PostGreSQL, SQLite, etc.</li>
</ul>

Pour faire fonctionner le projet en local sur votre ordinateur vous pouvez utiliser WAMP ou LAMP.

<h2>Installation</h2>
1.Télécharger le projet sur votre ordinateur :</br>
```code
$ git clone https://github.com/alicedu38/ani-grenoble.git
```
ou cliqué sur le bouton "Download".

2.Se déplacer dans le fichier ani-grenoble/site :</br>
```code
$ cd /www/ani-grenoble/site
```
ou via l'interface de votre système.

3.Récupérer les dépandances de Composer + configurer la base de données (fichier site/app/config/parameters.yml) :</br>
Installez composer puis lancez la commande suivante :
```code
$ composer install
```
Paramètres de la base de données
```code
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: ani_grenoble
    database_user: Votre_identifiant_base_de_donnees
    database_password: Votre_mdp_base_de_donnees
    database_host (127.0.0.1):
    mailer_transport (smtp):
    secret ():
```

4. Import de la base de données dans MySQL (le fichier de la base de données se situe dans site/db)

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

Note : Passage de Symfony 2.8 à la veresion 3.4 (app/console et non pas bin/console)
