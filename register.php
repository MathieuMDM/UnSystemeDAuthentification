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

            <h3>Inscription d'un nouvel employé</h3>
            <br>
            <br>
            <form action="" class="loginRegister" method="POST">

                <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom" />
                    <label class="form-label">Nom</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="prenom" placeholder="Entrez votre prenom" />
                    <label class="form-label">Prenom</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="metier" placeholder="Entrez votre profession" />
                    <label class="form-label">Metier</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="email" class="form-control" name="email" placeholder="Entrez votre email ici" />
                    <label class="form-label">Email</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" class="form-control" name="password"
                        placeholder="Entrez votre mot de passe ici" />
                    <label class="form-label">Password</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" class="form-control" name="passwordC"
                        placeholder="Ressaisissez votre mot de passe" />
                    <label class="form-label">Confirmation mot de passe</label>
                </div>

                <div class="btnLogin">
                    <button name="submit" class="btn btn-primary btn-block">Inscription</button>
                </div>
                <br>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <p class="registerText">Vous avez déjà un compte? <a href="manage-ouvriers.php"> Connexion</a>
                        </p>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>


<?php

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $metier = $_POST['metier'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $passwordC = md5($_POST['passwordC']);

    if ($password == $passwordC) {
        $stmt = $connexion->prepare("SELECT * FROM bo_ouvriers WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo "<script>alert('Un tel e-mail existe déjà dans la base de données')</script>";
        } else {
            $add = $connexion->prepare(
                "INSERT INTO bo_ouvriers (id, nom, prenom, password, metier, email) VALUES (NULL, :nom, :prenom, :password, :metier, :email)"
            );
    
            $add->bindParam(':nom', $nom, PDO::PARAM_STR);
            $add->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $add->bindParam(':password', $password, PDO::PARAM_STR);
            $add->bindParam(':metier', $metier, PDO::PARAM_STR);
            $add->bindParam(':email', $email, PDO::PARAM_STR);
            $resultat = $add->execute();
            if ($resultat) {
                header("location:".SITEURL.'index.php');
            } else {
                echo "<script>alert('Erreur de connexion à la base de données, veuillez réessayer plus tard')</script>";
            }
        }
    } else {
        echo "<script>alert('Les mots de passe fournis ne correspondent pas')</script>";
    }
}

?>


<!-- footer -->

<?php include('partials/footer.php');