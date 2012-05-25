<?php
    session_start();
    if( !isset($_SESSION['username']) ) {
            $_SESSION['username'] = "anonymous";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
        <script type='text/javascript' src='../javascript/page.php'></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>The Max Student Store</title>
    </head>
    <body>
        <div id="content">
            <div id="logo">
                <img alt="raider logo" id="raider" src="img/RaiderbotWhite_big_chopped.png" />
            </div>
            <div id="login_output">
                <?php
                    if( $_SESSION['login_failed'] === 1 ) {
                        echo "Login successful!";
                        $_SESSION['login_failed'] = null;
                    }
                    else if( $_SESSION['login_failed'] === 0 ) {
                        echo "Login failed!";
                        $_SESSION['login_failed'] = null;
                    }
                ?>
            </div>
            <div id="welcome_user">
                <?php 
                    echo "hello " . $_SESSION['username'] . "!";
                ?>
            </div>
            <div id="sign_in">
                <div id="top_bar">
                    <?php
                        if( $_SESSION['username'] == "anonymous" ) {
                            echo "<a id='sign'>sign in</a>";
                        }
                        else {
                            echo "<a href='sign_out.php'>sign out</a>";
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
                    <form action="search.php?search=" method="get">
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
                <?php 
                    echo $_SESSION['the'] . " " . $_SESSION['login_failed'] . " " . $_SESSION['username'] ;
                ?>
                <br />
                
            
                





