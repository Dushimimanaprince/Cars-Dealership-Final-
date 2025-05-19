<?php
$conn = oci_connect("system", "prince", "//localhost:1521/prince27555");

$sql = "SELECT Username FROM Employees_Login";
$stid = oci_parse($conn, $sql);
oci_execute($stid);

echo "<h3>Registered Usernames:</h3>";
while ($row = oci_fetch_assoc($stid)) {
    echo htmlspecialchars($row['USERNAME']) . "<br>";
}

oci_free_statement($stid);
oci_close($conn);
?>
