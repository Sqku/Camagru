<?php
include("db_start.php");
include("debut.php");
include("header.php");
if (!isset($_SESSION['id']) || empty($_SESSION['id']))
{
    $message = '<p>Cliquez <a href="./connexion.php">ici</a> pour vous connecter';
    erreur(ERR_IS_CO);
    echo $message;
    include("footer.php");
    die();

}

include("menu.php");
?>

    <div style="position: relative; width: 800px; height: 600px;">
<!--        <video id="video"></video>-->
<!--        <canvas id="canvas" style="position: absolute; top: 0; left: 0;"></canvas>-->
        <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">
        <img id="img-preview" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 1; top: 0; left: 0;">
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
    <script src="js/upload.js" type="text/javascript"></script>

<?php
include("footer.php");
include("fin.php");
?>