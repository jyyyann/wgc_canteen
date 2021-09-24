<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/*get the searched item*/
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
                <img class="logo" src="img/wgclogo.png" width=100 height=100 alt="the logo of wellington girls college">
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
        <p class="attribute">Photo by <a href="https://www.pexels.com/@tomateoignons?utm_content=attributionCopyText&utm_medium=referral&utm_source=pexels">tomateoignons</a>
            from <a href="https://www.pexels.com/photo/brown-muffins-with-chocolate-chips-3776529/?utm_content=attributionCopyText&utm_medium=referral&utm_source=pexels">Pexels</a></p>
    </div>

    <main>
        <h2> CATEGORIES</h2>
        <!--shows all items-->
        <form class="menu-fil" method='post' action='browse.php'>
            <input class="button3" type="submit" name="all_items" value="All Items">
        </form>

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

        <!--search bar-->
        <h2 class="title"> SEARCH</h2>
        <form action="browse.php" method="post">
            <label for="search">
            <input class="searchbox" type="text" name='search'>
            </label>
            <input class="searchlens" type="submit" name="submit">
        </form><br>

        <!--refresh button-->
        <button class="button4" onClick="window.location.reload();">Refresh Page</button>

        <?php
        $count = mysqli_num_rows($result);
        if($count==0) {
            echo "<p>There was no search results!</p>";
        }
        else{
            echo"<!--menu table-->
                <p class='clickit'> Click on the item to see more details!</p><br>
                <table class='content-table'>
                    <tr>
                        <th> Product</th>
                        <th> Cost</th>
                        <th> Status</th>
                        <th> Popularity</th>
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
                    <!--printing star rating-->
                    <td id="starnum">' .$fullstar = $row['popularities'];
                    $blankstar = 5 - $row['popularities'];
                    $x = 1;
                    while($x <= $fullstar and $x > 0) {
                        echo  '<img id="star" src="img/fullstar.png" alt="filled star icon"/>';
                        $x++; }

                    $x = 1;
                    while ($x <= $blankstar and $x > 0) {
                        echo  '<img id="star" src="img/blankstar.png" alt="blank star icon"/>';
                        $x++; }'</td>
                </tr>';
            }}
        ?>
        </table><br>

        <!--star images attribution-->
        <p class="star_atr"><i><a href="https://icons8.com/icon/60003/star">full star icon by Icons8</a>
        <a target="_blank" href="https://icons8.com/icon/16101/star">  /  blank star</a> icon by
        <a target="_blank" href="https://icons8.com">Icons8</a>
            </i></p><br>

    </main>

    <!--footer element-->
    <footer>
        <p class="footer-content"> © 2021 Jasmine Yip All Rights Reserved</p>
    </footer>

    </body>
</html>
