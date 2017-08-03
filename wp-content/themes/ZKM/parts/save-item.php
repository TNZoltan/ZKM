<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/3/2017
 * Time: 5:11 PM
 */
include('../../../../wp-load.php');


var_dump($_GET);

global $wpdb;

/*$wpdb->insert('food',array (
    'name' => $_GET['name'],
    'img' =>  $_GET['image'],
    'priority' => $_GET['priority'],
    'expiry' => $_GET['priority'],
    'in_fridge' => false
));

//wp_redirect(get_post_permalink(21));