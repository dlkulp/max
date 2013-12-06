<?php
    try {
        $dbc = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
        if( $dbc == null ) {
            throw new Exception("hmmm, something went wrong: " . mysql_error());
        }
    }
    catch( Exception $e ) {
        echo 'Message: ' . $e->getMessage();
    }
    
    $query = "SELECT product_id, title, description, price, isactive, product_img_s FROM k16768_the_max.products";
    $result = mysql_query($query);
?>

<?php include("include/header.php") ?>
                <div id="main_text">
                    <?php
                        while( $row = mysql_fetch_array($result, MYSQL_ASSOC) ) {
                            $value = $row['product_img_s'];
                            if( $row['isactive'] == 1 ) {
                              if( strlen(trim($value)) == 0 ){
                                  $value = "img/swords.png";
                              }
                              echo "<div class='product'>" . 
                                      "<a href='product_info.php?id=" . $row['product_id'] . "'>" . 
                                          "<div class='product_img'>" .
                                              "<img alt='image of product' class='product_img-1' src='" . $value . "' />" . 
                                          "</div>" . 
                                      "</a>" .
                                          "<div class='product_top'>" . 
                                              "<div class='product_title'>" . 
                                                "<a href='product_info.php?id=" . $row['product_id'] . "'>" . 
                                                  "<div class='title'>" . 
                                                      $row['title'] . 
                                                  "</div>" . 
                                                "</a>";
                                                  if( $_SESSION['admin'] === 1 ) echo "&nbsp;<button data-product-id='" . $row['product_id'] . "' class='admin_edit' onClick='go(this)'>edit</button>&nbsp;<button data-product-id='" . $row['product_id'] . "' class='admin_edit' onClick='go2(this)'>remove</button>";
                                                    echo "<div class='cost'>" . 
                                                      "$" . $row['price'] . 
                                                  "</div>" . 
                                              "</div>" . 
                                              "<div class='description'>" . 
                                                  $row['description'] . 
                                              "</div>" . 
                                          "</div>" . 
                                      "</a>" . 
                                  "</div>";
                              }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    
<?php 
    include("include/footer.php");
    mysql_close($dbc);
?>