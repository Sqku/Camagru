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
<!--                <div class="col-s-12 col-m-8 col-l-6" style="position: relative; padding: 0;">-->
                <div class="col-s-12 col-m-8 col-l-6" ">
                    <div style="position: relative; padding: 0;">
                        <video id="video" style="width: 100%; height: auto;"></video>
                        <canvas id="canvas" style="position: absolute; top: 0; left: 0; z-index: 1; width: 100%; height: auto;"></canvas>
                        <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">
                    </div>
<!--                    <video id="video" style="width: 100%; height: auto;"></video>-->
<!--                    <canvas id="canvas" style="position: absolute; top: 0; left: 0; z-index: 1; width: 100%; height: auto;"></canvas>-->
<!--                    <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">-->

                    <div class="col-s-12 col-m-12 col-l-12">
                        <div id="menu_cadre">
                            <ul>
                                <?php for ($i = 1; $i <= 3; $i++) : ?>
                                    <li><img class="cadre" id="cadre_<?=$i?>" src="img/cadres/<?=$i?>.png" alt="<?=$i?>"></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <div>
                            <a href="upload_image.php">Uploader une image</a>
                            <button id="startbutton">Prendre une photo</button>
                            <button id="resetbutton" style="display:none">Recommencer</button>


                            <form method="post" action="save.php">
                                <input type="hidden" value="" name="b64_img" id="b64_img">
                                <input type="hidden" value="" name="id_cadre" id="id_cadre">
                                <button type="submit" id="savebutton" style="display:none" disabled>Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>

<!--                <div class="col-s-12 col-m-4 col-l-6">-->
<!--                    <div id="menu_cadre">-->
<!--                        <ul>-->
<!--                            --><?php //for ($i = 1; $i <= 3; $i++) : ?>
<!--                                <li><img class="cadre" id="cadre_--><?//=$i?><!--" src="img/cadres/--><?//=$i?><!--.png" alt="--><?//=$i?><!--"></li>-->
<!--                            --><?php //endfor; ?>
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div>-->
<!--                    <a href="upload_image.php">Uploader une image</a>-->
<!--                    <button id="startbutton">Prendre une photo</button>-->
<!--                    <button id="resetbutton" style="display:none">Recommencer</button>-->
<!---->
<!---->
<!--                    <form method="post" action="save.php">-->
<!--                        <input type="hidden" value="" name="b64_img" id="b64_img">-->
<!--                        <input type="hidden" value="" name="id_cadre" id="id_cadre">-->
<!--                        <button type="submit" id="savebutton" style="display:none" disabled>Enregistrer</button>-->
<!--                    </form>-->
<!--                </div>-->

                <div class="col-s-12 col-m-4 col-l-6">
                    <div id="scroll">
                        <?php


                        $query=$db->prepare("SELECT * FROM images WHERE users_id = $id");
                        $query->execute();
                        $data=$query->fetchAll();


                        ?>

                        <ul>

                        <?php
                        foreach($data as $img) : ?>

                            <li>
                                <a href="apercu.php?id=<?=$img['id']?>">
                                    <!--        <a href="img/uploads/--><?//=$img['id']?><!--.png">-->
                                    <img src="img/uploads/<?=$img['id']?>.png" alt="<?=$img['id']?>">
                                </a>
                            </li>

                        <?php endforeach;
                        $query->CloseCursor();
                        ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <form method="post" action="save.php">
                    <input type="hidden" value="" name="b64_img" id="b64_img">
                    <input type="hidden" value="" name="id_cadre" id="id_cadre">
                    <button type="submit" id="savebutton" style="display:none" disabled>Enregistrer</button>
                </form>
            </div>


            <img src="" id="photo" alt="photo" style="display: none">

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

