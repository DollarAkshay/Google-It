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
<body id="leaderboard">

<?php

    error_reporting(E_ERROR | E_PARSE);

    $servername = "localhost";
    $username = "root";
    $password = "firewall123";
    $dbname = "googleit";
    $sess_teamname = $_SESSION["teamname"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Navbar
    echo "<nav class='navbar navbar-default' id='mainNavbar'>";
    echo "  <div class='container-fluid'>";
    echo "      <div class='navbar-header' id='mainNavbarHeader'>";
    echo "          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#mainNavbarContent'>";
    echo "              <span class='icon-bar'></span>";
    echo "              <span class='icon-bar'></span>";
    echo "              <span class='icon-bar'></span>";
    echo "          </button>";
    echo "          <a class='navbar-brand' href='/'>";
    echo "              <span style='color:#eeeeee'>";
    echo "                  Google It";
    echo "              </span>";
    echo "          </a>";
    echo "      </div>";
    echo "      <div class='collapse navbar-collapse navbar-right' id='mainNavbarContent'> " ;
    echo "          <ul class='nav navbar-nav'> ";
    echo "              <li> <a href='/leaderboard.php' target='_blank'> Leaderboard </a> </li> ";
    echo "          </ul>";
    echo "      </div>";
    echo "  </div>";
    echo "</nav>";


    $sql = "SELECT * FROM users ORDER BY QuestionID desc, TimeStamp" ;
    $result = mysqli_query($conn, $sql);
    
    if(!$result) {
        die("Querry failed: " . mysqli_errno($conn));
    }

    echo "<table id='leader-table' >";
    echo "<tr>";
    echo "<th> Team Name </th>" ;
    echo "<th> Question </th>" ;
    echo "</tr>" ;
    if ($result) {
        $rc = 0;
        while( $row = mysqli_fetch_assoc($result)) {
            if($row['TeamName'] == $sess_teamname){
               echo "<tr class='cur-team'>"; 
            }
            else if( $rc%2 == 1){
                echo "<tr class='dark-row'>";
            }
            else{
                echo "<tr class='light-row'>";
            }
            echo "<td> ".$row['TeamName']." </td>" ;
            echo "<td> ".$row['QuestionID']." </td>" ;
            echo "</tr>" ;
            $rc+=1;
        }
    }
    
    echo "</table>\n";
    mysqli_close($conn);
        
        
?> 
</body>
</html>