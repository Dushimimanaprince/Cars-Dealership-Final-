<?php
header('Content-Type: text/html; charset=UTF-8');
// ... rest of your PHP code ...
?>

<?php

// Replace with your Oracle DB credentials
$username = "system";
$password = "prince";
$connection_string = "localhost/prince27555";

// Validate input
if (!isset($_POST['vehicle_id']) || !is_numeric($_POST['vehicle_id'])) {
    die("<p style='color: red; text-align: center;'>Invalid Vehicle ID provided.</p>");
}

$vehicle_id = (int)$_POST['vehicle_id'];

// Connect to Oracle DB
$conn = oci_connect($username, $password, $connection_string);

if (!$conn) {
    $e = oci_error();
    die("<p style='color:red;'>Connection failed: " . $e['message'] . "</p>");
}

// Query
$sql = "
    SELECT 
        c.Name AS Customer_Name,
        ci.Make || ' ' || ci.Model AS Vehicle_Name
    FROM 
        Transactions t
        JOIN Customers c ON t.Customer_ID = c.Customer_ID
        JOIN Cars_Inventory ci ON t.Vehicle_ID = ci.Vehicle_ID
    WHERE 
        t.Vehicle_ID = :vehicle_id";

$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":vehicle_id", $vehicle_id);
oci_execute($stid);

// Output
echo "<!DOCTYPE html>
<html>
<head>
    <title>Results - Dark Mode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            padding: 40px;
            text-align: center;
        }
        table {
            margin: auto;
            width: 60%;
            border-collapse: collapse;
            background-color: #1e1e1e;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
        }
        th, td {
            border: 1px solid #333;
            padding: 12px;
        }
        th {
            background-color: #333;
            color: #ffffff;
        }
        td {
            background-color: #2a2a2a;
        }
        a {
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Results for Vehicle ID: $vehicle_id</h2>
    <table>
        <tr>
            <th>Customer Name</th>
            <th>Vehicle</th>
        </tr>";

$rows_found = false;
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    $rows_found = true;
    echo "<tr>
            <td>" . htmlspecialchars($row['CUSTOMER_NAME']) . "</td>
            <td>" . htmlspecialchars($row['VEHICLE_NAME']) . "</td>
          </tr>";
}

if (!$rows_found) {
    echo "<tr><td colspan='2'>No customers found for this Vehicle ID 🥵.</td></tr>";
}

echo "</table>
    <div style='margin-top: 30px;'>
        <a href='review.html' style='color: #4caf50; text-decoration: none;'>🔙 Search Again</a>
    </div>
    <div style='margin-top: 20px;'>
        <a href='homep.html'>
            <button style='padding: 10px 20px; background-color: #4caf50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;'>
                ➕ Go to Home Page
            </button>
        </a>
    </div>
</body>
</html>";

oci_free_statement($stid);
oci_close($conn);
?>
