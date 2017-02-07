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
            <?php
            if(isset($erreur)){
                echo $erreur;
            }

            ?>

            <?php

            $img_par_page=3;

            $query2=$db->prepare('SELECT COUNT(*) AS total FROM images');
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

            $query=$db->prepare('SELECT * FROM images ORDER BY date DESC LIMIT '.$premiere_entree.', '.$img_par_page.'');
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
//            else
//            {
//                include("footer.php");
//                include("fin.php");
//                die();
//            }

            ?>
        </div>
        <div class="site_cache" id="site_cache"></div>
        <?php
        include("footer.php");
        ?>
    </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>
</body>


<?php
include("fin.php");
?>
