<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv1");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
?>

<?php
/*items query*/
/*SELECT item_id FROM items*/
$all_items_query="SELECT item_id, item FROM items";
$all_items_result=mysqli_query($con, $all_items_query);

if(isset($_GET['product'])){
    $id=$_GET['product'];
}else{
    $id=1;
}
$this_item_query="SELECT * FROM items, categories WHERE items.item_id='".$id."' AND items.category_id=categories.category_id";
$this_item_result=mysqli_query($con, $this_item_query);
$this_item_record=mysqli_fetch_assoc($this_item_result);
?>

<!DOCTYPE html>
<html lang=""en">

<head>
    <!--header element-->
    <title> WGC Canteen</title>
    <meta charset=""utf-8">
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
        <!---items form-->
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

            <!--display of item's information-->
            <h2 class="title"> Item's Information</h2>
            <?php
            echo "<p> ".$this_item_record['item']. "<br>";
            echo "<p> Category: ". $this_item_record['category']. "<br>";
            echo "<p> Cost: ". $this_item_record['cost']. "<br>";
            echo "<p> Availability: ". $this_item_record['availability']. "<br><br>";
            echo "<p> Vegan: ". $this_item_record['vegan']. "<br>";
            echo "<p> Gluten Free: ". $this_item_record['gf']. "<br><br>";
            ?>

        <p> Nutrition Information (per 100 g): </p>
        <table align=center class='content-table'>
            <tr>
                <th> Calories</th>
                <th> Carbohydrates</th>
                <th> Protein</th>
                <th> Fat</th>
            </tr>

            <?php
            echo ' <tr> 
                   <td>'.$this_item_record['calories'].' kcal</td>
                   <td>'.$this_item_record['carbohydrates'].' g</td>
                   <td>'.$this_item_record['protein'].' g</td>
                   <td>'.$this_item_record['fat'].' g</td>
                   </tr>';
            ?>
        </table>

        <!--footer element-->
        <footer>
            <p> © 2021 Jasmine Yip All Rights Reserved</p>
        </footer>

    </div>
</main>
</body>
