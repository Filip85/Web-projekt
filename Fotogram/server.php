<?php

//za sign up skripta

session_start();

$errors = array();

if (isset($_POST['signUpButton'])) {
    require 'connection.php';

    $firstname = $_POST['first'];
    $lastname = $_POST['last'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password_1 = $_POST['password'];
    $password_2 = $_POST['repeat'];

    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password_1) || empty($password_2)){
        header("Location: ../Fotogram/signUp.php?error=emptyfields&first=".$firstname."last=".$lastname."email=".$email."username=".$username."password=".$password_1."repeat=".$password_2);
        exit();
    }   
    else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../Fotogram/signUp.php?error=sqlerror&username=".$username."email=".$email);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);   //prolazimo kroz sve usere u bazi
            mysqli_stmt_store_result($stmt);   //za fetchanje podataka iz baze

            $resulCheck = mysqli_stmt_num_rows($stmt);  //koliko rowsa ima istih odnosno usera pošto će nam vratiti row

            if($resulCheck > 0) {
                header("Location: ../signUp.php?error=usernametaken&email=".$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (firstNameUsers, lastNameUsers, uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signUp.php?error=sqlerror&username=".$username."email=".$email);
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                    mysqli_stmt_prepare($stmt, $sql);

                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);   //prolazimo kroz sve usere u bazi

                    $sql1="SELECT * FROM users WHERE uidUsers = '$username'";
                    $result=mysqli_query($conn,$sql1);              // mysqli_get_results($stmt)

                    $row=mysqli_fetch_array($result);
                    $userN = $row['uidUsers'];

                    $_SESSION['userID'] = $row['idUser'];
                    $_SESSION['username'] = $row['uidUsers'];

                    header("Location: ../Fotogram/includes/home.php?uidUsers=".$_SESSION['username']);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}



