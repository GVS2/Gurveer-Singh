<?php
/*session_start();
require "con.php";
$senderID = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['sendMessage'])) {
    $msgFragments = explode("-", $msg);
    $receiverID = $msgFragments[0];
    $MSG = $msgFragments[1];
    $sql = "INSERT INTO message_tb (id, sender_id, receiver_id, message) VALUES ('', '$senderID', '$receiverID', '$MSG', NOW())";
    $result = @mysqli_query($con, $sql);
    if (@mysqli_query($con, $sql)) {
        echo "sent";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}*/
session_start();
require ('con.php');
$senderID = $_SESSION['id'];
$name = $_REQUEST['name'];
$explodedname = explode("-", $name);

$receiverID  = $explodedname[0];
$message = $explodedname[1];

$q = "INSERT INTO message_tb (id, sender_id, receiver_id,  mesage, clock ) VALUES
 ('','$senderID', '$receiverID ','$message', '')";
$result = @mysqli_query ($con, $q); // Run the query.