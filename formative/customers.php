<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$all_customers_query="SELECT customerid FROM customers ORDER BY customerid ASC";
$all_customers_result=mysqli_query($con, $all_customers_query);

if(isset($_GET['customer'])){
    $id=$_GET['customer'];
}else {
    $id = 1;
}
$this_customer_query="SELECT customers.customerid, customers.fname, customers.lname, customers.email
FROM customers
WHERE customers.customerid='".$id."'";
$this_customer_result=mysqli_query($con, $this_customer_query);
$this_customer_record=mysqli_fetch_assoc($this_customer_result);
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

    <h2 class="title"> Customers Information</h2>
    <?php
    echo "<p> Customer Number: ".$this_customer_record['customerid']. "<br>";
    echo "<p> Customer First Name: ".$this_customer_record['fname']. "<br>";
    echo "<p> Customer Last Name: ".$this_customer_record['lname']. "<br>";
    echo "<p> Email: ".$this_customer_record['email']. "<br>";
    ?>

    <h2 class="title"> Select Another Customer</h2>
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

    <h2 class="title"> Show Certain Customers</h2>
    <form action="customers.php" method="post">
        <input type='submit' name='testquery2' value="Customers">
    </form>

    <?php
    if(isset($_POST['testquery2']))
    {
        $result=mysqli_query($con, "SELECT * FROM customers");
        if(mysqli_num_rows($result)!=0)
        {
            while($test=mysqli_fetch_array($result))
            {
                $id = $test['customerid'];
                echo "<table>";
                echo "<tr>";
                echo "<tr>". $test['fname'] . "<tr>";
                echo "<tr>". $test['lname'] . "<tr>";
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
