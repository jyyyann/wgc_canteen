<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
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
    <title> WGC Canteen</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<div class="header-elements">
    <header>
        <!--header element-->
        <!--this is adapted from a tutorial video on YouTube by Skillthrive-->
        <!--link here: https://www.youtube.com/watch?v=PwWHL3RyQgk-->
        <!--logo of wgc-->
        <a href="https://ibb.co/MVcS3FP">
            <img class="logo" src="https://i.ibb.co/MVcS3FP/wgclogo.png" width=100 height=100 alt="wgclogo">
        </a>
        <nav>
            <!--navigation tabs-->
            <ul class="nav_tag">
                <li><a class='page' href='home.php'> HOME</a></li>
                <li><a class='page' href='specials.php'> SPECIALS</a></li>
                <li><a class='page' href='browse.php'> MENU</a></li>
            </ul>
        </nav>
    </header>

    <h1> MENU</h1><br>
    <h2> HOURS / 8.30AM - 2PM MON - FRI</h2><br><br>
</div>

<main>
        <h2> Menu</h2>
        <!--category tabs-->
        <form class="filter-buttons" method='post' action='drinks.php'>
            <input type="submit" name="drinks_only" value="Drinks">
        </form>

        <form class="filter-buttons" method='post' action='sweets.php'>
            <input type="submit" name="sweets_only" value="Sweets">
        </form>

        <form class="filter-buttons" method='post' action='savoury.php'>
            <input type="submit" name="savoury_only" value="Savoury">
        </form>

        <form class="filter-buttons" method='post' action='snacks.php'>
            <input type="submit" name="snacks_only" value="Snacks">
        </form>

        <!--search bar-->
        <h2 class="title"> Search an item</h2>
        <form action="browse.php" method="post">
            <input type="text" name='search'>
            <input type="submit" name="submit" value="Search">
        </form><br>

            <?php
            $count = mysqli_num_rows($result);
            if($count==0) {
                echo "There was no search results!";
            }
            else{
                echo"<!--menu table-->
                <p> Click on the item to see more details!</p><br>
                <table align=center class='content-table'>
                    <tr>
                        <th> Product</th>
                        <th> Cost</th>
                        <th> Status</th>
                    </tr>";

                while ($row=mysqli_fetch_array($result))
                {
                    echo ' <tr> 
                    <!--clickable items that navigate to information page to display details of that chosen item-->
                    <!--this was adapted from am answer from Ali AlHajjow on stackoverflow-->
                    <!--link here: https://stackoverflow.com/questions/57936009/navigate-and-pass-values-to-another-page-in-php-html-->
                    <td><a class="menu-product" href=information.php?product_id='.$row['product_id'].'>'.$row['product'].'</a></td>
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
