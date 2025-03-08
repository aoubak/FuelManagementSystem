<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];

  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jsvalid";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "New record created successfully";
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $conn = null; 
}
?>