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
            <div class="row">
                <div>
                    <?php
                    require("Vote.class.php");


                    $id = $_GET['id'];

                    if(!is_numeric($id))
                    {
                        http_response_code(404);
                        echo "Cette image n'existe pas";
                        include("footer.php");
                        die();
                    }

                    $query3 = $db->prepare("SELECT * FROM images WHERE id=?");
                    $query3->execute(array($_GET['id']));
                    $data3 = $query3->fetch(PDO::FETCH_ASSOC);

                    if (!$data3)
                    {
                        http_response_code(404);
                        echo "Cette image n'existe pas";
                        include("footer.php");
                        die();
                    }
                    else
                    {

                    $query4 = $db->prepare("SELECT * FROM likes WHERE users_id = ? AND images_id = ?");
                    $query4->execute(array($_SESSION['id'], $_GET['id']));
                    $data4 = $query4->fetch();


                    ?>
                    <div class="col-s-12 col-m-6 col-l-6">
                        <div class="apercu_image">
                            <img src="img/uploads/<?= $id ?>.png" style="width: 100%;"></br>
                        </div>


                        <?php

                        if ($data3['users_id'] == $_SESSION['id']) {
                            ?>
                            <div class="col-s-6 col-m-6 col-l-6">
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" class="delete button">Supprimer le montage</button>
                                </form>
                            </div>
                            <?php
                        }

                        ?>

                        <div class="vote <?= Vote::getClass($vote); ?> col-s-6 col-m-6 col-l-6">
                            <div class="vote_bar">
                                <div class="vote_progress"
                                     style="width:<?= ($data3['like_count'] + $data3['dislike_count']) == 0 ? 100 : round(100 * ($data3['like_count'] / ($data3['like_count'] + $data3['dislike_count']))); ?>%;"></div>
                            </div>

                            <div class="vote_btns">
                                <form action="like.php" method="post">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="vote" value="1">
                                    <button type="submit" class="vote_btn vote_like"><i
                                                class="icon-thumbs-up-alt"></i><?= $data3['like_count'] ?></button>
                                </form>
                                <form action="like.php" method="post">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="vote" value="-1">
                                    <button type="submit" class="vote_btn vote_dislike"><i
                                                class="icon-thumbs-down-alt"></i><?= $data3['dislike_count'] ?></button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-s-12 col-m-6 col-l-6">

                        <div class="form-style-8">
                            <h2>Ecrire un commentaire</h2>
                            <form action="commentaires.php?id=<?= $id ?>" method="post">
                                <textarea name="commentaire" placeholder="Votre commentaire"
                                          onkeyup="adjust_textarea(this)"></textarea>
                                <input type="submit" value="Commenter"/>
                            </form>
                        </div>


                        <?php
                        $query = $db->prepare("SELECT * FROM commentaires WHERE images_id=$id ORDER BY date DESC");
                        $query->execute();
                        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
                        $query->CloseCursor();
                        ?>

                        <div class="col-s-12 col-m-12 col-l-12" style="margin-bottom: 100px;">
                            <?php
                            foreach ($data as $comment)
                            {
                                $tmp = $comment['users_id'];
                                $query2 = $db->prepare("SELECT user_name FROM users WHERE id=$tmp");
                                $query2->execute();
                                $data2 = $query2->fetchAll(\PDO::FETCH_ASSOC);
                                $query2->CloseCursor();

                                if ($comment["images_id"] == $id)
                                {
                                    ?>
                                    <br/><br/>
                                    <div class="col-s-12 col-m-12 col-l-12" style="border-bottom: 1px solid #ddd; margin: 5px 0px;">
                                        <table class="col-s-12 col-m-12 col-l-12" width="350" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td><strong style="color:#0277bd;">Par
                                                        : <?php echo stripslashes(htmlspecialchars($data2[0]['user_name'])); ?></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 20px;"><?php echo nl2br(stripslashes(htmlspecialchars($comment['commentaire']))); ?></td>
                                            </tr>
                                        </table>
                                        <br/><br/>
                                        <br/><br/>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="site_cache" id="site_cache"></div>
        <?php
        include("footer.php");
        ?>
    </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>

<script type="text/javascript">
    //auto expand textarea
    function adjust_textarea(h) {
        h.style.height = "20px";
        h.style.height = (h.scrollHeight)+"px";
    }
</script>

</body>


<?php
include("fin.php");
?>




