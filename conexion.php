<?php
// Server and database connection configuration
$serverName = "localhost"; // Change this to your server name if different
$connectionOptions = array(
    "Database" => "WEBB",         // Database name
    "TrustServerCertificate" => true // Trust the server certificate
);

// Establishing the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Checking the connection
if ($conn === false) {
    // Display detailed error information
    die("Connection error: " . print_r(sqlsrv_errors(), true));
} else {
    echo "Connection established successfully.";
}

// Close the connection (optional, as it will close when the script ends)

?>
