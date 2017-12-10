<?php
        session_start();    

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
        
        
        $servername = "127.0.0.1";
        $username = "boland316";
        $password = "";
        $dbname = "Events";
        
        $_POST['usr'];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        
        $sql = "SELECT `duration`, `title` FROM `events` WHERE 1";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
        // output data of each row
            $data =  mysqli_fetch_all($result);
            echo json_encode($data);
        }
        else{
            echo "problems";
        }
        $conn->close();



?>
        