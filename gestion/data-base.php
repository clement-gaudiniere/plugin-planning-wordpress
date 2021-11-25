<?php

// Connexion à la Database
define('HOST','localhost');
define('DB_NAME','bcafryhisc232');
define('USER','root');
define('PASS','');

try {
  $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOExeception $e){
  echo $e;
}

 ?>
