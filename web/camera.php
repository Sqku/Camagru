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

    <div style="position: relative; width: 800px;">
        <video id="video"></video>
        <canvas id="canvas" style="position: absolute; top: 0; left: 0;"></canvas>
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

    <a href="upload_image.php">Uploader une image</a>

<?php

?>


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
    include("footer.php");
}
else
{
    include("footer.php");
    die();
}

?>




<?php
    include("footer.php");
?>


