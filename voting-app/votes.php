<?php
$servername = "localhost";
$username = "ceiscy_4102010423_dbuser";
$password = "ttJPjGw%(H5D";
$dbname = "ceiscy_4102010423_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["candidate"]) && !empty($_POST["candidate"])) {
        $candidate = trim($_POST["candidate"]); // Sanitize input

        // Check if the candidate exists in the database
        $sql = "SELECT vote_count FROM votes WHERE candidate = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $candidate);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Candidate exists, update vote count
            $sql = "UPDATE votes SET vote_count = vote_count + 1 WHERE candidate = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $candidate);
        } else {
            // Candidate does not exist, insert a new vote record
            $sql = "INSERT INTO votes (candidate, vote_count) VALUES (?, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $candidate);
        }

        if ($stmt->execute()) {
            // Redirect to success page
            header("Location: success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: No Candidate Selected";
    }
} else {
    echo "Invalid Request!";
}


$conn->close();
?>
