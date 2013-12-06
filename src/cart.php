<?php 
    include("include/header.php"); 
    if( !isset($_GET["id"]) || !isset($_SESSION['cart_id']) || !isset($_SESSION['user_id'])){
        try {
            $dbc2 = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
            if( $dbc2 == null ) {
                throw new Exception("Hmmm, something went wrong.... :(<br />Try reloading your page, or try again later! </br /><br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
            }  
        }
        catch(Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        if( isset($_SESSION["user_id"]) && isset($_SESSION["cart_id"]) && isset($_GET['id']) ) {
            $query2 = "SELECT cart_items.* FROM cart_items OUTER JOIN cart ON cart_items.user_id = cart.user_id WHERE cart.user_id = '" . $_SESSION['user_id'] . "'";
            $result2 = mysql_query($query2);
            $query_items = mysql_fetch_array($result2, MYSQL_ASSOC);
            $query_products = "SELECT product_id, title, description, price, product_img_s FROM k16768_the_max.products WHERE product_id = '" . $query_items['product_id'] . "'";
        }
        else if( !isset($_SESSION['cart_id']) && isset($_SESSION['user_id']) ) {
            $value =  $_GET["id"]; 
            $query4 = "INSERT INTO k16768_the_max.cart (cart_id, user_id, date_started) " . 
                "VALUES('', '" . $_SESSION['user_id'] . "', '')";
            $result4 = mysql_query($query4);
            $cart_id = mysql_insert_id($result4);
            $query2 = "INSERT INTO k16768_the_max.cart_items (cart_id, id, quantity, product_id, size_id, style_id) " . 
                "VALUES('" . $cart_id . "', '', '0', '" . $value . "', '0', '0')";
            $result2 = mysql_query($query2);
            echo "You do not yet have a cart, view our products and click 'add to cart' to see items here!";
        }
        else {
            echo "Only members are allowed a cart... sign in to access your account, or make a new account <a href='new_account.php'>here</a>!";
        }
        //$value =  $_GET["id"]; 
        //$query2 = "SELECT title, description, price, product_img FROM k16768_the_max.products WHERE id = '" . $value . "'";
        //$result2 = mysql_query($query2);
        //$row = mysql_fetch_array($result2, MYSQL_ASSOC);
        mysql_close($dbc2);
?>
                <div id="main_text">
                    <?php
                        //echo "cart_id " . $cart_id . ". result4: " . $result4 . ". result2: " . $result2 . ". $_session['cart_id']: " . $_SESSION['cart_id'];
                        while( $row = mysql_fetch_array($result2, MYSQL_ASSOC) ) {
                            $values = $row['product_img_s'];
                            if( strlen(trim($values)) == 0 ) {
                                $values = "img/swords.png";
                            }
                            echo "<div class='product'>" . 
                                    "<a href='product_info.php?id=" . $row['id'] . "'>" . 
                                        "<div class='product_img'>" .
                                            "<img border='0' src='" . $values . "' />" . 
                                        "</div>" . 
                                        "<div class='product_top'>" . 
                                            "<div class='product_title'>" . 
                                                "<div class='title'>" . 
                                                    $row['title'] . 
                                                "</div>" . 
                                                "<div class='cost'>" . 
                                                    $row['price'] . 
                                                "</div>" . 
                                            "</div>" . 
                                            "<div class='description'>" . 
                                                $row['description'] . 
                                            "</div>" . 
                                        "</div>" . 
                                    "</a>" . 
                                "</div>";
                        }
                    ?>
                </div>
<?php 
    }
    else {
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
        $query4 = "SELECT title, description, price, product_img FROM k16768_the_max.products WHERE product_id = '" . $value . "'";
        $result4 = mysql_query($query4);
        $insert = "INSERT INTO k16768_the_max.cart_items (cart_id, id, quantity, product_id, size_id, style_id) " . 
            "VALUES('1', '', '0', '" . $value . "', '0', '0')";
        while( $row2 = mysql_fetch_array($result4, MYSQL_ASSOC) ) {
            $values2 = $row2['product_img_s'];
            if( strlen(trim($values)) == 0 ){
                $values2 = "img/swords.png";
            }
            echo "Not quite added to cart<br /><div class='product'>" . 
                    "<a href='product_info.php?id=" . $row2['product_id'] . "'>" . 
                        "<div class='product_img'>" .
                            "<img border='0' src='" . $values2 . "' />" . 
                        "</div>" . 
                        "<div class='product_top'>" . 
                            "<div class='product_title'>" . 
                                "<div class='title'>" . 
                                    $row2['title'] . 
                                "</div>" . 
                                "<div class='cost'>" . 
                                    $row2['price'] . 
                                "</div>" . 
                            "</div>" . 
                            "<div class='description'>" . 
                                $row2['description'] . 
                            "</div>" . 
                        "</div>" . 
                    "</a>" . 
                "</div>";
        }
        mysql_close($dbc2);
    }
?>



