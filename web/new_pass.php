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
                        $pseudo = $_POST['pseudo'];
                        $email = $_POST['email'];


                        if (!isset($_POST['pseudo'])) {
                            echo '<form method="post" action="new_pass.php">
	<fieldset>
	<legend>Mot de passe oublie</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="email">Votre adresse Mail :</label><input type="text" name="email" id="email" /><br />
	</p>
	</fieldset>
	<p><input type="submit" value="Reinitialiser le mot de passe" /></p></form>
	 
	</div>
	</body>
	</html>';
                        } else {
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

                                echo '<h1>Les instructions de reinitialisation de mot de passe vous ont été envoyées par email</h1>';
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
