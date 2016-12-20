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
    <div>
        <canvas id="preview"></canvas>
    </div>


    <script type='text/javascript'>

        $(function() {
            $('#frm input[type="file"]').change(function() {
                var file = $(this);
                var reader = new FileReader;
                reader.onload = function(event) {
                    var img = new Image();
                    img.onload = function() {
                        var width = 140;
                        var height = 90
                        var canvas = $('<canvas></canvas>').attr({ width: width, height: height });
                        file.after(canvas);
                        var context = canvas[0].getContext('2d');
                        context.clearRect ( 0 , 0 , width , height );
                        context.drawImage(img, 0, 0, width, height);
                    };
                    img.src = event.target.result;
                };
                reader.readAsDataURL(file[0].files[0]);
            });
        });
    </script>
    <style type='text/css'>
        canvas { border: 1px solid #ccc; }
    </style>

    <body>
    <form id='frm'>
        <input type='file' /><br>
    </form>
    </body>


    <div>
        <ul id = "menu_cadre">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
            <li><img class="cadre" id="cadre_<?=$i?>" src="img/cadres/<?=$i?>.png" alt="<?=$i?>"></li>
            <?php endfor; ?>
        </ul>
    </div>


    <form id="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
        Uploader une image :
        <input type="file" name="fileToUpload" id="upload_img" accept="image/*">
        <input type="hidden" value="" name="id_cadre" id="id_cadre2">
        <input type="submit" value="Upload Image" id="uploadbutton" name="submit">
    </form>

<!--    <script src="js/upload.js" type="text/javascript"></script>-->

<?php
?>