<?php include("include/header.php"); 
    $display_form = 0;
    $error = 0;
    $database = 1;
    $made_it = -1;
    if( isset($_POST['sign_up']) ) {
        if( strlen(trim($_POST['username'])) === 0 ) $username = null;
            else $username = $_POST['username'];
        if( strlen(trim($_POST['password'])) === 0 ) $password = null;
            else $password = $_POST['password'];
        if( strlen(trim($_POST['password2'])) === 0 ) $password2 = null;
            else $password2 = $_POST['password2'];
        
        //
        if( $password !== $password2 ) {
            $error_message = "Please make sure your passwords match!";
            $error = 1;
        }
        else if( $username === null || strlen($username) < 5 ) {
            $error_message = "Please make sure your username is more than 5 characters!";
            $error = 1;
        }
        else if( $password2 === null || strlen($password2) <=7 ){
            $error_message = "Please make sure you password is more than 6 characters";
            $error = 1;
        }
        else if( strlen($username) >= 15 ) {
          $error_message = "Please limit your username to fewer than 15 characters";
          $error = 1;
         }
        else {
            try {
                $dbc = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
                if( $dbc == null ) {
                    throw new Exception("Hmmm, something went wrong when trying to submit your info, you should try again now or later to see if it works.<br /> If you are still getting errors you can try contacting us.<br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
                }  
            }
            catch(Exception $e) {
                echo 'Message: ' . $e->getMessage();
                $database = 0;
            }
            $query = "SELECT username FROM k16768_the_max.users WHERE username = '" . $username . "'";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            if ( $row['username'] === $username ) {
                $error_message = "Sorry, that username is already taken, please try again!";
                $error = 1;
            }
            else {
            $password2 = md5($password);
            }
        }
        
        //
        
        //
        try {
            $dbc = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
            if( $dbc == null ) {
                throw new Exception("Hmmm, something went wrong when trying to submit your info, you should try again now or later to see if it works.<br /> If you are still getting errors you can try contacting us.<br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
            }  
        }
        catch(Exception $e) {
            echo 'Message: ' . $e->getMessage();
            $database = 0;
        }
        $query = "SELECT username FROM k16768_the_max.users WHERE username = '" . $username . "'";
        $result = mysql_query($query);
        if( $error === 0 ) {
            $query2 = "INSERT INTO k16768_the_max.users (username, password, admin) " . 
                "VALUES('$username', '$password2', '0')";
            $result2 = mysql_query($query2);
            $made_it = 1;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }
        else { ?>
            <div id="main_text">
                <form id="sign_up" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <p id="error_no_match"><?php echo $error_message; ?></p>
                    Preferred username: <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>" /> <br /><br />
                    Preferred password: <input type="password" name="password" placeholder="password" /> <br /><br />
                    Verify password: <input type="password" name="password2" placeholder="password" /> <br /><br />
                    <input type="submit" name="sign_up" value="Create Account" />
                </form>
            </div>
        <?php
        }
        if( $made_it === 1 ) {
                echo "<script type='text/javascript' src='../javascript/made_it.js'></script>";
        }
    }
    else if( $error === 0 ) { 
        $display_form = 1;
    ?>
                <div id="main_text">
                    <form id="sign_up" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        Preferred username: <input type="text" name="username" placeholder="username" /> <br /><br />
                        Preferred password: <input type="password" name="password" placeholder="password" /> <br /><br />
                        Verify password: <input type="password" name="password2" placeholder="password" /> <br /><br />
                        <input type="submit" name="sign_up" value="Create Account" />
                    </form>
                </div>
<?php }
    include("include/footer.php");
    mysql_close($dbc);
?>


