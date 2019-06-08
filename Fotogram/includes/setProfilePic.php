<?php

include('getUserName.php');
require 'connection.php';

$sqlPic = "SELECT * FROM profileimages WHERE uidUsers='$userH'";
$resPic = mysqli_query($conn, $sqlPic);
$rowPic = mysqli_fetch_array($resPic);

?>