<?php
session_start();
include_once "./func/dbconnect.php";
include "./func/random_id.php";
$mysqli = new mysqli("localhost", $username, $password, $database);

if(isset($_GET['name']) && isset($_GET['picture']) && isset($_SESSION['id'])) {
    $serverid = random_id(20);
    $inviteid = random_id(20);
    $name = $_GET['name'];
    $joinkey = random_id(50);
    $ownerid = $_SESSION['id'];
    $pictureURL = $_GET['picture'];

    mysqli_query($mysqli, "INSERT INTO servers VALUES ('".$serverid."', '".$ownerid."', '".$name."', '".$pictureURL."', '".$joinkey."')");
    mysqli_query($mysqli, "INSERT INTO invites VALUES ('".$inviteid."', '".$serverid."', '".$ownerid."')");

    echo '<a href="http://'.$_SERVER['SERVER_NAME']."/invite?id=".$inviteid.'">http://'.$_SERVER['SERVER_NAME']."/invite?id=".$inviteid.'</a>';
}


?>