<?php

include "../connect.php";

$usersid = filterRequest("usersid");
$itemsid = filterRequest("itemsid");

$stmt->prepare("SELECT COUNT(cart.cart_id) as countitems FROM `cart` WHERE cart_itemsid = $itemsid AND cart_usersid = $usersid");

$stmt->execute();
$count = $stmt->rowCount();
$data = $stmt->fetchColumn();

if($count > 0){
    echo json_encode(array("status" => "success", "data" => $data));
}else {
    echo json_encode(array("status" => "success", "data" => "0"));
    
}


?>
