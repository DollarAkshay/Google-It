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
<body id="question-page">

<?php

    function debug_to_console( $data ) {
        echo "<script>console.log('".$data."');</script>\n";
    }

    error_reporting(E_ERROR | E_PARSE);
    
    // Global Variables
    $servername = "localhost";
    $username = "root";
    $password = "firewall123";
    $dbname = "googleit";
    $sess_teamname = $_SESSION["teamname"];
    $prev_questionID = -1;
    if( isset($_POST['questionid']) ){
        $prev_questionID = $_POST['questionid'];
    }
    $prev_answer = -1;
    if( isset($_POST['answer']) ){
        $prev_answer = rtrim(strtolower($_POST['answer']));
    }
    
    
    // Establish a Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    

    // Check if Question was Correct
    if($prev_questionID>=0){
        
        $sql = "SELECT * FROM questions WHERE QuestionID = ".$prev_questionID." ";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Querry get prev question failed: " . mysqli_errno($conn));
        }

        $row = mysqli_fetch_assoc($result);
        $correctans = strtolower($row['Answer']);
        if( $correctans ==$prev_answer ){
            $sql = "UPDATE users SET QuestionID=".($prev_questionID+1)." WHERE TeamName = '".$sess_teamname."' ";
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                die("Querry correct answer failed: " . mysqli_errno($conn));
            }
        }
        else{
            debug_to_console("Wrong Answer");
        }
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
    echo "              <li> <a href='/question.php'>".$sess_teamname."</a> </li> ";
    echo "          </ul>";
    echo "      </div>";
    echo "  </div>";
    echo "</nav>";

    
    //Get Max Question
    $sql = "SELECT * FROM questions";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        die("Querry failed: " . mysqli_errno($conn));
    }
    $question_count = mysqli_num_rows($result)-1;
    
    
    // Display the Question
    $sql = "SELECT * FROM users WHERE TeamName = '".$sess_teamname."' ";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        die("Querry failed: " . mysqli_errno($conn));
    }
    $row = mysqli_fetch_assoc($result);
    $cur_questionID = $row['QuestionID'];
    
    // If all questions answered
    if( $cur_questionID > $question_count ){
        echo "<h2> Congrats </h2> <hr class='heading-underline'>";
        echo "<h3> You have answered all questions right </h3> ";
        echo "<h3> <a href='/leaderboard.php' target='_blank'> Leaderboard </a> </h3> ";
    }
    else{
        echo "<h3> Question ".$cur_questionID." </h3> <hr class='heading-underline'>";
        $sql = "SELECT * FROM questions WHERE QuestionID = ".$cur_questionID." ";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Querry get cur question failed: " . mysqli_errno($conn));
        }
        
        $row = mysqli_fetch_assoc($result);
        $imgurl = $row['ImageURL'];
        echo " <img class='question-img' src='".$imgurl."' >";
        echo "<form id='answer-form' action='question.php' method='post'>";
        echo "<input id='answer-field' class='glowing-border'  name='answer' type='text' placeholder='Answer' >";
        echo "<input type='hidden' name='questionid' value='".$cur_questionID."'>";
        echo "</form>";
    }
    
    mysqli_close($conn); 
?> 
</body>
</html>