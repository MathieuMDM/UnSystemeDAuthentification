<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');

$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

$requete = $connexion->prepare(
    "UPDATE bo_users SET nom=:nom, prenom=:prenom WHERE id=:id"
);

$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
$requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$requete->bindParam(':id', $id, PDO::PARAM_INT);

$resultat = $requete->execute();

if ($resultat==true) {
    $_SESSION['update'] = "<div class='success'>L'utilisateur a été mis à jour</div>";

    header("location:".SITEURL.'manage-list.php');
} else {
    $_SESSION['update'] = "<div class='error'>Erreur lors de la modification de l'utilisateur, veuillez réessayer plus tard</div>";
    header("location:".SITEURL.'manage-list.php');
}