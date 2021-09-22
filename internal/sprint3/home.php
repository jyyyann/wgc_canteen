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
<div class="home-header">
<header>
    <!--header element-->
    <!--this is adapted from a tutorial video on YouTube by Skillthrive-->
    <!--link here: https://www.youtube.com/watch?v=PwWHL3RyQgk-->
    <!--logo of wgc-->
        <img class="logo" src="img/wgclogo.png" width=100 height=100 alt="wgclogo">
    <nav>
        <!--navigation tabs-->
        <ul class="nav_tag">
            <li><a class='page' href='home.php'> HOME</a></li>
            <li><a class='page' href='specials.php'> SPECIALS</a></li>
            <li><a class='page' href='browse.php'> MENU</a></li>
        </ul>
    </nav>
</header>

    <h1> WGC CANTEEN</h1><br>
</div>

<main>
    <div class="about-us">
        <h2> ABOUT US</h2>
        <p class="about-us"> Welcome to Wellington Girls' College Canteen! We opened since the beginning of the century.
            We strive to deliver quality food with reasonable price to our students. We update our menu frequently
            to make sure we have got the most well-liked items for you all.
            Check out our menu to see a wide range of food and drinks available. There has got to be something for you!</p>
    </div>

    <div class="menu">
        <h1> MENU</h1>
        <p class="p2"> Our menu fills with healthy and delicious food options,
                perfect for breakfast, morning tea, lunch or even just a quick snack.</p><br>

        <form method='post' action='browse.php'>
            <!--category filters-->
            <input class="button2" type="submit" value="SEE OUR MENU">
        </form>
    </div>

    <div class="info">
        <h2> LOCATION</h2>
        <!--interactive google map-->
        <!--this is adapted from a tutorial blog on Google Developers-->
        <!--link here: https://developers.google.com/maps/documentation/javascript/adding-a-google-map-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d749.6327979505278!2d174.78052865631437!3d-41.27554235643219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d38ae2f27710d0d%3A0x2d0763d38f00974b!2sWellington%20Girls&#39;%20College!5e0!3m2!1sen!2snz!4v1597485828950!5m2!1sen!2snz"
                width="600" height="400" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe><br><br>

        <h2> HOURS</h2>
        <p> 8.30AM-2PM Mon-Fri<br>
            Closed Sat & Sun
        </p>

        <h2> CONTACT</h2>
        <p class="info-content"> Phone number: +64 021 0268 2889<br>
        Email: canteen@wgc.school.nz<br>
        Facebook: WGC Canteen<br>
        Instagram: @wgccanteen<br>
        </p>
    </div>
</main>
<!--footer element-->
<footer>
    <p> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</body>
</html>

