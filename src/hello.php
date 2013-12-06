<?php
    $database = 1;
    session_start();
    $_SESSION['the'] = 0;
    if( !isset($_POST["username"]) || !isset($_POST["password"]) ){
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
            $query = "SELECT username, password, admin, isactive FROM k16768_the_max.users WHERE username = '" . $_POST['username'] . "'";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            
            if( $row['isactive'] == 1 ) {
              if( $row['password'] == md5($_POST['password']) ) {
                  $_SESSION['username'] = $_POST['username'];
                  $_SESSION['login_failed'] = 1;
                  $_SESSION['the'] = 3;
                  if( $row['admin'] == 1 ) {
                      $_SESSION['the'] = 12;
                      $_SESSION['admin'] = 1;
                      $_SESSION['isactive'] = $row['isactive'];
                  }
              } 
              else if( $row['password'] != md5($_POST['password']) ) { 
                  $_SESSION['login_failed'] = 0;
                  $_SESSION['the'] = 4;
                  $_SESSION['isactive'] = $row['isactive'];
              }
             }
             else if( $row['isactive'] == 0 ) {
               $_SESSION['login_failed'] = 2; 
               $_SESSION['failed_reason'] = "Account suspended";
               $_SESSION['isactive'] = $row['isactive'];
             }
        }
        
        mysql_close($dbc);
    }
    echo "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script><script type='text/javascript' src='../javascript/made_it.js'></script>";
?>