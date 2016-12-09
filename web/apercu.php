<?php
include("db_start.php");
include("debut.php");
include("header.php");
include("menu.php");

?>


<?php

$id = $_GET['id'];

$query3 = $db->prepare("SELECT * FROM images WHERE id=?");
$query3->execute(array($_GET['id']));
$data3 = $query3->fetch(PDO::FETCH_ASSOC);
echo '<pre>';
print_r($data3);

if (!$data3)
{
    http_response_code(404);
    echo "Cette image n'existe pas";
    include("footer.php");
    die();
}
else
{

    ?>
    <div class="apercu_image">
        <img src="img/uploads/<?= $id ?>.png"></br>
    </div>

    <div class="vote">
        <div class="vote_bar">
            <div class="vote_progress" style="width:<?= ($data3['like_count'] + $data3['dislike_count']) == 0 ? 100 : round(100 * ($data3['like_count'] / ($data3['like_count'] + $data3['dislike_count'])));?>%;"></div>
        </div>

        <div class="votebtns">
            <form action="like.php?id=<?=$id?>&vote=1" method="POST">
                <button type="submit" class="vote_btn vote_like"><?= $data3['like_count'] ?></button>
            </form>
            <form action="like.php?id=<?=$id?>&vote=-1" method="POST">
                <button type="submit" class="vote_btn vote_dislike"><?= $data3['dislike_count'] ?></button>
            </form>
        </div>
    </div>

    <form action="commentaires.php?id=<?= $id ?>" method="post">
        <textarea name="commentaire" style="width:450px;height:150px;"></textarea>
        <input type="submit" value="commenter">
    </form>


    <?php

    $query = $db->prepare("SELECT * FROM commentaires WHERE images_id=$id ORDER BY date DESC");
    $query->execute();
    $data = $query->fetchAll(\PDO::FETCH_ASSOC);


    foreach ($data as $comment) : ?>

        <?php
        $tmp = $comment['users_id'];
        $query2 = $db->prepare("SELECT user_name FROM users WHERE id=$tmp");
        $query2->execute();
        $data2 = $query2->fetchAll(\PDO::FETCH_ASSOC);

        ?>
        <div>
            <?php
            if ($comment["images_id"] == $id) {
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
}
include("footer.php");

?>







