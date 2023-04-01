<?php
// Start a session
session_start();

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Connect to the MySQL database
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'webshop_db';

$connection = new mysqli($servername, $username, $password, $database);

// Check if the user exists in the database
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result) == 1) {
    // If the user exists, retrieve the is_admin value from the database
    $user = mysqli_fetch_assoc($result);
    $is_admin = $user['is_admin'];
    $_SESSION['email'] = $user['email'];
    
    if($is_admin == 1) {
        // If the user is an admin, set a session variable and redirect to the administrator page
        $_SESSION['admin'] = true;
        header("Location: administrator.php");
        exit();
    } else {
        // If the user is not an admin, redirect to the dashboard page
        header("Location: index.php");
        exit();
    }
} else {
    // If the user does not exist, display an error message
    echo "Invalid email or password.";
}


// Close the database connection
mysqli_close($connection);
?>