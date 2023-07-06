<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = false;
    
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    
    
    $exists = checkEmailExists($con, $email);

    if ($password == $rpassword && !$exists) {
        $sql = "INSERT INTO `register1` (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = $con->query($sql);

        if ($result) {
            $err = true;
            echo '<div style="background-color: yellow;border:solid; padding: 20px; text-align: center;">
                  <h1>REGISTRATION IS SUCCESSFUL....</h1>
                  <p>NOW YOU CAN BOOK YOUR TRIP</p>
                  <button style="height: 50px; width: 100px ;background-color:red;"><a href="booking.html" target="_blank">BOOK NOW</a></button>
                  </div>';
            // echo "REGISTRATION IS SUCCESSFUL!<br><br><br><br>";
            // echo "NOW YOU CAN BOOK YOUR TRIP  .....<br><br>";
            // echo'<button style="height:50px;width:100px"><a href = "booking.html"target="_blank">BOOK NOW</a></button>';
           
        }
        
        else {
            echo "Error: " . $con->error;
        }
    } elseif ($password != $rpassword) {
        echo '<div style="background-color: lightgreen;border:solid; padding: 20px; text-align: center;">
        <h1>Password does not match !!....</h1><br>
              <p>Please try again</p>';
    } elseif ($exists) {
        echo '<div style="background-color: lightgreen;border:solid; padding: 20px; text-align: center;">
                  <h1>SORRY! Email ID already exists..</h1>';
        
    }
}

function checkEmailExists($con, $email)
{
    $sql = "SELECT email FROM register1 WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

$con->close();
?>


