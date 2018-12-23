<?php
require_once '../vendor/autoload.php';

$init = parse_ini_file("../conf/config.ini");

$config = [
    'driver'    => $init["type"],
    'host'      => $init["host"],
    'database'  => $init["name"],
    'username'  => $init["user"],
    'password'  => $init["pass"],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '' ];

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config ); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* visible de tout fichier */
$db->bootEloquent();           /* établir la connexion */


