<?php
/*
Template Name: Register
*/
$error = false;
if(!empty($_POST)){
    $data = $_POST;
    if($data['user_pass'] != $data['user_pass2']){
        $error = 'Les 2 mots de passes ne correspondent pas';
    }else{
        if(!is_email($data['user_email'])){
            $error = 'Veuillez entrer un email valide';
        }else{
            $user = wp_insert_user(array(
                'user_login' => $data['user_login'],
                'user_pass'  => $data['user_pass'],
                'user_email' => $data['user_email'],
                'user_registered' => date('Y-m-d H:i:s')
            ));
            if(is_wp_error($user)){
                $error = $user->get_error_message();
            }else{
                $msg = 'Vous êtes maintenant inscrit';
                $headers = 'From: '.get_option('admin_email')."\r\n";
                wp_mail($data['user_email'], 'Inscription réussie', $msg, $headers );
                $data = array();
                wp_signon($_POST);
                header('Location:profil');
            }

        }
    }
}
?>
<?php get_header();?>

<div class="single">
    <div class="post">
        <h1>S'inscrire</h1>

        <?php if ($error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif ?>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <label for="user_login">Votre login</label>
            <input type="text" value="<?php echo isset($data['user_login']) ? $data['user_login'] : ''; ?>" name="user_login" id="user_login">

            <label for="user_email">Votre email</label>
            <input type="text" value="<?php echo isset($data['user_email']) ? $data['user_email'] : ''; ?>" name="user_email" id="user_email">

            <label for="user_pass">Votre mot de pass</label>
            <input type="password" value="<?php echo isset($data['user_pass']) ? $data['user_pass'] : ''; ?>" name="user_pass" id="user_pass">

            <label for="user_pass2">Confirmez votre mot de pass</label>
            <input type="password" value="<?php echo isset($data['user_pass2']) ? $data['user_pass2'] : ''; ?>" name="user_pass2" id="user_pass2">

            <input type="submit" value="S'inscrire">

        </form>

    </div>
</div>

<?php get_footer(); ?>
