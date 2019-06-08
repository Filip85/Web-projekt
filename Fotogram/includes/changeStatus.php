
<?php

require 'connection.php';
include('getUsername.php');
session_start();

$newChecked = $_POST['newChecked'];

$sql = "UPDATE users SET stat=? WHERE uidUsers=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../includes/settings.php?error=sqlerror&uidUsers=".$userH);
        exit();
}
else {
        mysqli_stmt_prepare($stmt, $sql);

        mysqli_stmt_bind_param($stmt, "ss", $newChecked, $_SESSION['username']);
        mysqli_stmt_execute($stmt);
}
mysqli_close($conn); 

