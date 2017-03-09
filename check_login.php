<!--
// *~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
// *                                                  *
// *  Site Developed by Akshay Aradhya                *
// *  Website      : dollarakshay.com                 *
// *  Source Code  : https://github.com/dollarakshay  *
// *                                                  *
// *~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
-->

<?php
session_start();
?>
<html>
<head>
    <title> Google It </title>
    <meta charset="utf-8">
    
    <!-- Stylesheets -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/main_stylesheet.css" />
    <link rel="icon" type="image/png" href="/images/favicon.png">
    
    <!-- Scripts -->
    <script src="/js/main_script.js"></script>
    
</head>
<body>

    <!-- Navbar -->
    <nav class='navbar navbar-default' id='mainNavbar'>
        <div class='container-fluid'>
            <div class='navbar-header' id='mainNavbarHeader'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#mainNavbarContent'>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='/'>
                    <span style='color:#eeeeee'>
                        Google It
                    </span>
                </a>
            </div>
            <div class='collapse navbar-collapse navbar-right' id='mainNavbarContent'>
                <ul class='nav navbar-nav'> 
                    <li> <a href='/leaderboard.php' target='_blank'> Leaderboard </a> </li> 
                </ul>
            </div>
        </div>
    </nav>

    <?php

        error_reporting(E_ERROR | E_PARSE);

        $servername = "localhost";
        $username = "root";
        $password = "firewall123";
        $dbname = "googleit";

        $team_name = $_POST["teamname"];
        $pass = $_POST["password"];
        

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $result = mysqli_query($conn, "SELECT * FROM users WHERE TeamName = '".$team_name."'");
        if(!$result) {
            die("Querry failed: " . mysqli_errno($conn));
        }
        $rows = mysqli_num_rows($result);
        
        if($rows>0){
            $row = mysqli_fetch_assoc($result);
            if( $row['TeamName']==$team_name && $row['Password']==$pass ){
                echo " <h2> Sign Up Successful </h2>";
                $_SESSION["teamname"] = $team_name;
                echo " <a href='question.php'> <h3> Continue to this link </h3> </a>";
            }
            else{
                echo " <h2> Incorrect Password Found </h2>";
                echo " <a href='/login.html'> <h3> Go back </h3> </a>";
            }
        }
        else{
            echo " <h2> Team Name not Found </h2>";
            echo " <a href='/login.html'> <h3> Go back </h3> </a>";
        }
        
        mysqli_close($conn);

    ?>
    
</body>
</html>