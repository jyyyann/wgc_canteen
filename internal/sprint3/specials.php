<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/*specials query*/
/*broken fix it*/
$day = strftime("%a");
$daycap = strtoupper($day);

if(isset($_GET['specials'])){
    $id=$_GET['specials'];
}
elseif ($daycap!='SAT' or 'SUN'){
    $id=$daycap;
}
elseif ($daycap='SAT' or 'SUN'){
        $id='MON';
}

$this_specials_query="SELECT specials.day, products.product, products.cost, categories.category, statuses.status, products.description
FROM products, statuses, specials, categories
WHERE specials.day_id='".$id."'
AND specials.product_id=products.product_id
AND products.status_id=statuses.status_id
AND products.category_id=categories.category_id";
$this_specials_result=mysqli_query($con, $this_specials_query);
$this_specials_record=mysqli_fetch_assoc($this_specials_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> WGC Canteen</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<div class="specials-header">
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
    
    <h1> SPECIALS</h1><br>
    <p class="attribute"> Photo by Daniel Reche from Pexels</p>
    </div>

<main>
    <h2> WEEKLY SPECIALS </h2>
    <div class="specials">
        <p> All Specials are 50% off on their respected day!</p>
        <!--specials form-->
        <form name='specials_form' id='specials_form' method = 'get' action ='specials.php' class="center">
            <label for='specials'></label>
            <select id='specials' name='specials' class='choice'>
                <!--options-->
                <option value = 'MON'> Monday</option>
                <option value = 'TUE'> Tuesday</option>
                <option value = 'WED'> Wednesday</option>
                <option value = 'THU'> Thursday</option>
                <option value = 'FRI'> Friday</option>
            </select>
            <input class="button1" type='submit' name='specials_button' value='Show me the specials information'>
        </form>

        <?php
        /*show the new cost with 50% off next to the original cost*/
        /*this was adapted from a post on stackoverflow by Grant*/
        /*link here: https://stackoverflow.com/questions/25744355/make-calculation-php-echo-total*/
        $new_cost = $this_specials_record['cost']*0.5;

        echo "<p> Day: ".$this_specials_record['day']. "<br>";
        echo "<p> Special: ".$this_specials_record['product']. "<br>";
        echo "<p> Category: ". $this_specials_record['category']. "<br>";
        echo "<p> Cost: <strike>". $this_specials_record['cost']. "</strike> ";
        echo number_format($new_cost,2);
        echo "<p> Status: ". $this_specials_record['status']. "<br>";
        ?>
    </div>
</main>

<!--footer element-->
<footer>
    <p class="footer-content"> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</body>
</html>