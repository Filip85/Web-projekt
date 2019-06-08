<?php session_start() ?>
<?php include('getUserName.php') ?>
<?php include('changePassword.php') ?>
<?php include('avatarImage.php') ?>
<?php include('setProfilePic.php'); ?>

<?php if($_SESSION['username'] == $userH){

    require 'connection.php';   

    echo '<link rel="stylesheet" href="style.css">';
    echo '<link rel="stylesheet" href="home.css">';
    echo '<link rel="stylesheet" href="toggle.css">';
    echo '<script src="jquery-3.4.0.min.js"></script>';
    echo '<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>';

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
    </nav>

    <div class='signIn' id='passwordForm'>
        
        <h1>
            Change password
        </h1>
        <form method='post'>
            <label for='old'>Old password</label>
            <input type='password' name='old' placeholder='Old password'>

            <label for='new'>New password</label>
            <input type='password' name='new' placeholder='New password'>

            <input type='submit' name='changePassword' value='Submit' class='button'>
            
        </form>
        <button style='margin-left: 50px; margin-top: -10px' onclick='openProfilePictureForm()'>Set/Change profile picture</button>
    </div>";

    echo "<div class='signIn form-popup' id='imageForm'>
        
        <h1>
            Change profile image
        </h1>
        <form method='post' enctype='multipart/form-data'>
            <input type='file' name='imgP'>
            <input type='submit' name='uploadProfilePic' value='Set/Change profile picture' class='button'>

        </form>
        <button style='margin-left: 75px' onclick='openPasswordForm()'>Change password</button>
    </div>";

    $sql1 = "SELECT * FROM users WHERE uidUsers='$userH'";

    $res1 = mysqli_query($conn, $sql1);

    $row1 = mysqli_fetch_array($res1);

    if($row1[6] == "private") {
        echo '
        <label class="switch">
            <input type="checkbox" id="toggle" checked>
            <div class="slider"></div>
        </label>
        <br>
        Profil is private!';
    }
    else {
        echo '
        <label class="switch">
            <input type="checkbox" id="toggle">
            <div class="slider"></div>
        </label>
        <br>
        Profil is public!'; 
    }
    
    echo '<div id="ds"></div>';

    echo "<script>
        function openProfilePictureForm() {
            document.getElementById('imageForm').style.display = 'block';
            document.getElementById('passwordForm').style.display = 'none';
        }

        function openPasswordForm() {
            document.getElementById('imageForm').style.display = 'none';
            document.getElementById('passwordForm').style.display = 'block';
        }
        </script>";

        echo '<script>
            $(document).ready(function() {
                var checked = "false";
                $("#toggle").on("change", function() {
                    if(this.checked) {
                        checked = "private";
                        $("#ds").load("changeStatus.php", {
                            newChecked : checked
                        });
                    }
                    else {
                        checked = "public";
                        $("#ds").load("changeStatus.php", {
                            newChecked : checked
                        });
                    }
                });
            });
        </script>';
        mysqli_close($conn);
}
else {
    header("Location: ../includes/guest.php?uidUsers=".$userH);
    exit();
}

?>