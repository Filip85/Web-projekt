<?php
include('getUsername.php');

if(isset($_POST['uploadProfilePic'])){
    require 'connection.php';

    if(getimagesize($_FILES['imgP']['tmp_name']) == FALSE) {
        echo 'Please select image.';
    }
    else {
        $imageP = addslashes($_FILES['imgP']['tmp_name']);
        $nameP = addslashes($_FILES['imgP']['name']);
        $imageP = file_get_contents($imageP);
        $imageP = base64_encode($imageP);

        $sql = "SELECT * FROM profileimages WHERE uidUsers= '$userH'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($result);

       if($row == 0) {
            $sql1 = "INSERT INTO profileimages (uidUsers, profileImageName, profileImg) VALUES ('$userH', '$nameP', '$imageP')";
            mysqli_query($conn, $sql1);
        }
        else {
            $sql1 = "UPDATE profileimages SET profileImageName='$nameP', profileImg='$imageP' WHERE uidUsers='$userH'";
            mysqli_query($conn, $sql1);
        }
    mysqli_close($conn);
    }
}