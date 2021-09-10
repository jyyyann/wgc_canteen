<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv1");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
?>

<?php
/*
 * filters and search bar
 * custom query to sort items
 * this was adapted from a tutorial video from 1BestCsharp blog on Youtube
 * link here:
 * https://youtu.be/2XuxFi85GTw
 */
if(isset($_POST['cost_asc'])){
    $cost_asc_query="SELECT * FROM items ORDER BY items.cost ASC";
    $result=mysqli_query($con, $cost_asc_query);
}

elseif(isset($_POST['cost_desc'])){
    $cost_desc_query="SELECT * FROM items ORDER BY items.cost DESC";
    $result=mysqli_query($con, $cost_desc_query);
}

elseif(isset($_POST['available_only'])) {
    $available_only_query = "SELECT * FROM items WHERE items.availability='Yes'";
    $result = mysqli_query($con, $available_only_query);
}

elseif(isset($_POST['all_items'])) {
    $all_items_query = "SELECT * FROM items";
    $result = mysqli_query($con, $all_items_query);
}

elseif(isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT * FROM items WHERE item LIKE '%$search%'";
    $result = mysqli_query($con, $search_query);
}

else{
    $all_query="SELECT * FROM items";
    $result=mysqli_query($con,$all_query);
}
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
        <h2> Menu</h2>
        <form method='post' action='browse.php'>
            <!--filters-->
            <input type="submit" name="all_items" value="All Items">
            <input type="submit" name="cost_asc" value="Cost Ascending">
            <input type="submit" name="cost_desc" value="Cost Descending">
            <input type="submit" name="available_only" value="Available Only">

            <!--search bar-->
            <h2 class="title"> Search an item</h2>
            <form action="browse.php" method="post">
                <input type="text" name='search'>
                <input type="submit" name="submit" value="Search">
            </form>

            <!--menu table-->
            <table align=center class='content-table'>
                <tr>
                    <th> Item</th>
                    <th> Cost</th>
                    <th> Availability</th>
                </tr>

                <?php
                $count = mysqli_num_rows($result);
                if($count==0) {
                    echo "There was no search results!";
                }
                else{
                    while ($row=mysqli_fetch_array($result))
                    {
                        echo ' <tr> 
                   <td>'.$row['item'].'</td>
                   <td>'.$row['cost'].'</td>
                   <td>'.$row['availability'].'</td>
                   </tr>';
                    }}
                ?>
            </table>
        </form>

        <!--footer element-->
        <footer>
            <p> © 2021 Jasmine Yip All Rights Reserved</p>
        </footer>

    </div>
</main>
</body>
