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
<header>
    <!--header element-->
    <!--logo of wgc-->
    <a href="https://ibb.co/MVcS3FP"><img src="https://i.ibb.co/MVcS3FP/wgclogo.png" width=150 height=150 alt="wgclogo" border="0"></a>
    <h1> WGC CANTEEN </h1>
    <nav>
        <!--navigation tabs-->
        <a class='page' href='home.php'> Home</a>
        <a class='page' href='specials.php'> Specials</a>
        <a class='page' href='browse.php'> Browse</a>
        <a class='page' href='information.php'> Information</a>
    </nav>
</header>

<main>
    <div class="container">
        <!--information section-->
        <div class="row">
            <div class="box">
                <h2> About Us</h2>
                <div class="about-us"> Welcome to Wellington Girls' College Canteen! We opened since the beginning of the century.
                    We strive to deliver quality food with reasonable price to our students. We update our menu frequently
                    to make sure we have got the most well-liked items for you all.
                    Check out our menu to see a wide range of food and drinks available. There has got to be something for you!</div><br>
            </div>

            <div class="box">
                <h2> Our Location</h2>
                <!--interactive google map-->
                <!--this is adapted from a tutorial blog on Google Developers-->
                <!--link here: https://developers.google.com/maps/documentation/javascript/adding-a-google-map-->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d749.6327979505278!2d174.78052865631437!3d-41.27554235643219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d38ae2f27710d0d%3A0x2d0763d38f00974b!2sWellington%20Girls&#39;%20College!5e0!3m2!1sen!2snz!4v1597485828950!5m2!1sen!2snz"
                        width="380" height="330" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <h2> Opening Hours</h2>
                <p> Monday: 8:30a.m.-2:00p.m.</p>
                <p> Tuesday: 8:30a.m.-2:00p.m.</p>
                <p> Wednesday: 9:30a.m.-2:00p.m.</p>
                <p> Thursday: 8:30a.m.-2:00p.m.</p>
                <p> Friday: 8:30a.m.-2:00p.m.</p><br>
            </div>

            <div class="box">
                <h2> Contact Us</h2>
                <p> Phone number: 021 0788 0831</p>
                <p> Email: canteen@wgc.school.nz</p>
                <p> Facebook: WGC Canteen</p>
                <p> Instagram: @wgccanteen</p><br>
            </div>
        </div>
    </div>
</main>

<!--footer element-->
<footer>
    <p> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</body>
</html>