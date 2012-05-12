<?php include("include/header.php"); 
    if( isset($_GET["search"]) ){
        try {
            $dbc2 = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
            if( $dbc2 == null ) {
                throw new Exception("Hmmm, something went wrong.... :(<br />Try reloading your page, or try again later! </br /><br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
            }  
        }
        catch(Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        $value =  $_GET["search"]; 
        $query2 = "SELECT product_id, title, description, price, product_img_s FROM k16768_the_max.products WHERE type LIKE '" . $value . "' && title LIKE '" . $value . "' && description LIKE '" . $value . "'";
        $result2 = mysql_query($query2);
        mysql_close($dbc2);
?>
                    <div id="main_text">
                        <?php
                            while( $row = mysql_fetch_array($result2, MYSQL_ASSOC) ) {
                                $values = $row['product_img_s'];
                                if( strlen(trim($values)) == 0 ){
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
    else echo "Oops, no product set!";
    echo $value . "   " .  $result2;
    include("include/footer.php"); 
?>





