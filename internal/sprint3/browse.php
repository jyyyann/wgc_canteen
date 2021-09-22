<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT *  
    FROM products, statuses, categories
    WHERE products.product LIKE '%$search%'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $search_query);
}
/*reprint the menu table*/
elseif(isset($_POST['all_items'])) {
    $all_query="SELECT * 
    FROM products, statuses, categories
    WHERE products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result=mysqli_query($con,$all_query);
}
/*all items are displayed by default*/
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
    <div class="browse-header">
        <header>
            <!--header element-->
            <!--this is adapted from a tutorial video on YouTube by Skillthrive-->
            <!--link here: https://www.youtube.com/watch?v=PwWHL3RyQgk-->
            <!--logo of wgc-->
                <img class="logo" src="img/wgclogo.png" width=100 height=100 alt="wgclogo">
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
    </div>

    <main>
        <h2> CATERGORIES</h2>
        <!--category tabs-->
        <form class="menu-fil" method='post' action='drinks.php'>
            <input class="button1" type="submit" name="drinks_only" value="Drinks">
        </form>

        <form class="menu-fil" method='post' action='sweets.php'>
            <input class="button1" type="submit" name="sweets_only" value="Sweets">
        </form>

        <form class="menu-fil" method='post' action='savoury.php'>
            <input class="button1" type="submit" name="savoury_only" value="Savoury">
        </form>

        <form class="menu-fil" method='post' action='snacks.php'>
            <input class="button1" type="submit" name="snacks_only" value="Snacks">
        </form>

        <!--shows all items-->
        <form class="menu-fil" method='post' action='browse.php'>
            <input class="button3" type="submit" name="all_items" value="All Items">
        </form>

        <!--search bar-->
        <h2 class="title"> SEARCH</h2>
        <form action="browse.php" method="post">
            <input class="searchbox" type="text" name='search'>
            <input class="searchlens" type="submit" name="submit">
        </form><br>

        <?php
        $count = mysqli_num_rows($result);
        if($count==0) {
            echo "There was no search results!";
        }
        else{
            echo"<!--menu table-->
                <p> Click on the item to see more details!</p><br>
                <table class='content-table'>
                    <tr>
                        <th> Product</th>
                        <th> Cost</th>
                        <th> Status</th>
                        <th> Rating</th>
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
                    <td>'.$row['popularities'].'</td>
                </tr>';
            }}
        ?>

        </table>
    </main>

    <!--footer element-->
    <footer>
        <p> © 2021 Jasmine Yip All Rights Reserved</p>
    </footer>

    </body>
</html>
