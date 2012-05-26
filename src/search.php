<?php include("include/header.php"); 
    if( isset($_GET["search"]) || isset($_POST["search"]) ){
        try {
            $dbc2 = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
            $_SESSION['the'] = 5;;
            if( $dbc2 == null ) {
                $_SESSION['the'] = 6;
                throw new Exception("Hmmm, something went wrong.... :(<br />Try reloading your page, or try again later! </br /><br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
            }  
        }
        catch(Exception $e) {
            echo 'Message: ' . $e->getMessage();
            $_SESSION['the'] = 7;
        }
        $value =  $_GET["search"];
        $query2 = "SELECT product_id, title, description, price, product_img_s FROM k16768_the_max.products WHERE type LIKE '%" . $value . "%' or title LIKE '%" . $value . "%' or description LIKE '%" . $value . "%'";
        $result2 = mysql_query($query2);
        
        $_SESSION['the'] = 8;
?>
                    <div id="main_text">
                        <?php
                            $_SESSION['the'] = 9;
                            while( $row2 = mysql_fetch_array($result2, MYSQL_ASSOC) ) {
                                $values = $row2['product_img_s'];
                                if( strlen(trim($values)) == 0 ){
                                    $values = "img/swords.png";
                                    $_SESSION['the'] = 10;
                                }
                                $_SESSION['the'] = 11;
                                echo "<div class='product'>" . 
                                        "<a href='product_info.php?id=" . $row2['id'] . "'>" . 
                                            "<div class='product_img'>" .
                                                "<img border='0' src='" . $values . "' />" . 
                                            "</div>" . 
                                            "<div class='product_top'>" . 
                                                "<div class='product_title'>" . 
                                                    "<div class='title'>" . 
                                                        $row2['title'] . 
                                                    "</div>" . 
                                                    "<div class='cost'>" . 
                                                        "$" . $row2['price'] . 
                                                    "</div>" . 
                                                "</div>" . 
                                                "<div class='description'>" . 
                                                    $row2['description'] . 
                                                "</div>" . 
                                            "</div>" . 
                                        "</a>" . 
                                    "</div>";
                            }
                        ?>
                    </div>
<?php
    }
    else {echo "Oops, no product set!";}
    echo $value . "   " . $_SESSION['the'];
    include("include/footer.php"); 
    mysql_close($dbc2);
?>






