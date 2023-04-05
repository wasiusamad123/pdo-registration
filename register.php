<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>
    <h1>Registration Page</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>

<?php
// Set database connection parameters
$host = "localhost";
$dbname = "mydatabase";
$username = "myusername";
$password = "mypassword";

// Connect to the database using PDO
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement for insertion
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

    // Bind parameters to SQL statement
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    // Execute SQL statement
    try {
        $stmt->execute();
        echo "Record inserted successfully.";
    } catch(PDOException $e) {
        echo "Error inserting record: " . $e->getMessage();
    }
}
?>
