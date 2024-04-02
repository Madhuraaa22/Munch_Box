<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "menu_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set and not empty
if(isset($_POST['username'], $_POST['password'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user from database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { // If user exists
        // Set session variables to mark user as logged in
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;

        // Redirect user to dashboard or any other page after successful login
        header("Location: http://localhost/feedback/main.html?username=" . urlencode($username)); // Pass the username as a parameter in the URL
        exit(); // Ensure script execution stops after redirection
    } else {
        echo "Invalid username or password"; // Display error message if login fails
    }
} else {
    echo "Form data is missing!"; // Display error if form data is incomplete
}

// Close connection
$conn->close();
?>

