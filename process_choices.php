<?php
// Database connection parameters
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
if (isset($_POST['breakfast'], $_POST['lunch'], $_POST['dinner'])) {
    // Retrieve form data
    $breakfast = $_POST['breakfast'];
    $lunch = $_POST['lunch'];
    $dinner = $_POST['dinner'];

    // Fetch username from users table
    $username = "SELECT username FROM users";
    $result = $conn->query($username);

    if ($result->num_rows > 0) {
        // Fetch the first username (you may need to adjust this if you have multiple users)
        $row = $result->fetch_assoc();
        $username = $row['username'];

        // Check if the user has already made a choice for each meal type today
        $existing_choices_query = "SELECT * FROM user_choices WHERE username='$username' AND chosen_date=CURDATE()";
        $result = $conn->query($existing_choices_query);

        // Check if there are existing choices
        if ($result->num_rows > 0) {
            echo "You have already made choices for today. You cannot make further changes.";
        } else {
            // Insert user's choices into the user_choices table
            $insert_choices_query = "INSERT INTO user_choices (username, meal_type, chosen_dish, chosen_date) VALUES ";
            $insert_choices_query .= "('$username', 'Breakfast', '$breakfast', CURDATE()), ";
            $insert_choices_query .= "('$username', 'Lunch', '$lunch', CURDATE()), ";
            $insert_choices_query .= "('$username', 'Dinner', '$dinner', CURDATE())";

            if ($conn->query($insert_choices_query) === TRUE) {
                echo "User choices saved successfully.";
            } else {
                echo "Error: " . $insert_choices_query . "<br>" . $conn->error;
            }
        }
    } else {
        echo "No users found in the database.";
    }
} else {
    echo "Form data is missing!";
}

// Close connection
$conn->close();
?>
