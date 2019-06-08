<?php

//za sign in skripta

if(isset($_POST['signInButton'])) {
    require 'connection.php';

    $user = $_POST['user'];
    $password = $_POST['passw'];

    if(empty($user) ||empty($password)) {
        header("location: ../Fotogram/index.php?error=emptyfields&emailUsers=".$user."pwdUsers=".$password);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../Fotogram/signUp.php?error=sqlerror&email=".$user."email=".$password);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row=mysqli_fetch_assoc($result);

            if ($row == true){
                $pwdCheck = password_verify($password, $row['pwdUsers']);
    
                if ($pwdCheck == false) {
                    header("location: ../Fotogram/index.php?error=wrongpassword&p=".$row['pwdUsers']."pm=".$password);
                    exit();
                }
                else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userID'] = $row['idUser'];
                    $_SESSION['username'] = $row['uidUsers'];
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}