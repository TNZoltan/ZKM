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
add_action( 'wp_enqueue_scripts', 'add_styles');
function add_styles() {
    wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/library/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-css');
    wp_register_style( 'style-css', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('style-css');
}
//Add jQuery to the project
add_action( 'wp_enqueue_scripts', 'add_scripts');
function add_scripts() {
    wp_register_script( 'jquery-js', get_template_directory_uri() . '/library/js/jquery.min.js');
    wp_enqueue_script('jquery-js');
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/library/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap-js');
}

function getRequest(){
    return $_POST;
}

function getFoodList(){
    global $wpdb;
    return $wpdb->get_results('SELECT id AS "index", name, img, priority, in_fridge FROM food');
}
function getRecipeList(){
    global $wpdb;
    $recipeList = $wpdb->get_results('SELECT id, name, img FROM recipes');
    foreach ($recipeList as $recipe){
        $recipe->ingredients = $wpdb->get_results('SELECT food_id FROM food_recipes WHERE recipe_id="' . $recipe->id . '"');
    }
    return $recipeList;
}
function setFoodStatus($foodId,$status){
    global $wpdb;
    $data = array(
        'in_fridge' => $status
    );
    $where = array(
        'id' => $foodId
    );
    return $wpdb->update('food',$data,$where);
}
function getIdOfRecord($type,$food){
    global $wpdb;
    return $wpdb->get_var('SELECT id FROM '. $type . ' WHERE name = "' . $food . '"');
}
