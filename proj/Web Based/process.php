<?php
header('Content-Type: text/html; charset=UTF-8');

// Oracle DB credentials
$username = "system";
$password = "prince";
$connection_string = "localhost/prince27555";

// Input validation
if (
    !isset($_POST['customer_id']) ||
    !isset($_POST['vehicle_id']) ||
    !isset($_POST['sale_date'])
) {
    die("<p style='color: red; text-align: center;'>Missing input data.</p>");
}

$customer_id = (int)$_POST['customer_id'];
$vehicle_id  = (int)$_POST['vehicle_id'];
$sale_date   = $_POST['sale_date'];  // Expecting YYYY-MM-DD

// Connect to Oracle
$conn = oci_connect($username, $password, $connection_string);
if (!$conn) {
    $e = oci_error();
    die("<p style='color:red;'>❌ Connection failed: " . $e['message'] . "</p>");
}

// Prepare procedure call
$stid = oci_parse($conn, "BEGIN Process_Car_Sale(:cust_id, :veh_id, TO_DATE(:sale_date, 'YYYY-MM-DD')); END;");
oci_bind_by_name($stid, ":cust_id", $customer_id);
oci_bind_by_name($stid, ":veh_id", $vehicle_id);
oci_bind_by_name($stid, ":sale_date", $sale_date);

// Execute
$success = oci_execute($stid);

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Sale Result</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        .message {
            background-color: #1e1e1e;
            border: 1px solid #333;
            padding: 30px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(255,255,255,0.05);
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class='message'>";

if ($success) {
    echo "<h2>✅ Car sale processed successfully!</h2>";
} else {
    $e = oci_error($stid);
    echo "<h2>❌ Failed to process sale</h2>";
    echo "<p>" . htmlentities($e['message']) . "</p>";
}

echo "</table>
    <div style='margin-top: 30px;'>
        <a href='process.html' style='color: #4caf50; text-decoration: none;'>🔙 Process Again</a>
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
