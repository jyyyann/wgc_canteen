<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
echo "connected to database";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--header element-->
    <title> WGC Canteen</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <h1> WGC Canteen</h1>
    <nav>
        <!--navigation tabs-->
        <a class='page' href='home.php'> Home</a>
        <a class='page' href='specials.php'> Specials</a>
        <a class='page' href='browse.php'> Browse</a>
        <a class='page' href='information.php'> Information</a>
    </nav>
</header>

<main>
    <div id="container">
        <!--information section-->
        <h2> About Us</h2>
        <div class="about"> Welcome to WGC Canteen! We opened since the beginning of the the century.
            We strive to deliver quality food with reasonable price to our students. Check out our menu to see all sorts of food and drinks available.</div><br>

        <h2> Opening Hours</h2>
        <p> Monday: 8:30a.m.-2:00p.m.</p>
        <p> Tuesday: 8:30a.m.-2:00p.m.</p>
        <p> Wednesday: 9:30a.m.-2:00p.m.</p>
        <p> Thursday: 8:30a.m.-2:00p.m.</p>
        <p> Friday: 8:30a.m.-2:00p.m.</p><br>

        <h2> Our Location</h2>
        <!--interactive google map-->
        <!--this is adapted from a tutorial blog on Google Developers-->
        <!--link here: https://developers.google.com/maps/documentation/javascript/adding-a-google-map-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d749.6327979505278!2d174.78052865631437!3d-41.27554235643219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d38ae2f27710d0d%3A0x2d0763d38f00974b!2sWellington%20Girls&#39;%20College!5e0!3m2!1sen!2snz!4v1597485828950!5m2!1sen!2snz"
                width="500" height="390" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

        <h2> Contact Us</h2>
        <p> Phone number: 021 0788 0831</p>
        <p> Email: canteen@wgc.school.nz</p>
        <p> Facebook: WGC Canteen</p>
        <p> Instagram: @wgccanteen</p><br>
    </div>
</main>
</body>

<!--footer element-->
<footer>
    <p> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>
