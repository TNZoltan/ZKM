<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/13/2017
 * Time: 4:24 PM
 */
include('../../../../wp-load.php');

$request = getRequest();

showItemUpdate($request["id"]);
