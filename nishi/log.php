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
    
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $exists = checkEmailExists($con, $email);

    if ($exists) {
       
        $valid = validateLogin($con, $email, $password);

        if ($valid) {
            // Redirect to index.html page
            echo '<div style="background-color: yellow;border:solid; padding: 20px; text-align: center;">
                  <h1>LOGIN IS SUCCESSFUL..</h1>
                  <p>NOW YOU CAN BOOK YOUR TRIP</p>
                  <button style="height: 50px; width: 100px ;background-color:red;"><a href="booking.html" target="_blank">BOOK NOW</a></button>
                  </div>';
        } else {
            echo '<div style="background-color: lightgreen;border:solid; padding: 20px; text-align: center;">
            <h1>Invalid password !!!...</h1> <br>
            <h3>Please try again</h3>';
        }
    } else {
      echo '<div style="background-color: lightgreen;border:solid; padding: 20px; text-align: center;">
            <h1>Email ID not found !!!..</h1> <br>
            <h3>please register first<h3>';
       
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


function validateLogin($con, $email, $password)
{
    $sql = "SELECT email FROM register1 WHERE email = '$email' AND password = '$password'";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

$con->close();
?>
