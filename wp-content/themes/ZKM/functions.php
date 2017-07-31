<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 7/31/2017
 * Time: 4:11 PM
 */

//Start a session
if (!session_id()) {
    session_start();
}

//Add bootstrap to the project
add_action( 'wp_enqueue_scripts', 'add_bootstrap');
function add_bootstrap() {
    wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/library/css/bootstrap.min.css');
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/library/js/bootstrap.min.js');
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_script('bootstrap-js');
}
//Add jQuery to the project
add_action( 'wp_enqueue_scripts', 'add_jquery');
function add_jquery() {
    wp_register_script( 'jquery-js', get_template_directory_uri() . '/library/js/jquery.min.js');
    wp_enqueue_script('jquery-js');
}