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
                <div class="col-s-8 col-m-8 col-l-6" style="position: relative; padding: 0;">
                    <video id="video" style="width: 100%; height: auto;"></video>
                    <canvas id="canvas" style="position: absolute; top: 0; left: 0; z-index: 1; width: 100%; height: auto;"></canvas>
                    <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">
                </div>
                <div class="col-s-4 col-m-4 col-l-6">
                </div>
            </div>
            <div>
                <ul id = "menu_cadre">
                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                        <li><img class="cadre" id="cadre_<?=$i?>" src="img/cadres/<?=$i?>.png" alt="<?=$i?>"></li>
                    <?php endfor; ?>
                </ul>
            </div>

            <a href="upload_image.php">Uploader une image</a>

            <?php

            ?>


            <button id="startbutton">Prendre une photo</button>
            <button id="resetbutton" style="display:none">Recommencer</button>

            <div>
                <form method="post" action="save.php">
                    <input type="hidden" value="" name="b64_img" id="b64_img">
                    <input type="hidden" value="" name="id_cadre" id="id_cadre">
                    <button type="submit" id="savebutton" style="display:none" disabled>Enregistrer</button>
                </form>
            </div>


            <img src="" id="photo" alt="photo" style="display: none">

            <script src="js/camera.js" type="text/javascript"></script>

            <?php

            $img_par_page=3;

            $query2=$db->prepare("SELECT COUNT(*) AS total FROM images WHERE users_id = $id");
            $query2->execute();
            $data2=$query2->fetchAll();
            $total=$data2[0]['total'];

            $nb_page=ceil($total/$img_par_page);

            if (isset($_GET['page']))
            {
                $page_actu=intval($_GET['page']);

                if($page_actu > $nb_page)
                    $page_actu = $nb_page;
            }
            else
            {
                $page_actu = 1;
            }

            $premiere_entree = ($page_actu - 1) * $img_par_page;

            $query=$db->prepare("SELECT * FROM images WHERE users_id = $id ORDER BY date DESC LIMIT $premiere_entree, $img_par_page");
            $query->execute();
            $data=$query->fetchAll();


            foreach($data as $img) : ?>

                <div class="min">
                    <a href="apercu.php?id=<?=$img['id']?>">
                        <!--        <a href="img/uploads/--><?//=$img['id']?><!--.png">-->
                        <img src="img/uploads/<?=$img['id']?>.png" alt="<?=$img['id']?>">
                    </a>
                </div>

            <?php endforeach;
            $query->CloseCursor();

            ?> </br> <?php

            if($data)
            {

                echo '<p align="center">Page : ';

                for ($i = 1; $i <= $nb_page; $i++) {
                    if ($i == $page_actu)
                        echo $i;
                    else
                        echo ' <a href="galerie.php?page=' . $i . '">' . $i . '</a> ';
                }
                echo '</p>';
            }
            else
            {
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
<script src="js/camera.js" type="text/javascript"></script>
</body>


<?php
include("fin.php");
?>

