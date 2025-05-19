<?php
// view.php

$conn = oci_connect('system', 'prince', 'localhost/prince27555');
if (!$conn) {
    $e = oci_error();
    die('Connection failed: ' . $e['message']);
}

$query = "
    SELECT 
        cs.vehicle_id,
        cs.model,
        cs.available_stock,
        cs.sold_stock,
        ci.price,
        (cs.sold_stock * ci.price) AS balance
    FROM car_stock cs
    JOIN cars_inventory ci ON cs.vehicle_id = ci.vehicle_id
    ORDER BY cs.vehicle_id
";

$stid = oci_parse($conn, $query);
oci_execute($stid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Stock Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e272e;
            color: #f5f6fa;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #f5f6fa;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #2f3640;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #57606f;
            text-align: center;
        }

        th {
            background-color: #40739e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #353b48;
        }

        tr:hover {
            background-color: #57606f;
        }
        

        .back-btn {
            display: block;
            text-align: center;
            margin: 50px auto;
            padding: 10px 20px;
            background-color: #44bd32;
            color: white;
            text-decoration: none;
            border-radius: 15px;
        }

        .back-btn:hover {
            background-color: #4cd137;
        }
    </style>
</head>
<body>

<h2>Car Stock Status</h2>

<table>
    <tr>
        <th>Vehicle ID</th>
        <th>Model</th>
        <th>Available Stock</th>
        <th>Sold Stock</th>
        <th>Price</th>
        <th>Balance (Sold × Price)</th>
    </tr>

    <?php while ($row = oci_fetch_assoc($stid)): ?>
        <tr>
            <td><?= htmlspecialchars($row['VEHICLE_ID']) ?></td>
            <td><?= htmlspecialchars($row['MODEL']) ?></td>
            <td><?= htmlspecialchars($row['AVAILABLE_STOCK']) ?></td>
            <td><?= htmlspecialchars($row['SOLD_STOCK']) ?></td>
            <td>$<?= number_format($row['PRICE'], 2) ?></td>
            <td>$<?= number_format($row['BALANCE'], 2) ?></td>
        </tr>
    <?php endwhile; ?>

</table>

<a class="back-btn" href="insert_all.html">⬅ Back to Main Page</a>

</body>
</html>

<?php
oci_free_statement($stid);
oci_close($conn);
?>
