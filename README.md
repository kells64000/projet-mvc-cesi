# MVC en PHP (7.1)

## Installation :

Créer un vhost dans Apache / Nginx

Créer la BDD = `films`

Importer le fichier sql présent dans : `DB-Data\films.sql`

Renommer le fichier : `bootstrap.php.exemple` en `bootstrap.php`

## Configuration :

Les credentials pour la connexion à la BDD sont à renseigner dans `bootstrap.php`

<pre>
define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "user");
define("MYSQL_PWD", "password");
define("MYSQL_DB", "dbname");
</pre>

## Utilisation :

Les Models sont dans : `App\Models`

Les Controllers sont dans : `App\Controllers`

Les Views sont dans `Views\`
