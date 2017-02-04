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
                <div class="col-s-8 col-m-8 col-l-6" style="width: 800px; height: 600px; position: relative; padding: 0;">
                    <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">
                    <img id="img-preview" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 1; top: 0; left: 0;">
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

            <div>
                <form id="upload_form" action="upload.php" method="POST" enctype="multipart/form-data">
                    Uploader une image :
                    <input type="file" value="" src "" name="fileToUpload" id="upload_img" accept="image/*">
                    <img id="output"/>
                    <input type="hidden" value="" name="id_cadre" id="id_cadre2">
                    <input type="hidden" value="" name="b64_img" id="b64_img">
                    <input type="submit" value="Upload Image" id="uploadbutton" name="submit" style="display: none" disabled>
                </form>
            </div>
        </div>
        <div class="site_cache" id="site_cache"></div>
        <?php
        include("footer.php");
        ?>
    </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>
<script src="js/upload.js" type="text/javascript"></script>
</body>


<?php
include("fin.php");
?>


