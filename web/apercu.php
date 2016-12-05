<?php
include("db_start.php");
include("debut.php");
include("header.php");
include("menu.php");

?>


<?php

$id = $_GET['id'];

?>
<img src="img/uploads/<?=$id?>.png">

<form action="apercu.php?id=<?=$id?>" method="post">
    <textarea name="commentaire" style="width:450px;height:150px;"></textarea>
    <input type="submit" value="commenter">
</form>


<?php

$query=$db->prepare('SELECT * FROM commentaires ORDER BY date DESC');
$query->execute();
$data=$query->fetchAll();

foreach($data as $comment) : ?>

    <div>
        <?
            if($comment["images_id"]==$id)
            {
                echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                     <td><strong>Par : ' . stripslashes($donnees_messages['pseudo']) . '</strong></td>
                </tr>
                <tr>
                     <td>' . nl2br(stripslashes($comment['commentaire'])) . '</td>
                </tr>
                </table><br /><br />';

            }


        ?><br/>
    </div>
<?php endforeach;




?>


<?php

$comment = $_POST["commentaire"];
$userid = $_SESSION["id"];

try {
$query=$db->prepare('INSERT INTO commentaires (commentaire, users_id, images_id)
VALUES (:comment, :users, :img)');
$query->bindValue(':comment', $comment, PDO::PARAM_STR);
$query->bindValue(':users', $userid, PDO::PARAM_INT);
$query->bindValue(':img', $id, PDO::PARAM_INT);
$query->execute();
} catch (PDOException $e) {
echo 'Pdo error: '.$e->getMessage();
die();
}

$query->CloseCursor();

header('Location: apercu.php');

?>




