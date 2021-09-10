<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv1");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
?>

<?php
/*specials query*/
if(isset($_GET['specials'])){
    $id=$_GET['specials'];
}else{
    $id=1;
}
$this_specials_query="SELECT specials.day, items.item, categories.category, items.cost, items.availability FROM items, categories, specials
                      WHERE specials.day_id='".$id."' AND specials.item_id=items.item_id AND items.category_id=categories.category_id";
$this_specials_result=mysqli_query($con, $this_specials_query);
$this_specials_record=mysqli_fetch_assoc($this_specials_result);
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
        <a class='page' href='browse.php'> Browse</a>
        <a class='page' href='information.php'> Information</a>
    </nav>
</header>

<main>
    <div id="container">
        <!--information section-->
        <h2> About Us</h2>
        <p> WGC Canteen strives to deliver quality food with reasonable price to our students.</p>

        <h2> Opening Hours</h2>
        <p> Monday: 8:30a.m.-2:00p.m.</p>
        <p> Tuesday: 8:30a.m.-2:00p.m.</p>
        <p> Wednesday: 9:30a.m.-2:00p.m.</p>
        <p> Thursday: 8:30a.m.-2:00p.m.</p>
        <p> Friday: 8:30a.m.-2:00p.m.</p>


        <h2> Weekly Specials</h2>
        <p> All Specials are 50% off on their respected day! </p>
        <!--specials form-->
        <form name='specials_form' id='specials_form' method = 'get' action ='home.php' class="center">
            <select id='specials' name='specials' class='choice'>
                <!--options-->
                <option value = 'MON'> Monday</option>
                <option value = 'TUE'> Tuesday</option>
                <option value = 'WED'> Wednesday</option>
                <option value = 'THU'> Thursday</option>
                <option value = 'FRI'> Friday</option>
            </select>
            <input type='submit' name='specials_button' value='Show me the specials information'>
        </form>

        <?php
        echo "<p> Day: ".$this_specials_record['day']. "<br>";
        echo "<p> Special: ".$this_specials_record['item']. "<br>";
        echo "<p> Category: ". $this_specials_record['category']. "<br>";
        echo "<p> Cost: ". $this_specials_record['cost']. "<br>";
        echo "<p> Availability: ". $this_specials_record['availability']. "<br>";
        ?>

        <!--footer element-->
        <footer>
            <p> © 2021 Jasmine Yip All Rights Reserved</p>
        </footer>

    </div>
</main>
</body>
