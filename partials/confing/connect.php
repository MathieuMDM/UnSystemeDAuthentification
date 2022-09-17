<?php
ob_start();
session_start();

define('SITEURL', "https://www.cefii-developpements.fr/mateusz1179/UnSystemeDAuthentification/1/UnSystemeDAuthentification/");

define('SERVER', "sqlprive-pc2372-001.privatesql.ha.ovh.net");
define('USER', "cefiidev1179");
define('PASSWORD', "tVt8z5M2");
define('BASE', "cefiidev1179");

$connexion = new PDO("mysql:host=" . SERVER . ";dbname=" . BASE, USER, PASSWORD);

$conn = mysqli_connect(SERVER, USER, PASSWORD);
$db_select = mysqli_select_db($conn, BASE);