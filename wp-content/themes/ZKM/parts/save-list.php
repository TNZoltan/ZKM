<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/5/2017
 * Time: 9:31 PM
 */
include('../../../../wp-load.php');

$foodList = getFoodList();

$request = getRequest();

foreach($foodList as $food){
    if(!empty($request[$food->index] || $request[$food->index] == "0")){
        setFoodStatus($food->index,intval($request[$food->index]));
    }
}
$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);