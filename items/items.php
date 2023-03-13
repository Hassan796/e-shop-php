<?php

 include "../connect.php";

 // getAllData('itemsview', "categories_id = $categoryid" );
 $categoryid = filterRequest("id");

 $usersid = filterRequest("usersid");
  $stmt = $con->prepare("SELECT items1view.* , 1 as favorite , items_price - (items_price * (items_discount /100)) as itemspricediscount FROM items1view
  INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid =  $usersid
  AND categories_id = $categoryid 
  UNION ALL
  SELECT * , 0 as favorite, items_price - (items_price * (items_discount /100)) as itemspricediscount FROM items1view
  WHERE categories_id = $categoryid AND items_id NOT IN ( SELECT items1view.items_id FROM items1view
  INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid =  $usersid ) ");

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count = $stmt->rowCount();
  if ($count > 0) {
    # code...
    echo json_encode(array("status" => "success", "data" => $data));
  }else {
    # code...
    echo json_encode(array("status" => "failure"));

  }

?>