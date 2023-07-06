<?php
$insert = false;

$server = "localhost";
$username = "root";
$password="";
$dbname = "book";

$con = mysqli_connect($server, $username, $password,$dbname);

if (!$con) {
    die("Connection to this database failed due to " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $adhar = $_POST['adhar'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $arrivedate = $_POST['arrivedate'];
    $departdate = $_POST['departdate'];
    $member = $_POST['member'];
    $package = $_POST['package'];

    $sql = "INSERT INTO `booking` (`name`, `adhar`, `gender`, `address`, `pincode`, `mobileno`, `email`, `arrivedate`, `departdate`, `member`, `package`) VALUES ('$name', '$adhar', '$gender', '$address', '$pincode', '$mobileno', '$email', '$arrivedate', '$departdate', '$member', '$package')";

    if ($con->query($sql) == true) {
        $insert = true;
        echo '<div style="background-color: yellow;border:solid; padding: 20px; text-align: center;">
        <h1> CONGRATULATIONS...!!..ENJOY YOUR TRIP..!!..</h1>
        <button style="height: 50px; width: 100px ;background-color:red;"><a href="index.html" target="_blank">HOME PAGE </a></button>
        </div>';
    } 
    else {
        echo "ERROR: " . $con->error;
    }

    $con->close();
}
?>


