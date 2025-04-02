<?php
header('Content-Type: application/json'); // Set header to return JSON

$servername = "localhost";
$username = "ceiscy_4102010423_dbuser";
$password = "ttJPjGw%(H5D";
$dbname = "ceiscy_4102010423_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch vote data
$sql = "SELECT candidate, vote_count FROM votes ORDER BY vote_count DESC";
$result = $conn->query($sql);

$candidates = [];
$votes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row['candidate'];
        $votes[] = (int)$row['vote_count']; // Ensure votes are integers
    }
}

// Send data as JSON
echo json_encode(["candidate" => $candidates, "votes" => $votes]);

$conn->close();
?>
