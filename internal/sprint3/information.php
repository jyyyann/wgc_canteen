<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_internalv2");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
/*product query*/
/*SELECT product_id FROM products*/
$all_products_query="SELECT product_id, product FROM products";
$all_products_result=mysqli_query($con, $all_products_query);

if(isset($_GET['product_id'])){
    $id=$_GET['product_id'];
}else{
    $id='AFG';
}

$this_product_query="SELECT *
FROM products, statuses, categories,vegans, gfs, nfs
WHERE products.product_id='".$id."'
AND products.status_id=statuses.status_id
AND products.category_id=categories.category_id
AND products.vegan_id=vegans.vegan_id
AND products.gf_id=gfs.gf_id
AND products.nf_id=nfs.nf_id";
$this_product_result=mysqli_query($con, $this_product_query);
$this_product_record=mysqli_fetch_assoc($this_product_result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> WGC Canteen</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<div class="info-header">
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

    <h1>INFO</h1><br>
</div>

<main>
    <div class="container">
        <link rel='stylesheet' type='text/css' href='style.css'>
        <!--display of item's information-->
        <h2> ITEM'S INFO</h2>
        <?php
        echo "<p> Product: ".$this_product_record['product']. "<br>";
        echo "<p> Description: ". $this_product_record['description']. "<br><br>";
        echo "<p> Category: ". $this_product_record['category']. "<br>";
        echo "<p> Cost: ". $this_product_record['cost']. "<br>";
        echo "<p> Popularity: ". $this_product_record['popularities']. "<br>";
        echo "<p> Status: ". $this_product_record['status']. "<br><br>";
        ?>

        <p> Dietary Information: </p>
        <table class='content-table'>
            <tr>
                <th> Calories</th>
                <th> Vegan</th>
                <th> Gluten Free</th>
                <th> Nut Free</th>
            </tr>

            <?php
            echo ' <tr> 
                   <td>'.$this_product_record['calories'].'</td>
                   <td>'.$this_product_record['vegan'].'</td>
                   <td>'.$this_product_record['gf'].'</td>
                   <td>'.$this_product_record['nf'].'</td>
                   </tr>';
            ?>
        </table>
    </div>
    <br>
    <form method='post' action='browse.php'>
        <!--category filters-->
        <input class="button1" type="submit" name="back_to_menu" value="Back to menu">
    </form>
</main>

<!--footer element-->
<footer>
    <p> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</body>
</html>
