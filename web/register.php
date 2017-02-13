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
                <div class="col-s-12 col-m-8 col-l-6 col-m-push-2 col-l-push-3" id="bienvenue">
                    <?php
                    if ($id!=0)
                    {
                        echo 'Vous êtes déjà inscrit et connecté';
                        echo '<p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';
                        die();
                    }

                    if (empty($_POST['pseudo']))
                    {
//                        echo '<h1>Inscription 1/2</h1>';
//                        echo '<form method="post" action="register.php" enctype="multipart/form-data">
//    <fieldset><legend>Identifiants</legend>
//    <label for="pseudo">* Pseudo :</label>  <input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)<br />
//    <label for="password">* Mot de Passe :</label><input type="password" name="password" id="password" /><br />
//    <label for="confirm">* Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" />
//    </fieldset>
//    <fieldset><legend>Contacts</legend>
//    <label for="email">* Votre adresse Mail :</label><input type="text" name="email" id="email" /><br />
//    </fieldset>
//    <p>Les champs précédés d un * sont obligatoires</p>
//    <p><input type="submit" value="S\'inscrire" /></p></form>
//    </div>
//    </body>
//    </html>';


                        ?>

                        <div class="col-s-12 col-m-12 col-l-12">
                            <div class="form-style-8 " style="text-align: center; width:100%; margin: 15px 0 66px 0;">
                                <h2>Inscription 1/2</h2>
                                <form method="post" action="register.php" enctype="multipart/form-data">
                                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)</br></br>
                                    <input type="password" name="password" id="password" placeholder="Mot de passe" />
                                    <input type="password" name="confirm" id="confirm" placeholder="Confirmer le mot de passe"/>
                                    <input type="email" name="email" id="email" placeholder="Votre E-mail"/>
                                    <input type="submit" value="S'inscrire" />
                                </form>
                                </br></br>
                            </div>
                        </div>

                        <?php

                    }


                    else
                    {
                        $pseudo_erreur1 = NULL;
                        $pseudo_erreur2 = NULL;
                        $mdp_erreur = NULL;
                        $email_erreur1 = NULL;
                        $email_erreur2 = NULL;

                        $i = 0;
                        $pseudo = $_POST['pseudo'];
                        $email = $_POST['email'];
                        $pass = sha1($_POST['password']);
                        $confirm = sha1($_POST['confirm']);

                        $query=$db->prepare('SELECT COUNT(*) AS nbr FROM users WHERE user_name = :pseudo');
                        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
                        $query->execute();
                        $pseudo_free=($query->fetchColumn()==0)?1:0;
                        $query->CloseCursor();
                        if(!$pseudo_free)
                        {
                            $pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre";
                            $i++;
                        }

                        if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
                        {
                            $pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
                            $i++;
                        }

                        if ($pass != $confirm || empty($confirm) || empty($pass))
                        {
                            $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
                            $i++;
                        }


                        $query=$db->prepare('SELECT COUNT(*) AS nbr FROM users WHERE email = :mail');
                        $query->bindValue(':mail', $email, PDO::PARAM_STR);
                        $query->execute();
                        $mail_free=($query->fetchColumn()==0)?1:0;
                        $query->CloseCursor();

                        if(!$mail_free)
                        {
                            $email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
                            $i++;
                        }

                        if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
                        {
                            $email_erreur2 = "Votre adresse E-Mail n'a pas un format valide";
                            $i++;
                        }

                        if ($i==0)
                        {
                            $cle = sha1(microtime(TRUE)*100000);

                            try {
                                $query=$db->prepare('INSERT INTO users (user_name, mdp, email, cle)
                VALUES (:pseudo, :pass, :email, :cle)');
                                $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
                                $query->bindValue(':pass', $pass, PDO::PARAM_INT);
                                $query->bindValue(':email', $email, PDO::PARAM_STR);
                                $query->bindValue(':cle', $cle, PDO::PARAM_STR);
                                $query->execute();
                            } catch (PDOException $e) {
                                echo 'Pdo error: '.$e->getMessage();
                                die();
                            }

                            $query->CloseCursor();

//                            echo'<h1>Inscription 2/2 terminée</h1>';
//                            echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).' vous êtes maintenant inscrit</p>
//        <p>Un email de confirmation vous a été envoyé a votre adresse email</p>
//    	<p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';


                            ?>

                            <div class="col-s-12 col-m-12 col-l-12">
                                <div class="form-style-8 " style="text-align: center; width:100%; margin: 15px 0 66px 0;">
                                    <h2>Inscription 2/2</h2>
                                    <form>
                                        <p>Bienvenue <strong><?php echo(stripslashes(htmlspecialchars($_POST['pseudo'])))?></strong> vous êtes maintenant inscrit</p>
                                        <p>Un email de confirmation vous a été envoyé a votre adresse email</p></br>
                                        <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>
                                    </form>
                                    </br></br>
                                </div>
                            </div>

                            <?php



                            $email = $_POST['email'];


                            $sujet = "Activez votre compte" ;
                            $entete = "From: camagru" ;
                            $message = 'Bienvenue sur Camagru,
 
        Pour activer votre compte, veuillez cliquer sur le lien ci dessous
        ou copier/coller dans votre navigateur internet.
         
        '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/validation.php?log='.urlencode($pseudo).'&cle='.urlencode($cle).'
         
         
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';


                            mail($email, $sujet, $message, $entete);

                            //$_SESSION['pseudo'] = $pseudo;
                            //$_SESSION['id'] = $db->lastInsertId();
                            //$_SESSION['level'] = 2;
                        }
                        else
                        {
                            echo'<h1>Inscription interrompue</h1>';
                            echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
                            echo'<p>'.$i.' erreur(s)</p>';
                            echo'<p>'.$pseudo_erreur1.'</p>';
                            echo'<p>'.$pseudo_erreur2.'</p>';
                            echo'<p>'.$mdp_erreur.'</p>';
                            echo'<p>'.$email_erreur1.'</p>';
                            echo'<p>'.$email_erreur2.'</p>';

                            echo'<p>Cliquez <a href="./register.php">ici</a> pour recommencer</p>';
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
