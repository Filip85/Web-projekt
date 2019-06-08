<?php
require 'connection.php';

$sql = "SELECT * FROM images";
$res = mysqli_query($conn, $sql);

echo "<link rel='stylesheet' href='home.css'>";


echo '<div class="grid">';
    while($row = mysqli_fetch_array($res)) {
        echo '<div>';
        echo '<a href="" class="links">';
        echo '<img height="500" width="500" style="padding:5px" src="data:image;base64,'.$row[3].'">';
        echo '</a>';
        echo '<div>';
        echo "<h2 style='font-size: 16px; margin-left: 25px'><a style='text-decoration: none; color: #1DA1F2' href='http://localhost/Fotogram/includes/profile.php?uidUsers={$row[1]}'>$row[1]</a></h2>";
        echo '</div>';
        echo '</div>';
    }  
    echo '</div>';

    $sql1 = "SELECT * FROM images";
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

mysqli_close($conn);

?>