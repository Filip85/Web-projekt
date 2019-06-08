<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "sign_up_web";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connection_error());
}