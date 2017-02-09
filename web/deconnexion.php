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
            <?php
            if (!isset($_SESSION['id']) || empty($_SESSION['id']))
            {
            $message = '<p>Cliquez <a href="./connexion.php">ici</a> pour vous connecter';
                erreur(ERR_IS_CO);
                echo $message;
                include("footer.php");
                die();
            }
            ?>
            <div class="row">
                <div class="col-s-12 col-m-10 col-m-push-1 col-l-10 col-l-push-1" id="bienvenue">
                    <?php
                    session_unset();
                    //session_destroy();

                    if ($id==0)
                    {
                    echo '<p>Vous êtes à présent déconnecté <br />

                        Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        include("footer.php");
        ?>
        <div class="site_cache" id="site_cache"></div>
    </div>
</div>
<!--    --><?php
    include("footer.php");
//    ?>
<script type="text/javascript" src="js/menu.js"></script>
</body>


<?php
include("fin.php");
?>
