<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/*a sorter is selected*/
if (isset($_POST['sorting_button'])) {
    if (isset($_POST['sortby'])) {
        $sort = $_POST['sortby'];
    }
    if ($sort == 'all_drinks') {
        $all_drinks_query = "SELECT * 
            FROM products, statuses, categories
            WHERE products.category_id=categories.category_id
            AND products.category_id='DR'
            AND products.status_id=statuses.status_id";
        $result = mysqli_query($con, $all_drinks_query);

    } elseif ($sort == 'pop_desc') {
        $pop_asc_query = "SELECT * 
            FROM products, statuses, categories 
            WHERE products.category_id='DR'
            AND products.category_id=categories.category_id
            AND products.status_id=statuses.status_id
            ORDER BY products.popularities DESC";
        $result = mysqli_query($con, $pop_asc_query);

    } elseif ($sort == 'cost_asc') {
        $cost_asc_query = "SELECT * 
            FROM products, statuses, categories
            WHERE products.category_id=categories.category_id
            AND products.category_id='DR'
            AND products.status_id=statuses.status_id
            ORDER BY products.cost ASC";
        $result = mysqli_query($con, $cost_asc_query);

    } elseif ($sort == 'available_only') {
        $available_only_query = "SELECT * 
            FROM products, statuses, categories 
            WHERE products.status_id='A'
            AND products.category_id='DR'
            AND products.category_id=categories.category_id
            AND products.status_id=statuses.status_id";
        $result = mysqli_query($con, $available_only_query);}

} /*print whole menu by default*/
else {
    $drinks_only_query = "SELECT *
    FROM products, statuses, categories
    WHERE products.category_id='DR'
    AND products.category_id=categories.category_id
    AND products.status_id=statuses.status_id";
    $result = mysqli_query($con, $drinks_only_query);
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
<div class="drinks-header">
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

    <h1> DRINKS</h1><br>
    <p class="attribute">Photo by <a href="https://www.pexels.com/@viktoria-alipatova-1083711?utm_content=attributionCopyText&utm_medium=referral&utm_source=pexels">Viktoria Alipatova</a>
        from <a href="https://www.pexels.com/photo/top-view-photo-of-coffee-near-cookies-2074122/?utm_content=attributionCopyText&utm_medium=referral&utm_source=pexels">Pexels</a></p>
</div>

<main>
    <h2> CATEGORIES</h2>
    <!--shows all items-->
    <form class="menu-fil" method='post' action='browse.php'>
        <input class="button1" type="submit" name="all_items" value="All Items">
    </form>
    
    <!--category tabs-->
    <form class="menu-fil" method='post' action='drinks.php'>
        <input class="button3" type="submit" name="drinks_only" value="Drinks">
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

    <h2> DRINKS</h2>

<!--sorting form-->
<!--drop-down list that provides options of sorting method, which then apply on the menu and refresh.-->
<!--this was adapted from an article written by @Kamal Argarwal11 on geeksforgeeks-->
<!--link here: https://www.geeksforgeeks.org/how-to-get-multiple-selected-values-of-select-box-in-php/-->
    <form name='sorting_form' id='sorting_form' method='post' action='drinks.php' class="center">
    <select id='sorter' name ='sortby' class='choice'>
        <!--options-->
        <option value = 'all_drinks'> All Drinks</option>
        <option value = 'pop_desc'> Most Popular</option>
        <option value = 'cost_asc'> Cost Ascending</option>
        <option value = 'available_only'> Available Only</option>
    </select>
    <input class="button1" type='submit' name='sorting_button' value='Sort'>
</form><br>

<!--menu table-->
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
                    <td id="starnum">' .$fullstar = $row['popularities'];
        $blankstar = 5 - $row['popularities'];
        $x = 1;
        while($x <= $fullstar and $x > 0) {
            echo  '<img id="star" src="img/fullstar.png" />';
            $x++; }

        $x = 1;
        while ($x <= $blankstar and $x > 0) {
            echo  '<img id="star" src="img/blankstar.png" />';
            $x++; }
        '</td></tr>';
    }}
?>
?>
</table>
</main>

<!--footer element-->
<footer>
    <p class="footer-content"> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</body>
</html>
