<?php include('profileImages.php'); ?>
<?php include('connection.php'); ?>
<?php include('getUsername.php'); ?>
<?php include('setProfilePic.php'); ?>
<?php session_start(); ?>

<?php if($_SESSION['username'] == $userH){

    echo "<link rel='stylesheet' href='home.css'>";
    echo '<link rel="stylesheet" href="home.css">';

    echo "<nav class='nav'>
        <div class='logo'>
            <img src='logo_transparent.png' style='width: 60px'>
        </div>

        <ul class='nav-links'>
            <li>
                <a href='home.php?uidUsers={$_SESSION['username']}'>Home</a>
            </li>

            <li>
                <a href='profile.php?uidUsers={$_SESSION['username']}'>Profile</a>
            </li>

            <li>
               <a href='settings.php?uidUsers={$_SESSION['username']}'>Settings</a>
            </li>

            <li>
                <a href='signOut.php'>Sign out</a>
            </li>

            <li>
                <img class='avatar' src='data:image;base64, {$rowPic[3]}'>  
            </li>
        </ul>


        <div class='mobile'>        <!--za mobitel-->  
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </nav>";

    include('allImages.php');

    echo '<script src="home.js">
    </script>';
}
else {
    header("Location: ../includes/guest.php?uidUsers=".$userH);
    exit();
}
?>