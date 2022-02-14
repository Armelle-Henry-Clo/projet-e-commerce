<?php 

$pdo= new PDO('mysql:host=localhost;dbname=site_ecommerce', 'root', 'root', array(PDO::ATTR_ERRMODE => ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//initiation de la session
session_start();

//chemin du site
define('SITE', '/nouveau_projet/');

//variable d'affichage
$contenu = '';


?>
