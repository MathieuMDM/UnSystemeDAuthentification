<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');
?>

<!--  -->

<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card text-center">

            <h3>Vous vous connectez en tant qu'employé</h3>
            <br>
            <br>
            <form action="" class="loginEmail" method="POST">

                <div class="form-outline mb-4">
                    <input type="email" name="email" class="form-control" placeholder="Entrez votre email ici" />
                    <label class="form-label" for="form1Example1">Email</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="password" class="form-control"
                        placeholder="Entrez votre mot de passe ici" />
                    <label class="form-label">Password</label>
                </div>
                <div class="btnLogin">
                    <button name="submit" class="btn btn-primary btn-block">Connexion</button>
                </div>
                <br>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <p class="registerText"> Vous n'avez pas de compte? <a href="register.php"> S'inscrire</a></p>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>


<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = $connexion->query("SELECT * FROM bo_ouvriers WHERE email = '$email' AND password = '$password'");
    $list = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($list as $fetchAssoc) {
        $all = $fetchAssoc['nom'];
    }
    
    $count = $sql->rowCount();
    if ($count > 0) {
        $nom = $fetchAssoc['nom'];
        $_SESSION['user'] = "<div class='success'>Bienvenue ".$nom." </div>";
        header("location:".SITEURL.'admin-ouvriers.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Email ou le mot de passe fourni n'existe pas dans la base de données</div>";
        header("location:".SITEURL.'manage-list.php');
    }
}
?>


<!-- footer -->

<?php include('partials/footer.php');