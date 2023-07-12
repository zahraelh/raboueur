<?php
// axctivation des messages d'erreurs
error_reporting(E_ALL);
ini_set('display_errors','1');
ini_set('log_errors', '0');//enregistrement dans un fichier s'il est a 1
ini_set('error_log','./'); //creer un repertoir

// connexion BDD
switch ($_SERVER['HTTP_HOST']) {
    case 'localhost':
       define('HOST','localhost');
       define('PORT',3306);
       define('DATA','raboueur');
       define('USER','root');
       define('PASS','');
        break;
    case 'baobab-svr5': // Fictif
        define('HOST', 'baobab-svr5');
        define('DATA', 'baobab-sql5');
        define('USER', 'baobab-usr1');
        define('PASS', 'aR5*hgt+7uIopp$');
        break;
    default:
        # code...
        break;
}
?>