<?php
    $database = 1;
    $sign_in = -1;
    if( !isset($_POST["username"]) && !isset($_POST["password"]) ){
        session_start();
        $the = 0;
    }
    else if( isset($_POST["username"]) && isset($_POST["password"]) ){    
        $the = 1;
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
                $_SESSION['password'] = $_POST['password'];
                $the = 2;
            }
            else { 
                $sign_in = 0;
                $the = 3;
            }
        }
        mysql_close($dbc);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
        <script type='text/javascript' src='../javascript/page.php'></script>
<?php
            if( !isset($_SESSION['username']) ) {
                echo "<script type='text/javascript' src='../javascript/error.js'></script>";
            }
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>The Max Student Store</title>
    </head>
    <body>
        <div id="content">
            <div id="logo">
                <img alt="raider logo" id="raider" src="img/RaiderbotWhite_big_chopped.png" />
            </div>
            <div id="sign_in">
                <div id="top_bar">
                    
                    <?php
                        if( isset($_SESSION['username']) ) {
                            echo "<a href='sign_out.php'>sign out</a>";
                        }
                        else {
                            echo "<a id='sign'>sign in</a>";
                        }
                    ?>
                    
                    <a href="new_account.php">sign up</a>
                </div>
                <div id="head1">
                    <form id="user_pass" action="hello.php" method="post">
                        <input id="input_user" type="text" placeholder="username" name="username" />
                        <input type="password" name="password" placeholder="password" />
                        <input type="submit" name="submit" />
                    </form>
                </div>
            </div>
            <div id="page">
                <div id="header2">
                    <div id="top">
                        The
                    </div>
                    <div id="title3">
                        Max
                    </div>
                    <div id="bottom">
                        Student Store
                    </div>
                </div>
                <div id="searchBar" >
                    <form target="../search.php?search=">
                        <input id="search" name="search" type="search" placeholder="search products" />
                    </form>
                </div>
                <div id="main_menu">
                    <ul id="menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php?search=short">Shorts</a></li>
                        <li><a href="search.php?search=hoodie">Hoodie</a></li>
                        <li><a href="search.php?search=shirt">Shirts</a></li>
                        <li>
                            <a href="#">Categories</a>
                            <ul>
                                <li><a href="search.php?search=lanyard">Lanyard</a></li>
                                <li><a href="#">Other</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php echo $the;?>
                <br />
                
            
                





