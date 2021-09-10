<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv1");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
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
    <!---Search an item--->
    <h2 class="title"> Search an item</h2>
    <form action=""method="post">
        <input type="text" name='search'>
        <input type="submit" name="submit" value="Search">
    </form>

    <?php

    if(isset($_POST['search'])) {
        $search=$_POST['search'];

        $query1="SELECT * FROM items WHERE item LIKE '%$search%'";
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

    <!--Showing all items-->
    <?php
        $all_query="SELECT * FROM items";
        $all_result=mysqli_query($con,$all_query);

        if (!$all_result)
        {
            die('error found'.mysqli_error($con));
        }
        echo "
           <table align=center class='content-table'>
           <tr>
           <th> Item</th>
           <th> Cost</th>
           <th> Availability</th>
           </tr>";

        while($row=mysqli_fetch_array($all_result))
        {
            echo ' <tr> 
                   <td>'.$row['item'].'</td>
                   <td>'.$row['cost'].'</td>
                   <td>'.$row['availability'].'</td>
                   </tr>';
        }
        ?>
        </table>
</div>
</main>
</body>

