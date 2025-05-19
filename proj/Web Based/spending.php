<?php
header('Content-Type: text/html; charset=UTF-8');

// Oracle DB credentials
$username = "system";
$password = "prince";
$connection_string = "localhost/prince27555";

if (!isset($_POST['customer_id']) || !is_numeric($_POST['customer_id'])) {
    die("<p style='color: red; text-align: center;'>❌ Invalid Customer ID.</p>");
}

$customer_id = (int)$_POST['customer_id'];

// Connect to Oracle
$conn = oci_connect($username, $password, $connection_string);
if (!$conn) {
    $e = oci_error();
    die("<p style='color: red; text-align: center;'>❌ Connection failed: " . $e['message'] . "</p>");
}

// Call the function
$sql = "BEGIN :result := Get_Total_Spent_By_Customer(:cust_id); END;";
$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid, ":cust_id", $customer_id);
oci_bind_by_name($stid, ":result", $total_spent, 20);  // Bind result

oci_execute($stid);

// Output page
echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Customer Spending Result</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        .result-box {
            background-color: #1e1e1e;
            border: 1px solid #333;
            padding: 30px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
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
    <div class='result-box'>
        <h2>🧾 Customer ID: $customer_id</h2>
        <h3>Total Spent: $" . number_format($total_spent, 2) . "</h3>
        <a href='spending.html'>🔙 Check Another</a>
        <a href='homep.html'>🔙 Back To Home</a>
    </div>
</body>
</html>";

oci_free_statement($stid);
oci_close($conn);
?>
