<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/4/2017
 * Time: 2:19 PM
 */

include('../../../../wp-load.php');


$post_args = array(
    'post_title' => $_GET['name'],
    'post_content' => $_GET['desc'],
    'post_status' => 'publish'
);

$post_id = wp_insert_post($post_args);

global $wpdb;

$wpdb->insert('recipes',array (
    'name' => $_GET['name'],
    'page_id' => $post_id,
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/6/6d/Good_Food_Display_-_NCI_Visuals_Online.jpg'
));

foreach($_GET['food'] as $food){
    $wpdb->insert('food_recipes',array (
        'food_id' => getIdOfRecord('food',$food),
        'recipe_id' => getIdOfRecord('recipes',$_GET['name'])
    ));
}

wp_redirect(get_post_permalink(19));
