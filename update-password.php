<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>


        <?php
            if (isset($_GET['id'])) {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Mot de passe actuel: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Mot de passe actuel">
                    </td>
                </tr>
                <br>
                <tr>
                    <td>Nouveau mot de passe:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Nouveau mot de passe">
                    </td>
                </tr>

                <tr>
                    <td>Confirmez le mot de passe: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirmez le mot de passe">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php

            if (isset($_POST['submit'])) {
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                
                $sql = "SELECT * FROM bo_users WHERE id=$id AND password='$current_password'";

                $resultat = $connexion->query($sql);
                
                if ($resultat==true) {
                    $count=$resultat->rowCount();

                    if ($count==1) {
                        if ($new_password==$confirm_password) {
                            $sql2 = "UPDATE bo_users SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";
                            
                            $res2 = $connexion->query($sql2);
                            
                            if ($res2==true) {
                                $_SESSION['change-pwd'] = "<div class='success'>Le mot de passe a ??t?? chang?? avec succ??s. </div>";
                                
                                header('location:'.SITEURL.'manage-list.php');
                            } else {
                                $_SESSION['change-pwd'] = "<div class='error'>??chec de la modification du mot de passe </div>";
                                
                                header('location:'.SITEURL.'manage-list.php');
                            }
                        } else {
                            $_SESSION['pwd-not-match'] = "<div class='error'>Le mot de passe n'a pas ??t?? corrig??. </div>";
                            
                            header('location:'.SITEURL.'manage-list.php');
                        }
                    } else {
                        $_SESSION['user-not-found'] = "<div class='error'>Utilisateur non trouv??. </div>";

                        header('location:'.SITEURL.'manage-list.php');
                    }
                }
            }

?>


<?php include('partials/footer.php');