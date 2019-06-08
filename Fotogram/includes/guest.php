<?php include('profileImages.php'); ?>
<?php include('connection.php'); ?>
<?php include('getUsername.php'); ?>
<?php include('setProfilePic.php'); ?>
<?php session_start(); ?>

<?php
    $sql1 = "SELECT * FROM users WHERE uidUsers='$userH'";
    $res1 = mysqli_query($conn, $sql1);

    $row1 = mysqli_fetch_array($res1);
?>

<?php if(isset($_SESSION['username'])){
    echo "<link rel='stylesheet' href='home.css'>";

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

    if($row1[6] == "public") {
        $sql = "SELECT * FROM images WHERE uidUsers='$userH'";
        $res = mysqli_query($conn, $sql);

        echo '<div class="grid">';
        while($row = mysqli_fetch_array($res)) {
            echo '<div>';
            echo '<a href="" class="links">';
            echo '<img height="500" width="500" style="padding:5px" src="data:image;base64,'.$row[3].'">';
            echo '</a>';
            echo '</div>';
        }  
        echo '</div>';

        $sql1 = "SELECT * FROM images WHERE uidUsers='$userH'";
        $res1 = mysqli_query($conn, $sql1);

        while($row1 = mysqli_fetch_array($res1)) {
            echo '<div id="img" class="lightbox">';
            echo '<a href="#" class="close"></a>';
            echo '<img height="756" width="756" style="padding:5px" src="data:image;base64,'.$row1[3].'">';
            echo '</div>';
        } 

        echo '<script>
            var listOfImages = document.getElementsByClassName("lightbox");
            for (var i = 0; i < listOfImages.length; i++) {
                listOfImages[i].id = "img" + i;
            }

            var linksOfImages = document.getElementsByClassName("links");
            for (var i = 0; i < linksOfImages.length; i++) {
                linksOfImages[i].href = "#img" + i;
            }
        </script>';
    }
    else {
        echo 'Profil is private!';
    }
}
else {
    echo "<link rel='stylesheet' href='home.css'>";

    echo "<nav class='nav'>
        <div class='logo'>
            <img src='logo_transparent.png' style='width: 60px'>
        </div>

        <ul class='nav-links'>
            <li>
                <a href='home.php?uidUsers={$userH}' style='pointer-events: none; cursor: default;'>Home</a>
            </li>

            <li>
                <a href='profile.php?uidUsers={$userH}' style='pointer-events: none; cursor: default;'>Profile</a>
            </li>

            <li>
               <a href='settings.php?uidUsers={$userH}' style='pointer-events: none; cursor: default;'>Settings</a>
            </li>

            <li>
                <a href='signOut.php' style='pointer-events: none; cursor: default;'>Sign out</a>
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

    if($row1[6] == "public") {
        $sql = "SELECT * FROM images WHERE uidUsers='$userH'";
        $res = mysqli_query($conn, $sql);

        echo '<div class="grid">';
        while($row = mysqli_fetch_array($res)) {
            echo '<div>';
            echo '<a href="" class="links">';
            echo '<img height="500" width="500" style="padding:5px" src="data:image;base64,'.$row[3].'">';
            echo '</a>';
            echo '</div>';
        }  
        echo '</div>';

        $sql1 = "SELECT * FROM images WHERE uidUsers='$userH'";
        $res1 = mysqli_query($conn, $sql1);

        while($row1 = mysqli_fetch_array($res1)) {
            echo '<div id="img" class="lightbox">';
            echo '<a href="#" class="close"></a>';
            echo '<img height="756" width="756" style="padding:5px" src="data:image;base64,'.$row1[3].'">';
            echo '</div>';
        } 

        echo '<script>
            var listOfImages = document.getElementsByClassName("lightbox");
            for (var i = 0; i < listOfImages.length; i++) {
                listOfImages[i].id = "img" + i;
            }

            var linksOfImages = document.getElementsByClassName("links");
            for (var i = 0; i < linksOfImages.length; i++) {
                linksOfImages[i].href = "#img" + i;
            }
        </script>'; 
    }
    else {
        echo 'Profil is private!';
    }
}
mysqli_close($conn);
?>