<?php
include('getUsername.php');

if(isset($_POST['uploadProfilePic'])){
    require 'connection.php';

    if(getimagesize($_FILES['img']['tmp_name']) == FALSE) {
        echo 'Please select image.';
    }
    else {
        $image = addslashes($_FILES['img']['tmp_name']);
        $name = addslashes($_FILES['img']['name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);
        
        $sql = "INSERT INTO images (uidUsers, imgName, img) VALUES ('$userH', '$name', '$image')";
        mysqli_query($conn, $sql);

        /*$sql = "SELECT * FROM images";
        $res = mysqli_query($conn, $sql);                //nesto ne radi na ovaj način kada se slika učitava u bazu, pa sam morao na drugi, nesigurni način

        while($row = mysqli_fetch_array($res)) {
            echo '<img height="300" width="300" src="data:image;base64,'.$row[3].' ">';
        }*/

        /*$stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../include/profile.php?error=sqlerror&uidUsers=".$userH);
            exit();
        }
        else {
            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "ssb", $userH, $name, $image);
            mysqli_stmt_execute($stmt);

            header("Location: ../includes/profile.php?uidUsers=".$userH);
            exit();
        }*/
    }

    //mysqli_stmt_close($stmt);
    header("Location: ../includes/profile.php?uidUsers=".$userH);
    exit();
    mysqli_close($conn);
}