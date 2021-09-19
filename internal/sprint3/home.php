<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> WGC Canteen</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
    <div class="banner-area">
        <div class="content-area">
            <div class="contect">
                <h1> WGC CANTEEN</h1>
                <p> 8:30am - 2:00pm | MON - FRI</p>
                <button class="menu"> SEE THE MENU</button>
            </div>
        </div>
    </div>

    <!--main area-->
    <div class="container">
        <div class="box">
            <p>
                welcome.
            </p>
        </div>
    </div>
<header>
    <!--header element-->
    <!--this is adapted from a tutorial video on YouTube by Skillthrive-->
    <!--link here: https://www.youtube.com/watch?v=PwWHL3RyQgk-->
    <!--logo of wgc-->
    <a href="https://ibb.co/MVcS3FP">
        <img class="logo" src="https://i.ibb.co/MVcS3FP/wgclogo.png" width=100 height=100 alt="wgclogo">
    </a>

    <nav>
        <!--navigation tabs-->
        <ul class="nav_tag">
            <li><a class='page' href='home.php'> HOME</a></li>
            <li><a class='page' href='specials.php'> SPECIALS</a></li>
            <li><a class='page' href='menu.php'> MENU</a></li>
        </ul>
    </nav>
</header>

</body>
</html>

