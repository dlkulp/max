<?php include("include/header.php"); 
    $display_form = 0;
    $has_errors = 0;
    $database = 1;
    $made_it = -1;
    if( isset($_POST['sign_up']) ) {
        if( strlen(trim($_POST['username'])) == 0 ) $username = null;
            else $username = $_POST['username'];
        if( strlen(trim($_POST['password'])) == 0 ) $password = null;
            else $password = $_POST['password'];
        if( strlen(trim($_POST['password2'])) == 0 ) $password2 = null;
            else $password2 = $_POST['password2'];
        if( $password !== $password2 ) {
            $error = 1;}
            else {
                $password2 = md5($password);
            }
        
        if( $error == 0 ) {
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
            $query = "INSERT INTO k16768_the_max.users (username, password, admin) " . 
                "VALUES('$username', '$password2', '0')";
            $result = mysql_query($query);
            mysql_close($dbc);
            $made_it = 1;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }
        else { ?>
            <div id="main_text">
                <form id="sign_up" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <p id="error_no_match">Please make sure your passwords match!</p>
                    Preferred username: <input type="text" name="username" value="<?php echo $username; ?>" /> <br /><br />
                    Preferred password: <input type="password" name="password" placeholder="password" /> <br /><br />
                    Verify password: <input type="password" name="password2" placeholder="password" /> <br /><br />
                    <input type="submit" name="submit" value="Create Account" />
                </form>
            </div>
        <?php
        }
        if( $made_it == 1 ) {
                echo "<script type='text/javascript' src='../javascript/made_it.js'></script>";
        }
    }
    else if( $error == 0 ) { 
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
include("include/footer.php"); ?>