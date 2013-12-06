<?php
    session_start();
    if( !isset($_SESSION['username']) ) {
            $_SESSION['username'] = "anonymous";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" href="css/jquery-ui-1.8.20.custom.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
        <script type='text/javascript' src='../javascript/jquery-ui-1.8.20.custom.min.js'></script>
        <script type='text/javascript' src='../javascript/page.php'></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>The Max Student Store</title>
    </head>
    <body>
        <div id="content">
            <div id="logo">
                <img alt="Raider Logo by Danning Yao" id="raider" src="img/RaiderbotWhite_big_chopped.png" />
            </div>
            <div id="login_output">
                <?php
                    if( $_SESSION['login_failed'] === 1 ) {
                        echo "Login successful!";
                        $_SESSION['login_failed'] = null;
                    }
					else if( $_SESSION['login_failed'] == 2 && $_SESSION['failed_reason'] == "Account suspended" ) {
						echo $_SESSION['failed_reason'];
						$_SESSION['login_failed'] = null;
						$_SESSION['failed_reason'] = null;
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
                            echo "<a id='sign'>sign in</a>&nbsp;<a href='new_account.php'>sign up</a>";
                        }
                        else {
                            echo "<a href='sign_out.php'>sign out</a>";
                        }
                    ?>
                </div>
                <div id="head1">
                    <form id="user_pass" action="hello.php" method="post">
                        <input id="input_user" type="text" placeholder="username" name="username" />
                        <input id="input_pass"type="password" name="password" placeholder="password" />
                        <input type="submit" name="submit" />
                    </form>
                </div>
            </div>
            <div id="page">
                <div id="header2">
                    <!--<div id="top">
                        The
                    </div>
                    <div id="title3">
                        Max
                    </div>
                    <div id="bottom">
                        Student Store
                    </div>-->

                </div>
                <div id="searchBar" >
                    <form action="search.php?search=" method="get">
                        <input id="search" name="search" type="search" placeholder="search products" />
                    </form>
                </div>
                <div id="main_menu">
                    <ul id="menu">
                        <li><a href="index.php">home</a></li>
                        <li><a href="search.php?search=short">shorts</a></li>
                        <li><a href="search.php?search=hoodie">hoodie</a></li>
                        <li><a href="search.php?search=shirt">shirts</a></li>
                        <li>
                            <a href="#">others</a>
                            <ul>
                                <!--<li><a href="search.php?search=lanyard">Lanyard</a></li>-->
                                <?php 
									$dbh = new PDO('mysql:host=localhost;dbname=k16768_the_max', 'k16768_the_max', '4f3318d83020c');
									$stmt = $dbh->prepare("SELECT * FROM k16768_the_max.types");
									$stmt->execute();
									$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $num_menu = 0;
									foreach( $rows as $row ) {
                                        if( ($row['type'] != 'shorts') && ($row['type'] != 'hoodies') && ($row['type'] != 'shirts') ) {
									        echo "<li><a href='search.php?search=" . $row['type'] . "'>" . $row['type'] . "</a></li>";
                                            $num_menu++;
                                        }
                                        if( $num_menu == 4 )
                                            break;
									}
								?>
                            </ul>
                        </li>
                        <?php if($_SESSION['admin'] === 1) echo"<li><a href='admin.php'>admin</a></li>"; ?>
                    </ul>
                </div>
                <?php 
                    //echo $_SESSION['the'] . " " . $_SESSION['login_failed'] . " " . $_SESSION['username'] . " " . $_SESSION['failed_reason'] . " " . $_SESSION['isactive'] ;
                ?>
                <br />
                
            
                





