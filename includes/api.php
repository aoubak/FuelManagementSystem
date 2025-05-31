<?php
// api.php - This file will handle AJAX requests for customers

include("./dbManager.php"); // Make sure this path is correct for your setup
$conn = getConnection(); // Get the database connection from dbManager.php

// Check if connection failed
if (!$conn) {
    header('Content-Type: application/json'); // Tell browser to expect JSON
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit; // Stop script execution
}

header('Content-Type: application/json'); // Set header for JSON response for all actions that follow


// --- Action: Get All Customers (for populating the dropdown) ---
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getCustomers') {
    // Assuming your customer table has CustomerID and CustomerName
    $sql = "SELECT customer_id, first_name FROM customers ORDER BY first_name ASC";
    $result = mysqli_query($conn, $sql);

    $customers = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = [
                'id' => $row['customer_id'],
                'name' => $row['first_name']
            ];
        }
        echo json_encode($customers); // Send customer data as JSON
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch customers: ' . mysqli_error($conn)]);
    }
    exit; // Stop execution after sending JSON
}

// --- Action: Add New Customer ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addNewCustomer') {
    $customerName = $_POST['customerName'] ?? '';
    $customerEmail = $_POST['customerEmail'] ?? '';
    $customerPhone = $_POST['customerPhone'] ?? '';

    if (empty($customerName)) {
        echo json_encode(['success' => false, 'message' => 'Customer name is required.']);
        exit;
    }

    // PREPARED STATEMENT FOR SECURITY! Prevents SQL Injection.
    $stmt = $conn->prepare("INSERT INTO customers (first_name, email, phone) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $customerName, $customerEmail, $customerPhone); // 'sss' means three string parameters
        if ($stmt->execute()) {
            $newCustomerId = $stmt->insert_id; // Get the ID of the newly inserted customer
            echo json_encode(['success' => true, 'customerId' => $newCustomerId, 'customerName' => $customerName, 'message' => 'Customer added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add customer: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . $conn->error]);
    }
    exit;
}

// Default response if no action matches (put this at the very end of api.php)
echo json_encode(['success' => false, 'message' => 'Invalid API request or missing action.']);













?>