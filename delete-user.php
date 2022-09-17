<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');

$id = $_GET['id'];

$sql = "DELETE FROM bo_users WHERE id='$id'";

$resultat = $connexion->exec($sql);


if ($resultat==true) {
    $_SESSION['delete'] = "<div class='success'>L'utilisateur a été supprimé</div>";

    header("location:".SITEURL.'manage-list.php');
} else {
    $_SESSION['delete'] = "<div class='error'>Erreur lors de la suppression de l'utilisateur, réessayez plus tard</div>";
    header("location:".SITEURL.'manage-list.php');
}