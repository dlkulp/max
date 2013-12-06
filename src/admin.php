<?php
    include("include/header.php");
    if( $_SESSION['admin'] === 1 ) {
        try {
            $dbc = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
            if( $dbc == null ) {
                throw new Exception("hmmm, something went wrong: " . mysql_error());
            }
        }
        catch( Exception $e ) {
            echo 'Message: ' . $e->getMessage();
            $_SESSION['server_error'] = 1;
        }
        //$query = "SELECT DISTINCT type FROM k16768_the_max.products WHERE is_active != 0";
        //$result = mysql_query($query);
        //$query2 = "SELECT DISTINCT supplier FROM k16768_the_max.suppliers WHERE isactive != 0";
        //$result2 = mysql_query($query2);
        $dbh = new PDO('mysql:host=localhost;dbname=k16768_the_max', 'k16768_the_max', '4f3318d83020c');
        $type = $dbh->prepare("SELECT DISTINCT type FROM k16768_the_max.types WHERE isactive != 0");
        $suppliers = $dbh->prepare("SELECT DISTINCT supplier FROM k16768_the_max.suppliers WHERE is_active != 0");
        $type->execute();
        $suppliers->execute();
        $rows = $type->fetchAll(PDO::FETCH_ASSOC);
        $rowz = $suppliers->fetchAll(PDO::FETCH_ASSOC);
        
        if( $_SESSION['server_error'] !== 1 ) {
          if( isset($_POST['save']) ) {
              if( strlen(trim($_POST['type'])) == 0 ) $type = null;
                  else $type = $_POST['type'];
              if( strlen(trim($_POST['title'])) == 0 ) $title = null;
                  else $title = $_POST['title'];
              if( strlen(trim($_POST['description'])) == 0 ) $description = null;
                  else $description = $_POST['description'];
              if( strlen(trim($_POST['price'])) == 0 ) $price = null;
                  else $price = $_POST['price'];
              if( strlen(trim($_POST['supplier'])) == 0 ) $supplier = null;
                  else $supplier = $_POST['supplier'];
              if( strlen(trim($_POST['cost'])) == 0 ) $cost = null;
                  else $cost = $_POST['cost'];
              //if( strlen(trim($_POST[''])) == 0 ) $ = null;
                  //else $ = $_POST[''];
              //if( strlen(trim($_POST[''])) == 0 ) $ = null;
                  //else $ = $_POST[''];
            
              if( $type !== null && $title !== null && $description !== null && $price !== null && $supplier !== null && $cost !== null ) {    
                  $query = "INSERT INTO k16768_the_max.products (type, title, description, price, supplier, cost) " . 
                      "VALUES('$type', '$title', '$description', '$price', '$supplier', '$cost')";
                  $result = mysql_query($query);
              }
              else {
                echo "You must set all fields!";
              }
          }
          else if( isset($_POST['remove_products']) ) {
              if( strlen(trim($_POST['remove_product'])) == 0 ) $remove = null;
                  else $remove = $_POST['remove_product'];
                
              if( $remove !== null ) {
                  $query3 = "UPDATE k16768_the_max.products SET isactive = 0 WHERE product_id = " . $remove;
                  $result3 = mysql_query($query3);
              }
            
          }
          else if( isset($_POST['edit']) ) {
              if( strlen(trim($_POST['type'])) == 0 ) $type = null;
                  else $type = $_POST['type'];
              if( strlen(trim($_POST['title'])) == 0 ) $title = null;
                  else $title = $_POST['title'];
              if( strlen(trim($_POST['description'])) == 0 ) $description = null;
                  else $description = $_POST['description'];
              if( strlen(trim($_POST['price'])) == 0 ) $price = null;
                  else $price = $_POST['price'];
              if( strlen(trim($_POST['supplier'])) == 0 ) $supplier = null;
                  else $supplier = $_POST['supplier'];
              if( strlen(trim($_POST['cost'])) == 0 ) $cost = null;
                  else $cost = $_POST['cost'];
                
              if( $type !== null && $title !== null && $description !== null && $price !== null && $supplier !== null && $cost !== null ) {
                  
                  $dbh = new PDO('mysql:host=localhost;dbname=k16768_the_max', 'k16768_the_max', '4f3318d83020c');
                  $stmt = $dbh->prepare("UPDATE k16768_the_max.products SET type = :type, title = :title, description = :description, price = :price, supplier = :supplier, cost = :cost WHERE product_id = :id");
                  
                  $stmt->bindParam(':type', $type);
                  $stmt->bindParam(':title', $title);
                  $stmt->bindParam(':description', $description);
                  $stmt->bindParam(':price', $price);
                  $stmt->bindParam(':supplier', $supplier);
                  $stmt->bindParam(':cost', $cost);
                  $stmt->bindParam(':id', $_SESSION['edit_id']);
                  //$result = mysql_query($query);
                  
                  //$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
                  //$stmt->bindParam(':name', $name);
                  //$stmt->bindParam(':value', $value);

                  // insert one row
                  $stmt->execute();
                  
                  unset($_SESSION['edit_id']);
              }
    
          }
          else if( isset($_POST['vendor']) ) {
              if( strlen(trim($_POST['vendor_name'])) == 0 ) $vendor_name = null;
                  else $vendor_name = $_POST['vendor_name'];
              if( strlen(trim($_POST['vendor_id'])) == 0 ) $vendor_id = null;
                  else $vendor_id = $_POST['vendor_id'];
                
              if( $vendor_id !== null && $vendor_name !== null ) {
                  $query = "INSERT INTO k16768_the_max.suppliers (supplier, id) " . 
                    "VALUES('$vendor_name', '$vendor_id')";
                  $result = mysql_query($query);
              }
          }
          else if( isset($_POST['vendor_remove']) ) {
              if( strlen(trim($_POST['vendor_name'])) == 0 || $_POST['vendor_name'] == "-- select one --" ) $vendor_name = null;
                  else $vendor_name = $_POST['vendor_name'];
                
              if( $vendor_name !== null ) {
                  $query = "UPDATE k16768_the_max.suppliers SET is_active = 0 WHERE supplier = '" . $vendor_name . "'";
                  $result = mysql_query($query);
              }
          }
          else if( isset($_POST['create']) ) {
              if( strlen(trim($_POST['admin_username'])) == 0 ) $admin_username = null;
                  else $admin_username = $_POST['admin_username'];
              if( strlen(trim($_POST['admin_password'])) == 0 ) $admin_password = null;
                  else $admin_password = md5($_POST['admin_password']);
                
              if( $admin_username !== null && $admin_password !== null ) {
                  $query = "INSERT INTO k16768_the_max.users (username, password, admin)" . 
                    "VALUES('$admin_username', '$admin_password', '1')";
                  $result = mysql_query($query);
              }
          }
          else if( isset($_POST['remove']) ) {
              if( strlen(trim($_POST['username'])) == 0 ) $username_search = null;
                  else $username_search = $_POST['username'];
                
              if( $username_search !== null ) {
                  $query = "UPDATE k16768_the_max.users SET isactive = 0 WHERE username = '" . $username_search . "'";
                  $result = mysql_query($query);
              }
          }
          else if( isset($_POST['new']) ) {
            if( strlen(trim($_POST['add_type'])) == 0 ) $type_add = null;
              else $type_add = $_POST['add_type'];
              
              if( $type_add != null ) {
                $query = "SELECT type, isactive FROM k16768_the_max.types WHERE type = " . $type_add;
                $result = mysql_query($query);
                $row = mysql_fetch_array($result, MYSQL_ASSOC);
                $dbh = new PDO('mysql:host=localhost;dbname=k16768_the_max', 'k16768_the_max', '4f3318d83020c');
                
                if( $row['type'] == null ) {
                  $stmt = $dbh->prepare("INSERT INTO k16768_the_max.types (type) VALUES(:type)");
                  
                  $stmt->bindParam(':type', $type_add);
                  $stmt->execute();
                }
                else if( $row['isactive'] === 0 ) {
                  $stmt = $dbh->prepare("UPDATE k16768_the_max.types SET isactive = 1 WHERE type = :type");
                  
                  $stmt->bindParam(':type', $type_add);
                  $stmt->execute();
                }
              }
          }
          else if( isset($_POST['type_remove']) ) {
            if( strlen(trim($_POST['remove_type'])) == 0 ) $type_remove = null;
              else $type_remove = $_POST['remove_type'];
              
              if( $type_remove !== null ) {
                //$query = "INSERT INTO k16768_the_max.type
                $dbh = new PDO('mysql:host=localhost;dbname=k16768_the_max', 'k16768_the_max', '4f3318d83020c');
                $stmt = $dbh->prepare("UPDATE k16768_the_max.types SET isactive = 0 WHERE type = :type");
                  
                $stmt->bindParam(':type', $type_remove);
                $stmt->execute();
              }
          }
?>
<div id="main_text">
  <div id="admin_control_right">
    <p>Product Control Panel</p>
    <div id="admin_products">
      <div id="tabs">
        <ul class="admin_list">
          <li>
            <a href="#tabs-1">Add</a>
          </li>
          <li>
            <a href="#tabs-2">Remove</a>
          </li>
          <li>
            <a href="#tabs-3">Edit</a>
          </li>
          <li>
            <a href="#tabs-4">Vendor</a>
          </li>
          <li>
            <a href="#tabs-5">Type</a>
          </li>
        </ul>
        <div id="tabs-1">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
              <tr>
                <td>
                  type
                </td>
                <td>
                  <select required="required" name="type">
                    <option selected="selected">
                      -- select one --
                    </option>
                    <?php
                        foreach($rows as $row)
                        {
                            echo "<option value='" . $row['type'] . "'>" . $row['type'] . "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  title
                </td>
                <td>
                  <input type="text" name="title" placeholder="title" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  description
                </td>
                <td>
                  <input type="text" name="description" placeholder="description" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  price
                </td>
                <td>
                  <input type="text" name="price" placeholder="price" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  vendor
                </td>
                <td>
                  <select required="required" name="supplier">
                    <option selected="selected">
                      -- select one --
                    </option>
                    <?php
                        foreach($rowz as $row)
                        {
                            echo "<option value='" . $row['supplier'] . "'>" . $row['supplier'] . "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  cost
                </td>
                <td>
                  <input type="text" name="cost" placeholder="cost" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  <lable for="new_image">image</lable> 
                </td>
                <td>
                  <imput type="file" name="new image" id="new_image" />
                </td>
              </tr>
            </table>
            product img large
            product img small
            <br />
            <input type="submit" name="save" value="save" />
          </form>
        </div>
        <div id="tabs-2">
          <?php if( isset($_GET['remove']) ) {
            $remove = $_GET['remove'];
            echo "<p> Are you sure you want to delete this product?</p>" . 
              "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>" . 
                "<input type='hidden' name='remove_product' value='" . $_GET['remove'] . "' /><br />" . 
                "<input type='submit' name='remove_products' value='remove' />" . 
              "</form>";
          }
          else echo "<p>Please go to the main page and select a product to remove.</p>";
        ?>
        </div>
        <div id="tabs-3">
          <?php 
            if( isset($_GET['edit']) ) {
              $query3 = "SELECT * FROM k16768_the_max.products WHERE product_id = " . $_GET['edit'];
              $result3 = mysql_query($query3);
              $row3 = mysql_fetch_array($result3, MYSQL_ASSOC);
              $_SESSION['edit_id'] = $_GET['edit'];
          ?>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
              <tr>
                <td>
                  type
                </td>
                <td>
                  <select required="required" name="type">
                    <option selected="selected">
                      <?php echo $row3['type'];?>
                    </option>
                    <?php
                        foreach($rows as $row)
                        {
                            echo "<option value='" . $row['type'] . "'>" . $row['type'] . "</option>";
                        }
                    ?>
                    <!--<option value="hoddie">hoodie</option>
                    <option value="shorts">shorts</option>-->
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  title
                </td>
                <td>
                  <input type="text" name="title" placeholder="title" value="<?php echo $row3['title'];?>" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  description
                </td>
                <td>
                  <input type="text" name="description" placeholder="description" value="<?php echo $row3['description'];?>" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  price
                </td>
                <td>
                  <input type="text" name="price" placeholder="price" value="<?php echo $row3['price'];?>" /><br />
                </td>
              </tr>
              <tr>
                <td>
                  vendor
                </td>
                <td>
                  <select required="required" name="supplier">
                    <option selected="selected">
                      <?php echo $row3['supplier'];?>
                    </option>
                    <?php
                        foreach($rowz as $row)
                        {
                            echo "<option value='" . $row['supplier'] . "'>" . $row['supplier'] . "</option>";
                        }
                    ?>
                    <!--<option value="CostCo">CostCo</option>
                    <option value="Kohl's">Kohl's</option>-->
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  cost
                </td>
                <td>
                  <input type="text" name="cost" placeholder="cost" value="<?php echo $row3['cost'];?>" /><br />
                </td>
              </tr>
            </table>
            product img large
            product img small
            <br />
            <input type="submit" name="edit" value="edit" />
          </form>
          <?php }
            else echo"<p>Please go to the main page and select a product to edit.</p>";
          ?>
        </div>
        <div id="tabs-4">
          <table>
            <tr>
              <td>
                <p>Add vendors here!</p>
              </td>
              <td>
                <p>Remove vendors here!</p>
              </td>
            </tr>
            <tr>
              <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <input type="text" name="vendor_name" placeholder="vendor name"  /><br />
                  <input type="text" name="vendor_id" placeholder="vendor id"  /><br />
                  <input type="submit" name="vendor" value="add" />
                </form>
              </td>
              <td>
                <form id="vendor_remove" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <select required="required" name="vendor_name">
                    <option selected="selected">
                      vendor name
                    </option>
                    <?php
                        foreach($rowz as $row)
                        {
                            echo "<option value='" . $row['supplier'] . "'>" . $row['supplier'] . "</option>";
                        }
                    ?>
                  </select>
                  <!--<input type="text" name="vendor_name" placeholder="vendor name"  />--><br />
                  <input type="submit" name="vendor_remove" value="remove" />
                </form>
              </td>
            </tr>
          </table>
        </div>
        <div id="tabs-5">
          <table>
            <tr>
              <td>
                <p>Add types of products here!</p>
              </td>
              <td>
                <p>Remove types here!</p>
              </td>
            </tr>
            <tr>
              <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <input type="text" name="add_type" placeholder="ex: mugs" /><br />
                  <input type="submit" name="new" value="add" />
                </form>
              </td>
              <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <input type="text" name="remove_type" placeholder="type"  /><br />
                  <input type="submit" name="type_remove" value="remove" />
                </form>
              </td>
            </tr>

          </table>
        </div>
      </div>
    </div>
  </div>
  <div id="admin_control_left">
    <p>User Control Panel</p>
    <div id="admin_user_control">
      <div id="tab">
        <ul class="admin_list">
          <li>
            <a href="#tab-1">Add</a>
          </li>
          <li>
            <a href="#tab-2">Remove</a>
          </li>
        </ul>
        <div id="tab-1">
          <p>
            Create new admin account:
          </p>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <input type="text" name="admin_username" placeholder="username" /><br />
              <input type="password" name="admin_password" placeholder="password" /><br />
              <input type="submit" name="create" value="create" /><br />
            </form>
        </div>
        <div id="tab-2">
          <p>
            Remove Users
          </p>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="username" />
            <br />
            <input type="submit" name="remove" value="remove"  />
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
      }
      else echo "Error 404: The page you asked for could not be found!<br />Here's what you can try:<br /><ul><li>Refresh the page</li><li>Make sure you are connected to the internet</li><li>If nothig else, you can try again later and hope that the problem has gone away!</li></ul>";
    }
    else echo "You are not an admin, please login and try again";
?>




