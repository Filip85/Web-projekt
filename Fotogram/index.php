<?php include('serverSignIn.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fotogram</title>
</head>
<body>

    <div class="signIn">
        <img src="logo.png" class="loginAvatar">
        <h1>
             Sign In
        </h1>
        <form method='post'>
            <label for="user">Username</label>
            <input type="text" name="user" placeholder="Username">

            <label for="passw">Password</label>
            <input type="password" name="passw" placeholder="Password">

            <input type="submit" name="signInButton" value="Sign In">

            <a href="signUp.php">Don't have an account? Click here.</a>
        </form>
    </div>

    <?php
        if (isset($_SESSION['userID'])) {
            header("location: ../Fotogram/includes/home.php?uidUsers=".$_SESSION['username']);
            exit();
        }

    ?>
    
</body>
</html>