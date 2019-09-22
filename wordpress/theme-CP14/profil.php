<?php
/*
Template Name: Profil
*/
$user = wp_get_current_user();
if($user->ID == 0){
    header('location:login');
}
if(!empty($_POST)){
    update_user_meta(get_current_user_id(),'prenom', $_POST['prenom']);
}
?>
<?php get_header();?>
    <div>
        <h1>Mes informations</h1>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

            <label for="prenom">Votre prenom </label>
            <input type="text" name="prenom" value="<?php echo get_user_meta(get_current_user_id(),'prenom',true); ?>">

            <input type="submit" value="modifier">

        </form>

    </div>
<?php get_footer(); ?>