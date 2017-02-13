<?php
include("db_start.php");
include("debut.php");
?>

<body>
<div class="site-container"> <!-- 1 -->
    <div class="site-pusher"> <!-- 2 -->
        <?php
        include("header.php");
        ?>
        <div class="content"> <!-- 3 -->
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
                <div>
                    <div class="col-s-12 col-m-8 col-l-6" id="camera_left">
                        <div style="position: relative; padding: 0;">
                            <video id="video" style="width: 100%; height: auto;"></video>
                            <canvas id="canvas" style="position: absolute; top: 0; left: 0; z-index: 1; width: 100%; height: auto;"></canvas>
<!--                            <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">-->


<!--                            <div class="col-s-8 col-m-8 col-l-6" style=" position: relative; padding: 0;">-->
                                <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">
                                <img id="img-preview" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 1; top: 0; left: 0;">
<!--                            </div>-->


                        </div>
                        <div class="col-s-12 col-m-12 col-l-12" style="margin-bottom: 70px">
                            <div id="menu_cadre">
                                <ul>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <li><img class="cadre" id="cadre_<?=$i?>" src="img/cadres/<?=$i?>.png" alt="<?=$i?>"></li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                            <div class="col-s-12 col-m-12 col-l-12">
<!--                                <div class="col-s-4 col-m-4 col-l-4">-->
<!--                                    <button class="button">-->
<!--                                        <a href="upload_image.php">Uploader une image</a>-->
<!--                                    </button>-->
<!--                                </div>-->
<!---->
<!--                                <div class="col-s-4 col-m-4 col-l-4">-->
<!--                                    <button class="button" id="startbutton">Prendre une photo</button>-->
<!--                                    <button class="button" id="resetbutton" style="display:none">Recommencer</button>-->
<!--                                </div>-->

                                <div class="col-s-4 col-m-4 col-l-4">
                                    <form id="upload_form" action="upload.php" method="POST" enctype="multipart/form-data">
                                        Uploader une image :
                                        <input type="file" value="" src "" name="fileToUpload" id="upload_img" accept="image/*">
                                        <img id="output"/>
                                        <input type="hidden" value="" name="id_cadre" id="id_cadre2">
                                        <input type="hidden" value="" name="b64_img" id="b64_img">
                                        <input class="button" type="submit" value="Upload Image" id="uploadbutton" name="submit" style="display: none" disabled>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php


                    $query=$db->prepare("SELECT * FROM images WHERE users_id = $id");
                    $query->execute();
                    $data=$query->fetchAll();


                    ?>

                    <?php

                    if($data)
                    {
                        ?>
                        <div class="col-s-12 col-m-4 col-l-6" id="camera_right">
                            <div id="scroll" style="height: 99%">

                                <ul>

                                    <?php
                                    foreach($data as $img) : ?>

                                        <li  class="col-s-6 col-m-12 col-l-4">
                                            <a href="apercu.php?id=<?=$img['id']?>">
                                                <!--        <a href="img/uploads/--><?//=$img['id']?><!--.png">-->
                                                <img src="img/uploads/<?=$img['id']?>.png" alt="<?=$img['id']?>">
                                            </a>
                                        </li>

                                    <?php endforeach;

                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="col-s-12 col-m-4 col-l-6" id="camera_right" style="background: #ECECEC; border: 2px solid #0277bd;">
                            <div id="blank">
                                Vous n'avez pas encore effectué de montage.
                            </div>
                        </div>

                        <?php
                    }

                    $query->CloseCursor();
                    ?>
                </div>
            </div>


<!--            <img src="" id="photo" alt="photo" style="display: none">-->
            <?php
            include("footer.php");
            ?>
            <div class="site_cache" id="site_cache"></div>

        </div><!-- 2 -->
    </div> <!-- 1 -->
</div>
<script type="text/javascript" src="js/menu.js"></script>
<script src="js/upload.js" type="text/javascript"></script>
</body>


<?php
include("fin.php");
?>
