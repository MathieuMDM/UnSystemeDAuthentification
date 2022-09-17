<?php
ob_start();
session_start();
include('partials/header.php');
include('partials/menu.php');
?>


<!-- Menu Content Selection Start -->
<div class="menu-content">
    <div class="wrapper">
        <h1>Liste d'utilisateur</h1>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

        ?>
        <br>
        <!-- button add user -->
        <a href="add-user.php" class="btn-primary">Ajouter un utilisateur</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr class="text-center">
                <th>Numéro</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Action</th>
            </tr>
            <?php
                
                $sql = "SELECT * FROM bo_users";
                
                $res = mysqli_query($conn, $sql);
                
                if ($res == true) {
                    $count = mysqli_num_rows($res);

                    $sn=1;
                    
                    if ($count>0) {
                        while ($rows=mysqli_fetch_assoc($res)) {
                            $id=$rows['id'];
                            $nom=$rows['nom'];
                            $prenom=$rows['prenom']; ?>
            <tr>
                <td><?php echo $sn++; ?>

                </td>
                <td><?php echo $nom; ?>
                </td>
                <td><?php echo $prenom; ?>
                </td>
                <td>
                    <a href="update-password.php?id=<?php echo $id; ?>"
                        class="btn-primary">Changer le mot de
                        passe</a>
                    <a href="update-user.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Modifier
                        l'utilisateur</a>
                    <a href="delete-user.php?id=<?php echo $id; ?>"
                        class="btn-danger">Supprimer
                        l'utilisateur</a>

                </td>
            </tr>

            <?php
                        }
                    } else {
                        //nous n'avons pas de lignes dans le tableau
                    }
                }
            ?>

        </table>
    </div>
</div>


<?php include('partials/footer.php');
