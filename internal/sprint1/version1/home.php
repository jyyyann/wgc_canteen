<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv1");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
?>

<?php
/*Items Query*/
/*SELECT item_id FROM items*/
$all_items_query="SELECT item_id, item FROM items ORDER BY item_id ASC";
$all_items_result=mysqli_query($con, $all_items_query);
?>

<?php
/*Specials Query*/
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
<html lang=""en">

<head>
    <title> WGC Canteen</title>
    <meta charset=""utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <h1> WGC Canteen</h1>
    <nav>
        <a class='page' href='home.php'> Home</a>
        <a class='page' href='browse.php'> Browse</a>
        <a class='page' href='information.php'> Information</a>
    </nav>
</header>

<main>
    <div id="container">
        <!---Items form-->
        <br>
        <form name='items_form' id='item_form' method='get' action='information.php'>
            <select id='product' name='product' class='choice'>
                <!--options-->
                <?php
                while($all_items_record=mysqli_fetch_assoc($all_items_result)){
                    echo"<option value='".$all_items_record['item_id']."'>";
                    echo $all_items_record['item'];
                    echo"</option>";
                }
                ?>
            </select>

            <input type='submit' name='drinks_button' value='Show me the item information'>
        </form>
        <h2> Weekly Specials:</h2>
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

    </div>
</main>
</body>
