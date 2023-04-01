<?php
// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

// Connect to the MySQL database
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'webshop_db';

// Check if the form data matches the regular expression patterns
if(!preg_match("/^[A-Za-z]+$/", $name)) {
    // If the name field fails to match the pattern, display an error message
    echo "Invalid name format.";
} else if(!preg_match("/^[0-9]{8}$/", $phone)) {
    // If the phone field fails to match the pattern, display an error message
    echo "Invalid phone number format.";
} else if(!preg_match("/^[A-Za-z0-9 ,]+$/", $address)) {
    // If the address field fails to match the pattern, display an error message
    echo "Invalid address format.";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // If the email field fails to match the pattern, display an error message
    echo "Invalid email format.";
} else {

$connection = new mysqli($servername, $username, $password, $database);

// Check if the email already exists in the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($connection, $sql);

}

if(mysqli_num_rows($result) > 0) {
    // If the email already exists, display an error message
    echo "This email is already registered.";
} else {
    // If the email does not exist, insert the user data into the database
    $sql = "INSERT INTO users (name, email, phone, address, password) VALUES ('$name', '$email', '$phone', '$address', '$password')";
    mysqli_query($connection, $sql);

    // Display a success message
    echo "Registration successful.";
}

// Close the database connection
mysqli_close($connection);
?>