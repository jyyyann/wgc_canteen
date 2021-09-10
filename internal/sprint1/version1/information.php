<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv1");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$all_items_query="SELECT item_id, item FROM items";
$all_items_result=mysqli_query($con, $all_items_query);

if(isset($_GET['product'])){
    $id=$_GET['product'];
}else{
    $id=1;
}
$this_item_query="SELECT items.item, categories.category, items.cost, items.availability FROM items, categories WHERE items.item_id='".$id."' AND items.category_id=categories.category_id";
$this_item_result=mysqli_query($con, $this_item_query);
$this_item_record=mysqli_fetch_assoc($this_item_result);
?>

<!DOCTYPE html>
<html lang="en">
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
        <link rel='stylesheet' type='text/css' href='style.css'>

        <h2 class="title"> Item's Information</h2>
        <?php
        echo "<p> ".$this_item_record['item']. "<br>";
        echo "<p> Category: ". $this_item_record['category']. "<br>";
        echo "<p> Cost: ". $this_item_record['cost']. "<br>";
        echo "<p> Availability: ". $this_item_record['availability']. "<br>";
        ?>

        <h2 class="title"> Select Another Item</h2>
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
            <input type='submit' name='items_button' value='Show me the item information'>
        </form>
    </div>
</main>
</body>
</html>