<?php 
    include("include/header.php"); 
    if( isset($_GET["id"]) ){
    try {
        $dbc2 = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
        if( $dbc2 == null ) {
            throw new Exception("Hmmm, something went wrong.... :(<br />Try reloading your page, or try again later! </br /><br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
        }  
    }
    catch(Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    $value =  $_GET["id"]; 
    $query2 = "SELECT title, description, price, product_img FROM k16768_the_max.products WHERE product_id = '" . $value . "'";
    $result2 = mysql_query($query2);
    $row = mysql_fetch_array($result2, MYSQL_ASSOC);
    mysql_close($dbc2);
?>
    <div id="main_text">
        <div id="product_info_img">
                <img id="product_img" src="<?php echo $row['product_img'];?>" />
        </div>
        <div class="product_top">
            <div>
                <div class="title">
                    <?php echo $row['title']; ?>
                </div>
                <div class="cost">
                    <?php echo $row['price']; ?>
                </div>
            </div>
            <div id="product_info_page">
                <!--<p id="buy_now">
                    <a href="cart.php?id=<?php //echo $_GET['id']; ?>">add to cart</a>
                </p>-->
            </div>
            <div class="decription"'>
                <?php echo $row['description'];?>
            </div>
        </div>
    </div>
</div>
<?php 
        }
    else echo "Oops, no product set!";

?>


<?php include("include/footer.php") ?>


