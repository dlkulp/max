<?php
    $database = 1;
    $_SESSION['the'] = 0;
    if( !isset($_POST["username"]) && !isset($_POST["password"]) ){
        session_start();
        //if( !isset($_SESSION['login_failed']) || $_SESSION['login_failed'] == 0 ) {
        //    $_SESSION['login_failed'] = 1;
        //}
        $_SESSION['login_failed'] = 0;
        $_SESSION['the'] = 1;
    }
    else if( isset($_POST["username"]) && isset($_POST["password"]) ){    
        $_SESSION['the'] = 2;
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
        if( $database == 1 ) {
            $query = "SELECT username, password FROM k16768_the_max.users WHERE username = '" . $_POST['username'] . "'";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            if( $row['password'] == md5($_POST['password']) ) {
                session_start();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['login_failed'] = 1;
                $_SESSION['the'] = 3;
            }
            else { 
                session_start();
                $_SESSION['login_failed'] = 0;
                $_SESSION['the'] = 4;
            }
        }
        mysql_close($dbc);
    }
    echo "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script><script type='text/javascript' src='../javascript/made_it.js'></script>";
?>