<?php

// Register a new sidebar simply named 'sidebar'
function add_widget_Support() {
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
}
// Hook the widget initiation and run our function
add_action( 'widgets_init', 'add_Widget_Support' );

// Register a new navigation menu
function add_Main_Nav() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
// Hook to the init action hook, run our navigation menu function
add_action('init', 'add_Main_Nav' );

add_action('send_headers', 'site_router');

function site_router(){
    $root = str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
    $url  = str_replace($root ,'',$_SERVER['REQUEST_URI']);
    $url  = explode('/',$url);
    if(count($url) == 1 && $url[0] == 'login'){
        require 'login.php';
        die();
    }else if(count($url) == 1 && $url[0] == 'profil'){
        require 'profil.php';
        die();
    }else if(count($url) == 1 && $url[0] == 'logout'){
        wp_logout();
        header('location:'.$root);
        die();
    } else if(count($url) == 1 && $url[0] == 'register'){
        require 'register.php';
        die();
    }else if(count($url) == 1 && $url[0] == 'reservation'){
        require 'reservation.php';
        die();
    }
}

add_filter('show_admin_bar','__return_false');