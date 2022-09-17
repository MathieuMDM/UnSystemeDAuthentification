<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Ajouter un utilisateur</h1>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

        ?>
        <br>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nom:</td>
                    <td><input type="text" name="nom" placeholder="Entrez votre nom"></td>
                </tr>
                <tr>
                    <td>Prenom:</td>
                    <td><input type="text" name="prenom" placeholder="Entrez votre prenom"></td>
                </tr>
                <tr>
                    <td>Le mot de passe:</td>
                    <td><input type="password" name="password" placeholder="Ecrivez votre mot de passe"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Ajouter" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php include('partials/footer.php');

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $password = md5($_POST['password']);
    
    $stmt = $connexion->prepare("SELECT * FROM bo_users WHERE nom = ?");
    $stmt->execute([$nom]);
    $count = $stmt->rowCount();
    

    if ($count > 0) {
        $_SESSION['add'] = "<div class='error'>Erreur lors de l'ajout de l'utilisateur, svp veuillez réessayer plus tard</div>";
        header("location:".SITEURL.'add-user.php');
    } else {
        $add = $connexion->prepare(
            "INSERT INTO bo_users (id, nom, prenom, password) VALUES (NULL, :nom, :prenom, :password)"
        );
    
        $add->bindParam(':nom', $nom, PDO::PARAM_STR);
        $add->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $add->bindParam(':password', $password, PDO::PARAM_STR);
        $resultat = $add->execute();
        $_SESSION['add'] = "<div class='success'>L'utilisateur a été ajouté correctement</div>";
        header("location:".SITEURL.'manage-list.php');
    }
} else {
    //pas cliqué
}
