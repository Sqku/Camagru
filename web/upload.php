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
            <div style="text-align: center">
                <?php
                if (!isset($_SESSION['id']) || empty($_SESSION['id']))
                {
                $message = '<p>Cliquez <a href="./connexion.php">ici</a> pour vous connecter';
                    erreur(ERR_IS_CO);
                    echo $message;
                    include("footer.php");
                    die();

                }
                    $MAX_UPLOAD_SIZE = 10485760;


                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    if(isset($_POST["submit"]) && isset($_SESSION['pseudo']))
                    {

//                    if (isset($_POST['b64_img']))
//                    {

                    $errors = array();

                    if ($_FILES['fileToUpload']['error'] > 0)
                    $errors['upload'] = true;
                    if ($_FILES['fileToUpload']['type'] != 'image/jpeg' && $_FILES['fileToUpload']['type'] != 'image/png')
                    $errors['type'] = true;
                    if ($_FILES['fileToUpload']['size'] > $GLOBALS['MAX_UPLOAD_SIZE'])
                    $errors['size'] = true;
                    if (empty($errors)) {
                    $filter_root = $_SERVER['DOCUMENT_ROOT'] . '/img/cadres/' . $_POST['id_cadre'] . '.png';
                    try {
                    $tmp_img = imagecreatefromstring(file_get_contents($_FILES['fileToUpload']['tmp_name']));
                    } catch (\Exception $e) {
                    $errors['content'] = true;
                    }
                    if (empty($errors)) {
                    list($width, $height) = getimagesize($_FILES['fileToUpload']['tmp_name']);
                    list($filter_w, $filter_h) = getimagesize($filter_root);
                    $tmp_filter = imagecreatefrompng($filter_root);
                    $filter = imagecreatetruecolor($width, $height);
                    imagealphablending($filter, false);
                    imagesavealpha($filter, true);
                    imagecolortransparent($filter);
                    $a = imagecopyresampled($filter, $tmp_filter, 0, 0, 0, 0, $width, $height, $filter_w, $filter_h);
                    $b = imagecopyresampled($tmp_img, $filter, 0, 0, 0, 0, $width, $height, $width, $height);
                    if ($a == false || $b == false)
                    $errors['creation'] = true;
                    imagedestroy($tmp_filter);
                    imagedestroy($filter);
                    if (empty($errors)) {
                    $user_id = $_SESSION['id'];
                    try {
                    $query = $db->prepare('INSERT INTO images (users_id)
                    VALUES (:user_id)');
                    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                    $query->execute();
                    } catch (PDOException $e) {
                    echo 'upload.php: ';
                    echo 'Pdo error: ' . $e->getMessage();
                    die();
                    }

                    $query->CloseCursor();

                    imagepng($tmp_img, $_SERVER['DOCUMENT_ROOT'] . '/img/uploads/' . $db->lastInsertId() . '.png');
                    imagedestroy($tmp_img);
                    //                        echo "salut";
                    //                        die();
//                    header('Location: camera.php');
                    }
                    }
                    }
                    //        if (!empty($errors)) {
                    //            echo '<pre>';
//            print_r($errors);
//
//    }



//                    }


else
{
    echo "Une erreur est survenue";
    $message = '<p>Cliquez <a href="./upload_image.php">ici</a> pour revenir à la page upload';
                    echo $message;
                    die();
                    }

                    }
                    else
                    {
                    echo "Une erreur est survenue";
                    $message = '<p>Cliquez <a href="./index.php">ici</a> pour aller à la page d\'acueil';
                    echo $message;
                    include("footer.php");
                    die();
                    }


                    ?>
            </div>
        </div>
        <div class="site_cache" id="site_cache"></div>
        <?php
        include("footer.php");
        ?>
    </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>
<script type='text/javascript'>document.location.replace('upload_image.php');</script>
</body>


<?php
include("fin.php");
?>

