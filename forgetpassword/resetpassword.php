<?php
ini_set('display_errors', 1);

include "../connect.php";
$email = filterRequest("email");
$password = sha1($_POST['password']);
$data = array("users_password" => $password);
updateData("users", $data, "users_email = '$email'");

?>