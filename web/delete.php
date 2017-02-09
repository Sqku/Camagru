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

                    if($_SERVER['REQUEST_METHOD'] != 'POST')
                    {
                        http_response_code(403);
                        echo "Vous n'avez pas d'accès à cette page !";
                        $message = '<p>Cliquez <a href="./index.php">ici</a> pour aller à l\'accueil</p>';
                        echo $message;
                        include("footer.php");
                        die();
                    }

                    if(isset($_POST))
                    {

                        $id = $_POST['id'];


                        if (!is_numeric($id))
                        {
                            http_response_code(404);
                            echo "Cette image n'existe pas";
                            include("footer.php");
                            die();
                        }
                        $query = $db->prepare("SELECT * FROM images WHERE id=? AND users_id=?");
                        $query->bindParam(1, $id, \PDO::PARAM_INT);
                        $query->bindParam(2, $_SESSION['id'], \PDO::PARAM_INT);
                        $query->execute();
                        $data = $query->fetch();
                        if ($data)
                        {
                            $query3 = $db->prepare("DELETE FROM images WHERE id=?");
                            $query3->execute(array($id));
                            unlink("img/uploads/$id.png");
                            echo "Vous avez bien supprimer le montage";
                            $message = '<p>Cliquez <a href="./galerie.php">ici</a> pour aller à la galerie</p>';
                            $message2 = '<p>Cliquez <a href="./camera.php">ici</a> pour aller à la camera</p>';
                            echo $message;
                            echo $message2;
                        }
                        else
                        {
                            http_response_code(404);
                            echo "Vous n'êtes pas autorisé à effectuer cette action";
                            $message = '<p>Cliquez <a href="./index.php">ici</a> pour aller à l\'accueil</p>';
                            echo $message;
                            include("footer.php");
                            die();
                        }
                    }
                    else
                    {
                        echo "Vous n'avez pas d'accès à cette page !";
                        $message = '<p>Cliquez <a href="./index.php">ici</a> pour aller à l\'accueil</p>';
                        echo $message;
                        include("footer.php");
                        die();
                    }
                    ?>

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

