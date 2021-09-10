<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
?>

<?php
    /*Drinks Query*/
    /*SELECT drinkid, item FROM drinks*/

    $all_drinks_query="SELECT drinkid, item FROM drinks";
    $all_drinks_result=mysqli_query($con, $all_drinks_query);

    /*Orders Query*/
    /*SELECT orderid FROM orders*/
    $all_orders_query="SELECT orderid FROM orders ORDER BY orderid ASC";
    $all_orders_result=mysqli_query($con, $all_orders_query);

    /*Customers Query*/
    /*SELECT customerid FROM orders*/
    $all_customers_query="SELECT customerid FROM customers ORDER BY customerid ASC";
    $all_customers_result=mysqli_query($con, $all_customers_query);
?>

<!DOCTYPE html>
<html lang=""en">

<head>
    <title> Coffee Shop </title>
    <meta charset=""utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>

</head>

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
    <!---Drinks form-->
        <br>
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

    <!---Orders form-->
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

    <!---Customers form-->
    <form name='customers_form' id='customer_form' method='get' action='customers.php'>
        <select id='customer' name='customer' class='choice'>
            <!--options-->

            <?php
            while($all_customers_record=mysqli_fetch_assoc($all_customers_result)){
                echo"<option value='".$all_customers_record['customerid']."'>";
                echo $all_customers_record['customerid'];
                echo"</option>";
            }
            ?>

        </select>

        <input type='submit' name='customers_button' value='Show me the customer information'>
    </form>
    </div>
</main>
</body>
