<?php
$conn = oci_connect('system', 'prince', 'localhost/prince27555'); // update with your credentials

if (!$conn) {
    $e = oci_error();
    die("Connection failed: " . htmlentities($e['message'], ENT_QUOTES));
}

$sql = "SELECT 
            audit_id,
            table_name,
            operation,
            changed_by,
            TO_CHAR(change_timestamp, 'YYYY-MM-DD HH24:MI:SS') AS change_time,
            new_value
        FROM audit_log
        ORDER BY audit_id DESC";

$stid = oci_parse($conn, $sql);
oci_execute($stid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audit Log Viewer</title>
    <style>
        body {
            background-color: #1e272e;
            color: #f5f6fa;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            padding: 20px;
        }

        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #2f3640;
            color: #f5f6fa;
        }

        th, td {
            padding: 10px;
            border: 1px solid #57606f;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #40739e;
        }

        tr:hover {
            background-color: #353b48;
        }

        .scroll-box {
            max-height: 400px;
            overflow-y: auto;
            margin: 0 auto;
            width: 95%;
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #44bd32;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            width: fit-content;
        }

        .back-button:hover {
            background-color: #4cd137;
        }
    </style>
</head>
<body>

<h2>Audit Log Records</h2>

<div class="scroll-box">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Table</th>
                <th>Operation</th>
                <th>Changed By</th>
                <th>Time</th>
                <th>New Value</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = oci_fetch_assoc($stid)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['AUDIT_ID']) ?></td>
                    <td><?= htmlspecialchars($row['TABLE_NAME']) ?></td>
                    <td><?= htmlspecialchars($row['OPERATION']) ?></td>
                    <td><?= htmlspecialchars($row['CHANGED_BY']) ?></td>
                    <td><?= htmlspecialchars($row['CHANGE_TIME']) ?></td>
                    <td><pre><?= htmlspecialchars(is_object($row['NEW_VALUE']) ? $row['NEW_VALUE']->read($row['NEW_VALUE']->size()) : $row['NEW_VALUE']) ?></pre></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<a href="homep.html" class="back-button">Back to Home</a>

</body>
</html>

<?php
oci_free_statement($stid);
oci_close($conn);
?>
