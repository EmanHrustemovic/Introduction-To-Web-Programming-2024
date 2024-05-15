<?php

//Postavljam da mi izbacuje sve potencijalne errore 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL ^ E_NOTICE | E_DEPRECATED);


//MY DATABASE

define('DB_NAME','project.sql');
define('DB_PORT',3306);
define('DB_USER','root');
define('DB_PASSWORD','g3c9h.,1?0');
define('DB_HOST','127.0.0.1');
