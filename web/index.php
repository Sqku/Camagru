<?php
    include("db_start.php");
?>

<?php
    include("debut.php");
?>

<body>
    <div class="site-container">
        <div class="site-pusher">
            <?php
                include("header.php");
                //include("menu.php");
            ?>
            <div class="content">
                <div class="row">
                    <div class="col-s-12 col-m-10 col-m-push-1 col-l-10 col-l-push-1" id="bienvenue">
                        <h1>Bienvenue sur Camagru !</h1>
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
</body>


<?php
    include("fin.php");
?>
