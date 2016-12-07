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

<form action="commentaires.php?id=<?=$id?>" method="post">
    <textarea name="commentaire" style="width:450px;height:150px;"></textarea>
    <input type="submit" value="commenter">
</form>


<?php

$query=$db->prepare("SELECT * FROM commentaires WHERE images_id=$id ORDER BY date DESC");
$query->execute();
$data=$query->fetchAll(\PDO::FETCH_ASSOC);


foreach($data as $comment) : ?>

<?php
    $tmp = $comment['users_id'];
    $query2=$db->prepare("SELECT user_name FROM users WHERE id=$tmp");
    $query2->execute();
    $data2=$query2->fetchAll(\PDO::FETCH_ASSOC);

    ?>
    <div>
        <?
            if($comment["images_id"]==$id)
            {
                echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                     <td><strong>Par : ' . stripslashes(htmlspecialchars($data2[0]['user_name'])) . '</strong></td>
                </tr>
                <tr>
                     <td>' . nl2br(stripslashes(htmlspecialchars($comment['commentaire']))) . '</td>
                </tr>
                </table><br /><br />';

            }


        ?><br/>
    </div>
<?php endforeach;

include("footer.php");

?>







