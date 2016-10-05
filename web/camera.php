<?php
include("db_start.php");
include("debut.php");
include("header.php");
include("menu.php");

?>

<div style="position: relative; width: 800px;">
    <video id="video"></video>
    <canvas id="canvas" style="position: absolute; top: 0; left: 0;"></canvas>
    <img id="apercu" src="" alt="" style="position: absolute; width: 100%; height: 100%; z-index: 2; top: 0; left: 0;">
</div>

<div>
    <ul id = "menu_cadre">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
        <li><img class="cadre" id="cadre_<?=$i?>" src="img/cadres/<?=$i?>.png" alt="<?=$i?>"></li>
        <?php endfor; ?>
    </ul>
</div>


<button id="startbutton">Prendre une photo</button>
<button id="resetbutton" style="display:none">Recommencer</button>


<form method="post" action="save.php">
    <input type="hidden" value="" name="b64_img" id="b64_img">
    <input type="hidden" value="" name="id_cadre" id="id_cadre">
    <button type="submit" id="savebutton" style="display:none" disabled>Enregistrer</button>
</form>



<img src="" id="photo" alt="photo" style="display: none">

<script src="js/camera.js" type="text/javascript"></script>

<?php
include("footer.php");
?>
