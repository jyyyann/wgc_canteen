<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
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
if(isset($_POST['drinks_only'])) {
    $drinks_only_query = "SELECT * 
    FROM products, statuses, categories 
    WHERE products.category_id='DR'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $drinks_only_query);
}

elseif(isset($_POST['sweets_only'])) {
    $sweets_only_query = "SELECT * 
    FROM products, statuses, categories 
    WHERE products.category_id='SW'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $sweets_only_query);
}

elseif(isset($_POST['savoury_only'])) {
    $savoury_only_query = "SELECT * 
    FROM products, statuses, categories 
    WHERE products.category_id='SV'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $savoury_only_query);
}

elseif(isset($_POST['snacks_only'])) {
    $snacks_only_query = "SELECT * 
    FROM products, statuses, categories 
    WHERE products.category_id='SN'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $snacks_only_query);
}

elseif(isset($_POST['all_items'])) {
    $all_items_query = "SELECT * 
    FROM products, statuses, categories
    WHERE products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $all_items_query);
}

elseif(isset($_POST['cost_asc'])){
    $cost_asc_query="SELECT * 
    FROM products, statuses, categories
    WHERE products.category_id=categories.category_id
    AND products.status_id=statuses.status_id
    ORDER BY products.cost ASC";
    $result=mysqli_query($con, $cost_asc_query);
}

elseif(isset($_POST['cost_desc'])){
    $cost_desc_query="SELECT * 
    FROM products, statuses, categories
    WHERE products.category_id=categories.category_id
    AND products.status_id=statuses.status_id
    ORDER BY products.cost DESC";
    $result=mysqli_query($con, $cost_desc_query);
}

elseif(isset($_POST['available_only'])) {
    $available_only_query = "SELECT * 
    FROM products, statuses, categories 
    WHERE products.status_id='A'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $available_only_query);
}

elseif(isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT *  
    FROM products, statuses, categories
    WHERE products.product LIKE '%$search%'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $search_query);
}

else{
    $all_query="SELECT * 
    FROM products, statuses, categories
    WHERE products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
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
        <a class='page' href='specials.php'> Specials</a>
        <a class='page' href='browse.php'> Browse</a>
        <a class='page' href='information.php'> Information</a>
    </nav>
</header>

<main>
    <div id="container">
        <h2> Menu</h2>
        <form method='post' action='browse.php'>
            <!--category filters-->
            <input type="submit" name="drinks_only" value="Drinks">
            <input type="submit" name="sweets_only" value="Sweets">
            <input type="submit" name="savoury_only" value="Savoury">
            <input type="submit" name="snacks_only" value="Snacks"><br>
            <!--sorting filters-->
            <input type="submit" name="all_items" value="All Items">
            <input type="submit" name="cost_asc" value="Cost Ascending">
            <input type="submit" name="cost_desc" value="Cost Descending">
            <input type="submit" name="available_only" value="Available Only">
        </form>

            <!--search bar-->
            <h2 class="title"> Search an item</h2>
            <form action="browse.php" method="post">
                <input type="text" name='search'>
                <input type="submit" name="submit" value="Search">
            </form>

            <!--menu table-->
            <table align=center class='content-table'>
                <tr>
                    <th> Product</th>
                    <th> Cost</th>
                    <th> Status</th>
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
                   <td>'.$row['product'].'</td>
                   <td>'.$row['cost'].'</td>
                   <td>'.$row['status'].'</td>
                   </tr>';
                    }}
                ?>
            </table>
    </div>
</main>
</body>

<!--footer element-->
<footer>
    <p> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>
