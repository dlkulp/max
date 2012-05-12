<?php
    session_start();
    //$display_form = 0;
    //$has_errors = 0;
    //$database = 1;
    //$made_it = -1;
        
    //try {
        //$dbc = mysql_connect('localhost', 'k16768_the_max', '4f3318d83020c', 'k16768_the_max');
        //if( $dbc == null ) {
            //throw new Exception("Hmmm, something went wrong when trying to submit your info, you should try again now or later to see if it works.<br /> If you are still getting errors you can try contacting us.<br /><br />Error: #" . mysql_errno() . " " . mysql_error() . "<br />");
        //}  
    //}
    //catch(Exception $e) {
        //echo 'Message: ' . $e->getMessage();
        //$database = 0;
    //}
    //$query = "SELECT user_name, password FROM k16768_the_max.user";
    //$result = mysql_query($query);
    //mysql_close($dbc);
    //$made_it = 1;
    //session_start();
   // $_SESSION['username'] = $username;
    //$_SESSION['password'] = $password;
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>
    <body>
        <div id="content">
            <div id="logo">
                <img id="raider" src="../img/RaiderbotWhite_big_chopped.png" />
            </div>
            <div id="sign_in">
                <div id="user_pass">
                    <a id="sign">sign in</a>
                    <a id="" href="sign_out.php">sign out</a>
                    <a href="new_account.php">sign up</a>
                    <form target="hello.php">
                        <input id="input_user" type="text" name="username" />
                        <input type="password" name="user_pass" />
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





