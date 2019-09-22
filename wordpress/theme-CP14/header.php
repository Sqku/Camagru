<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
    <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php $user = wp_get_current_user(); ?>
<header class="my-logo">
    <span>
        <a title="<?php bloginfo('name');?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php bloginfo('template_directory');?>/images/logo.png" style="height: 80px;">
        </a>
        Hello <?php echo $user->user_login;?>
    </span>
    <nav>
        <label for="menu-mobile" class="menu-mobile">Menu</label>
        <input type="checkbox" id="menu-mobile" role="button">
        <ul>
            <?php
            wp_list_pages("depth=1&title_li=")
            ?>

            <li>
                <a href="<?php bloginfo('url'); ?>/reservation">Reservation</a>
            </li>

            <?php if($user->ID == 0): ?>
                <li>
                    <a href="<?php bloginfo('url'); ?>/login">Se connecter</a> |
                    <a href="<?php bloginfo('url'); ?>/register">S'inscrire</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php bloginfo('url'); ?>/profil">Mon profil</a> |
                    <a href="<?php bloginfo('url'); ?>/logout">Se deconnecter</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</header>