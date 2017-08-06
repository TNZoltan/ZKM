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
    if(!empty($request[$food->id] || $request[$food->id] == "0")){
        $message = setFoodStatus($food->id,intval($request[$food->id]));
    }
}
$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);