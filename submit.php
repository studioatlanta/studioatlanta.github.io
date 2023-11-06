<?php
// Database credentials
$servername = "sql.freedb.tech";
$username = "freedb_studioatlanta";
$password = "@2WytgZ!jM$PG2!";
$dbname = "freedb_my_passwords";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredPassword = $_POST['password'];

    // Retrieve the stored password from the database
    $sql = "SELECT password FROM passwords WHERE id = 1"; // You might need to adjust the SQL query based on your data structure.
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if ($enteredPassword === $storedPassword) {
            // Passwords match, redirect to models.html
            header("Location: models.html");
            exit;
      } else {
    // Incorrect password, redirect to error.html
    header("Location: error.html");
    exit; // Make sure to exit to prevent further script execution
}

    } else {
        // Password not found in the database, handle this case accordingly
        echo "Password not found in the database.";
    }
}

// Close the database connection
$conn->close();
?>
