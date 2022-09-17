<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');
?>

<?php

$ids=$_GET["id"];

$requete = "SELECT * FROM bo_users WHERE id='$ids'";
$resultat = $connexion->query($requete);

$list = $resultat->fetchAll(PDO::FETCH_ASSOC);
foreach ($list as $fetchAssoc) {
    $all = $fetchAssoc['id'] . ","
        . $fetchAssoc['nom'] . "," . $fetchAssoc['prenom'];
}
$id = $fetchAssoc['id'];
$nom = $fetchAssoc['nom'];
$prenom = $fetchAssoc['prenom'];

?>

<form class="col w-50" action="update-user2.php" method="post">
    <fieldset class="form-group border p-3">
        <h1>Modification de l'utilisateur</h1>
        <div style="display:flex; flex-direction:column">

            <input name="id" id="id" class="bg-warning text-dark col" type="hidden"
                value="<?php echo $id; ?>" />

            <label for="code" class="bg-success text-white col text-left" style="margin-top: 10px;"> Nom :
            </label>
            <input name="nom" id="nom" class="bg-light text-dark col" type="text"
                value="<?php echo $nom; ?>" required />

            <label for="code" class="bg-success text-white col text-left" style="margin-top: 10px;"> Prenom :
            </label>
            <input name="prenom" id="prenom" class="bg-light text-dark col" type="text"
                value="<?php echo $prenom; ?>" required />

        </div>
        <div style="display:flex; justify-content: space-around;">
            <input class="btn-secondary" type="submit" value="Modifier">
        </div>
    </fieldset>
</form>