<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/3/2017
 * Time: 5:11 PM
 */
include('../../../../wp-load.php');

if (isDevelopment()){
    include "simple_html_dom.php";
    $search_query = $_GET['name'] . ' organic';
    $search_query = urlencode( $search_query );
    $html = file_get_html( "https://www.google.com/search?q=$search_query&tbm=isch" );
    $containers = $html->getElementById('center_col');
    $image = $containers->getElementByTagName('img');
    $imageLink = $image->getAttribute('src');

    global $wpdb;
    if (!empty($_GET['name'])){
        $wpdb->insert('food',array (
            'name' => $_GET['name'],
            'img' =>  $imageLink,
            'priority' => $_GET['priority'],
            'expiry' => $_GET['expiry'],
            'in_fridge' => 0
        ));
    }
} else {
    global $wpdb;
    if (!empty($_GET['name'])){
        $wpdb->insert('food',array (
            'name' => $_GET['name'],
            'priority' => $_GET['priority'],
            'expiry' => $_GET['expiry'],
            'in_fridge' => 0
        ));
    }
}


wp_redirect(get_post_permalink($_GET['page']));
