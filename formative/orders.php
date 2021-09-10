<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$all_orders_query="SELECT orderid FROM orders ORDER BY orderid ASC";
$all_orders_result=mysqli_query($con, $all_orders_query);

if(isset($_GET['order'])){
    $id=$_GET['order'];
}else {
    $id = 1;
}
$this_order_query="SELECT orders.orderid, customers.fname, customers.lname, drinks.item
FROM customers, orders, drinks
WHERE customers.customerid=orders.customerid
AND orders.drinkid=drinks.drinkid and orders.orderid='".$id."'";
$this_order_result=mysqli_query($con, $this_order_query);
$this_order_record=mysqli_fetch_assoc($this_order_result);
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

    <h2 class='title'> Orders Information</h2>
    <?php
    echo "<p> Order Number: ".$this_order_record['orderid']. "<br>";
    echo "<p> Customer First Name: ".$this_order_record['fname']. "<br>";
    echo "<p> Customer Last Name: ".$this_order_record['lname']. "<br>";
    echo "<p> Drink: ".$this_order_record['item']. "<br>";
    ?>

    <h2 class="title"> Select Another Order</h2>
    <form name='orders_form' id='order_form' method='get' action='orders.php'>
        <select id='order' name='order' class='choice'>
            <!--options-->

            <?php
            while($all_orders_record=mysqli_fetch_assoc($all_orders_result)){
                echo"<option value='".$all_orders_record['orderid']."'>";
                echo $all_orders_record['orderid'];
                echo"</option>";
            }
            ?>

        </select>

        <input type='submit' name='orders_button' value='Show me the order information'>
    </form>
    </div>
</main>
</body>
</html>