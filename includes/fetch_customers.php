<?php
include("./dbManager.php"); // Include your database configuration file
$conn = getConnection(); // Get the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$term = $_GET['term'] ?? '';
$sql = "SELECT customer_id, first_name FROM customers WHERE first_name LIKE ?";
$stmt = $conn->prepare($sql);
$term = "%$term%";
$stmt->bind_param("s", $term);
$stmt->execute();
$res = $stmt->get_result();
$data = [];
while ($row = $res->fetch_assoc()) {
  $data[] = $row;
}
echo json_encode($data);
?>
