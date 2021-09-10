<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$all_drinks_query="SELECT drinkid, item FROM drinks";
$all_drinks_result=mysqli_query($con, $all_drinks_query);

if(isset($_GET['drink'])){
    $id=$_GET['drink'];
    }else{
    $id=1;
}
$this_drink_query="SELECT item, cost FROM drinks WHERE drinkid='".$id."'";
$this_drink_result=mysqli_query($con, $this_drink_query);
$this_drink_record=mysqli_fetch_assoc($this_drink_result);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<header>
    <h1> Coffee Shop</h1>
    <nav>
        <a class='page' href='index.php'> Home</a>
        <a class='page' href='drinks.php'> Drinks</a>
        <a class='page' href='orders.php'> Orders</a>
        <a class='page' href='customers.php'> Customers</a>
    </nav>
</header>

<main>
    <div id="container">
    <link rel='stylesheet' type='text/css' href='style.css'>

    <h2 class="title"> Drinks Information</h2>
    <?php
    echo "<p> Drink Name: ".$this_drink_record['item']. "<br>";
    echo "<p> Cost: ". $this_drink_record['cost']. "<br>"
    ?>

    <h2 class="title"> Select Another Drink</h2>
    <form name='drinks_form' id='drink_form' method='get' action='drinks.php'>
        <select id='drink' name='drink' class='choice'>
            <!--options-->
            <?php
            while($all_drinks_record=mysqli_fetch_assoc($all_drinks_result)){
                echo"<option value='".$all_drinks_record['drinkid']."'>";
                echo $all_drinks_record['item'];
                echo"</option>";
            }
            ?>
        </select>
        <input type='submit' name='drinks_button' value='Show me the drink information'>
    </form>

        <h2 class="title"> Search a Drink</h2>
        <form action=""method="post">
            <input type="text" name='search' >
            <input type="submit" name="submit" value="Search">
        </form>

        <?php

        if(isset($_POST['search'])) {
            $search=$_POST['search'];

            $query1="SELECT * FROM drinks WHERE item LIKE '%$search%'";
            $query=mysqli_query($con, $query1);
            $count=mysqli_num_rows($query);

            if($count==0) {
                echo "There was no search results!";

            }else {

                while ($row = mysqli_fetch_array($query)) {

                    echo $row['item'];
                    echo "<br>";
                    }
            }
        }
        ?>
    <h2 class="title"> Show Certain Drinks</h2>
    <form action="drinks.php" method="post">
        <input type='submit' name='testquery1' value="Drinks">
    </form>

    <?php
    if(isset($_POST['testquery1']))
    {
        $result=mysqli_query($con, "SELECT * FROM drinks");
        if(mysqli_num_rows($result)!=0)
        {
            while($test=mysqli_fetch_array($result))
            {
                $id = $test['drinkid'];
                echo "<table>";
                echo "<tr>";
                echo "<tr>". $test['item'] . "<tr>";
                echo "<tr>". $test['cost'] . "<tr>";
                echo "</tr>";
                echo "</table>";
            }
        }
    }
    ?>
    </div>
</main>
</body>
</html>