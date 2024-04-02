<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "dbfeedback";

//create connection

$conn = mysqli_connect($servername,$username,$password,$database);

//check connection
if($conn->connect_error){
    die("Connection failed:" .$conn->connect_error);
}
else{
    echo "Connection was successful";
}

//creare the table in the database
$sql = "CREATE TABLE hostel_feedback (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Date DATE,
        Breakfast VARCHAR(50),
        Lunch VARCHAR(50),
        Dinner VARCHAR(50),
        FoodName VARCHAR(100),
        FoodQuality VARCHAR(10),
        FoodTaste VARCHAR(10),
        Hygiene VARCHAR(10),
        Feedback TEXT
)";
$result = mysqli_query($conn, $sql);


//check for the table creation success
if($result){
    echo "the table was created successfully!<br>";
}
else{
    echo "the table was not created successfully because of this error --->" . mysqli_error($conn);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Date = $_POST['date'];
    $Breakfast = isset($_POST['c1']) ? $_POST['c1'] : '';
    $Lunch = isset($_POST['c2']) ? $_POST['c2'] : '';
    $Dinner = isset($_POST['c3']) ? $_POST['c3'] : '';
    $FoodName = $_POST['name'];
    $FoodQuality = $_POST['FoodQuality'];
    $FoodTaste = $_POST['FoodTaste'];
    $Hygiene = $_POST['Hygiene'];
    $Feedback = $_POST['Feedback'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO hostel_feedback (Date, Breakfast, Lunch, Dinner, FoodName, FoodQuality, FoodTaste, Hygiene, Feedback) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $Date, $Breakfast, $Lunch, $Dinner, $FoodName, $FoodQuality, $FoodTaste, $Hygiene, $Feedback);

    // Execute statement
    if ($stmt->execute()) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
