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

$img_query="SELECT * FROM products WHERE products.product_id= '".$id."'";
$img_result=mysqli_query($con, $img_query);
$img_record=mysqli_fetch_assoc($img_result);

$image = $img_record['img_dir'];
$owner = $img_record['owner'];
$link = $img_record['link'];
$plink = $img_record['plink'];
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
    <p class="attribute"> Photo by Ella Olsson from Pexels</p>
</div>

<main>
        <link rel='stylesheet' type='text/css' href='style.css'>
    <h2> ITEM'S INFORMATION</h2>

    <div class="container">
        <div class="row">

        <div class="product-image">
            <img id="productimage" src="pimg/canteen-internal/<?php echo $image?>.jpg">
            <p class="attribute2">Photo by <a href="<?php echo $link?>"><?php echo $owner?></a> from <a href="<?php echo $plink?>">Pexels</a></p>
        </div>

        <div class="product-info">
        <!--display of item's information-->
        <?php
        echo "<p class='pi'> Product: ".$this_product_record['product']. "<br>";
        echo "<p class='pi'> Description: ". $this_product_record['description']. "<br>";
        echo "<p class='pi'> Category: ". $this_product_record['category']. "<br>";
        echo "<p class='pi'> Cost: ". $this_product_record['cost']. "<br>";
        echo "<p class='pi'> Popularity: ". $this_product_record['popularities']. "<br>";
        echo "<p class='pi'> Status: ". $this_product_record['status']. "<br>";
        echo "<p class='pi'> Calories: ". $this_product_record['calories']. " kcal<br>";
        echo "<p class='pi'> Vegan: ". $this_product_record['vegan']. "<br>";
        echo "<p class='pi'> Gluten Free: ". $this_product_record['gf']. "<br>";
        echo "<p class='pi'> Nut Free: ". $this_product_record['nf']. "<br><br>";
        ?>
        </div>
        </div>
    <form method='post' action='browse.php'>
        <!--category filters-->
        <input class="button1" type="submit" name="back_to_menu" value="Back to menu">
    </form>
    </div>
</main>

<!--footer element-->
<footer>
    <p class="footer-content"> © 2021 Jasmine Yip All Rights Reserved</p>
</footer>

</body>
</html>
