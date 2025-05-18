<?php
header("Access-Control-Allow-Origin: *"); // for development
header("Content-Type: application/json");

include("includes/dbManager.php");
$conn = getConnection();
$result = $conn->query("SELECT * FROM Employees");

$products = [];
while($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);

?>
