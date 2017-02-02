<?php
include("db_start.php");
include("debut.php");
?>

<body>
<div class="site-container">
    <div class="site-pusher">
        <?php
        include("header.php");
        ?>
        <div class="content">
            <div class="row">
                <div class="col-s-12 col-m-10 col-m-push-1 col-l-10 col-l-push-1" id="bienvenue">
                    <?php

                    $login = $_GET['log'];
                    $cle = $_GET['cle'];

                    $query = $db->prepare("SELECT cle,actif FROM users WHERE user_name like :login ");
                    if($query->execute(array(':login' => $login)) && $row = $query->fetch())
                    {
                        $clebd = $row['cle'];
                        $actif = $row['actif'];
                    }

                    if($actif == '1')
                    {
                        if($id != 0)
                        {
                            echo "Votre avez déjà activé votre compte et êtes connecté !";
                        }
                        else
                        {
                            $message = '<p>Cliquez <a href="./connexion.php">ici</a> pour vous connecter';
                            echo "Votre compte est déjà actif !";
                            echo $message;
                        }
                    }
                    else
                    {
                        if($cle == $clebd)
                        {
                            echo "Votre compte a bien été activé !";

                            $cle = '';
                            $query = $db->prepare("UPDATE users SET actif = 1, cle = :cleVide WHERE user_name like :login ");
                            $query->bindParam(':cleVide', $cle);
                            $query->bindParam(':login', $login);
                            $query->execute();
                        }
                        else
                        {
                            echo "Erreur ! Votre compte ne peut être activé...";
                        }
                    }

                    $query->CloseCursor();

                    ?>
                </div>
            </div>
        </div>
        <div class="site_cache" id="site_cache"></div>
        <?php
        include("footer.php");
        ?>
    </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>
</body>


<?php
include("fin.php");
?>
