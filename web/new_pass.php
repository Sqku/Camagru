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
                <div class="col-s-12 col-m-10 col-m-push-1 col-l-10 col-l-push-1" id="bienvenue">
                    <?php
                    if($id != 0)
                    {
                        echo 'Vous êtes déjà connecté';
                    }
                    else
                    {
                        if (!isset($_POST['pseudo'])) {

                            ?>
                            <div class="form-style-8 " style="text-align: center; width:100%; margin: 15px 0 66px 0;">
                                <h2>Mot de passe oublié</h2>
                                <form method="post" action="new_pass.php">
                                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" />
                                    <input type="email" name="email" id="email" placeholder="E-mail" />
                                    <input type="submit" value="Réinitialiser le mot de passe" />
                                </form>
                            </div>
                            <?php





                        } else {
                            $pseudo = $_POST['pseudo'];
                            $email = $_POST['email'];
                            $query = $db->prepare("SELECT * FROM users WHERE user_name = ? AND email = ? AND actif = ?");
                            $query->execute(array($pseudo, $email, 1));
                            $data = $query->fetch();

                            $query->CloseCursor();

                            if ($data) {
                                $cle = sha1(microtime(TRUE) * 100000);

                                $query = $db->prepare("UPDATE users SET cle = ? WHERE id = {$data['id']}");
                                $query->execute(array($cle));

                                $mail = $data['email'];


                                $sujet = "Reinitialiser le mot de passe";
                                $entete = "From: camagru";
                                $message = 'Bonjour,
 
        Pour reinitialiser le mot de passe, veuillez cliquer sur le lien ci dessous
        ou copier/coller dans votre navigateur internet.
         
        ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/set_pass.php?log=' . urlencode($data['user_name']) . '&cle=' . urlencode($cle) . '
         
         
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';


                                mail($mail, $sujet, $message, $entete);

                                echo '<h2>Les instructions de reinitialisation de mot de passe vous ont été envoyées par email</h2>';
                                echo '<p>Cliquez <a href="./connexion.php">ici</a> pour revenir à la page de connexion</p>';

                            } else {
                                echo '<p>le pseudo et/ou l\'email sont incorrect</p>';
                                echo '<p>Cliquez <a href="./new_pass.php">ici</a> pour recommencer</p>';
                            }
                        }
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
</body>


<?php
include("fin.php");
?>
