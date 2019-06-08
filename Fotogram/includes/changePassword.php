<?php
include('getUsername.php');

if(isset($_POST['changePassword'])){
    require 'connection.php';

    $oldPassword = $_POST['old'];
    $newPassword = $_POST['new'];

    if(empty($oldPassword) || empty($newPassword)) {
        header("location: ../includes/settings.php?uidUsers=".$userH);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../Fotogram/signUp.php?error=sqlerror&uidUsers=".$userH);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userH);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row=mysqli_fetch_assoc($result);

            if ($row == true){
                $pwdCheck = password_verify($oldPassword, $row['pwdUsers']);
    
                if ($pwdCheck == false) {
                    header("location: ../Fotogram/index.php?error=wrongpassword&p=".$row['pwdUsers']."pm=".$oldPassword);
                    exit();
                }
                else if ($pwdCheck == true) {
                    $sql1 = "UPDATE users SET pwdUsers=? WHERE uidUsers=?";
                    $stmt1 = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt1, $sql1)){
                        header("Location: ../includes/settings.php?error=sqlerror&uidUsers=".$userH);
                        exit();
                    }
                    else {
                        $hashedPwd = password_hash($newPassword, PASSWORD_DEFAULT);
                        mysqli_stmt_prepare($stmt1, $sql1);

                        mysqli_stmt_bind_param($stmt1, "ss", $hashedPwd, $userH);
                        mysqli_stmt_execute($stmt1);
                        header("Location: ../includes/settings.php?uidUsers=".$userH);
                        exit();

                        }
                    }
                }
            }
        }
        mysqli_close($conn);
    }