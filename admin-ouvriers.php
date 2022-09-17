<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');

if (isset($_SESSION['user'])) {
    echo $_SESSION['user'];
    unset($_SESSION['user']);
}

include('controllers/controllers.php');

$controller = new Controllers();
$controller->dispatch();