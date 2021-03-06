<?php

include("db_start.php");

if (!empty($_POST) && isset($_SESSION['pseudo']))
{
    $errors = array();
    if ($_POST['b64_img'] == 'none')
        $errors['b64_img'] = true;
    if (empty($errors))
    {
        if(!$_POST['id_cadre'])
        {
            header('Location: camera.php');
        }
        else
        {
            $filter_root = $_SERVER['DOCUMENT_ROOT'].'/img/cadres/'.$_POST['id_cadre'].'.png';

        }
        if(!$_POST['b64_img'])
        {
            header('Location: camera.php');

        }
        else
        {
            $tmp_img = imagecreatefromstring(base64_decode(explode(',', $_POST['b64_img'])[1]));

        }
        $width = 800;
        $height = 600;
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
        if (empty($errors))
        {
            $user_id= $_SESSION['id'];
            try {
                $query=$db->prepare('INSERT INTO images (users_id)
                VALUES (:user_id)');
                $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $query->execute();
            } catch (PDOException $e) {
                echo 'save.php: ';
                echo 'Pdo error: '.$e->getMessage();
                die();
            }

            $query->CloseCursor();

            imagepng($tmp_img, $_SERVER['DOCUMENT_ROOT'].'/img/uploads/'.$db->lastInsertId().'.png');
            imagedestroy($tmp_img);
            header('Location: camera.php');
        }
    }
    if (!empty($errors))
        echo 'errors';
}
else
    header('Location: index.php');
?>


