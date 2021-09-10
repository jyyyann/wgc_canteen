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
FROM products, statuses, categories,popularities, vegans, gfs, nfs
WHERE products.product_id='".$id."'
AND products.status_id=statuses.status_id
AND products.category_id=categories.category_id
AND products.popularity_id=popularities.popularity_id
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
<header>
    <!--header element-->
    <!--logo of wgc-->
    <a href="https://ibb.co/MVcS3FP"><img src="https://i.ibb.co/MVcS3FP/wgclogo.png" width=150 height=150 alt="wgclogo" border="0"></a>
    <h1> WGC CANTEEN </h1>
    <nav>
        <!--navigation tabs-->
        <a class='page' href='home.php'> Home</a>
        <a class='page' href='specials.php'> Specials</a>
        <a class='page' href='browse.php'> Browse</a>
        <a class='page' href='information.php'> Information</a>
    </nav>
</header>

<main>
    <div class="container">
        <link rel='stylesheet' type='text/css' href='style.css'>
        <!--display of item's information-->
        <h2 class="title"> Item's Information</h2>
        <?php
        echo "<p class='product'> Product: ".$this_product_record['product']. "<br>";
        echo "<p> Description: ". $this_product_record['description']. "<br><br>";
        echo "<p> Category: ". $this_product_record['category']. "<br>";
        echo "<p> Cost: ". $this_product_record['cost']. "<br>";
        echo "<p> Popularity: ". $this_product_record['popularity']. "<br>";
        echo "<p> Status: ". $this_product_record['status']. "<br><br>";
        ?>

        <p> Dietary Information: </p>
        <table align=center class='content-table'>
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
        <input type="submit" name="back_to_menu" value="Search another item">
    </form>
</main>
</body>

<!--footer element-->
<footer>
    <p> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</html>