<?php
include("db_start.php");
$MAX_UPLOAD_SIZE = 10485760;


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && isset($_SESSION['pseudo'])) {

    $errors = array();

    if ($_FILES['fileToUpload']['error'] > 0)
        $errors['upload'] = true;
    if ($_FILES['fileToUpload']['type'] != 'image/jpeg' && $_FILES['fileToUpload']['type'] != 'image/png')
        $errors['type'] = true;
    if ($_FILES['fileToUpload']['size'] > $GLOBALS['MAX_UPLOAD_SIZE'])
        $errors['size'] = true;
    if (empty($errors)) {
        $filter_root = '/nfs/2014/a/ahua/42/Camagru/ahua/web/img/cadres/' . $_POST['id_cadre'] . '.png';
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
                    echo 'save.php: ';
                    echo 'Pdo error: ' . $e->getMessage();
                    die();
                }

                $query->CloseCursor();

                imagepng($tmp_img, '/nfs/2014/a/ahua/42/Camagru/ahua/web/img/uploads/' . $db->lastInsertId() . '.png');
                imagedestroy($tmp_img);
//                echo "salut";
//                die();
                header('Location: camera.php');
            }
        }
    }
    if (!empty($errors)) {
        echo '<pre>';
        print_r($errors);

    }
}
else
    echo "sad";


?>