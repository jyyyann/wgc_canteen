<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
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
    <!--header element-->
    <title> WGC Canteen</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='home.css'>
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
    <div class="container">
        <h2> Weekly Specials</h2>
        <p> All Specials are 50% off on their respected day! </p>
        <!--specials form-->
        <form name='specials_form' id='specials_form' method = 'get' action ='specials.php' class="center">
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
        echo "<p> Special: ".$this_specials_record['product']. "<br>";
        echo "<p> Category: ". $this_specials_record['category']. "<br>";
        echo "<p> Cost: <strike>". $this_specials_record['cost']. "</strike> 
             ". $this_specials_record['cost']*0.500."<br>";
        echo "<p> Status: ". $this_specials_record['status']. "<br>";
        ?>
    </div>
</main>
</body>

<!--footer element-->
<footer>
    <p> ?? 2021 Jasmine Yip All Rights Reserved</p>
</footer>