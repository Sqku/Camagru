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
                if ($id!=0)
                {
                    $message = '<p>Cliquez <a href="./index.php">ici</a> pour aller à la page d\'accueil';
                    echo "Vous êtes déjà connecté";
                    echo stripslashes($message);
                    die();
                }
                ?>

                <?php

                if (!isset($_POST['pseudo']))
                {
                    ?>
                    <form method="post" action="connexion.php">
	                <fieldset>
	                <legend>Connexion</legend>
	                <p>
	                <label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	                <label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	                </p>
	                <p><input type="submit" value="Connexion" /></p>
	                </fieldset>
                    </form></br>
	                <a href="register.php">Pas encore inscrit ?</a></br>
	                <a href="new_pass.php">Mot de passe oublie</a>
                    <?php
                }

                else
                {
                    $message='';
                    $pseudo = $_POST['pseudo'];
                    if (empty($_POST['pseudo']) || empty($_POST['password']) )
                    {
                        $message = 'Veuillez completer le champs "Pseudo" et le champs "Mot de Passe" </br> 
                                    Cliquez <a href="./connexion.php">ici</a> pour revenir à la page précédente';
                    }
                    else
                    {
                        $query=$db->prepare('SELECT mdp, id, lvl, user_name, actif FROM users WHERE user_name = :pseudo');
                        $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                        $query->execute();
                        $data=$query->fetch();
                        if ($data['mdp'] == sha1($_POST['password']))
                        {
                            if($query->execute(array(':pseudo' => $pseudo))  && $row = $query->fetch())
                            {
                                $actif = $row['actif'];
                            }
                            if($actif == 1)
                            {
                                $_SESSION['pseudo'] = $data['user_name'];
                                $_SESSION['level'] = $data['lvl'];
                                $_SESSION['id'] = $data['id'];
                                $message = '<p>Bienvenue '.htmlspecialchars($data['user_name']).', vous êtes maintenant connecté!</p>
                                <p>Cliquez <a href="./deconnexion.php">ici</a> pour vous deconnecter</p>';
                            }
                            else
                            {
                                echo 'Veuillez activer votre compte !';
                            }
                        }
                        else
                        {
                            $message = '<p>Une erreur s\'est produite pendant votre identification.<br /> Le mot de passe ou le pseudo entré n\'est pas correcte.</p>
                                        <p>Cliquez <a href="./connexion.php">ici</a> pour revenir à la page précédente
                                        <br /><br />Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';
                        }
                        $query->CloseCursor();
                    }
                    echo $message;
                }
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