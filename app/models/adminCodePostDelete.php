<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "onlineclass_forum");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make sure ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request");
}

$coding_id = intval($_GET['id']);

// Delete the record
$sql = "DELETE FROM coding_class_info WHERE coding_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $coding_id);

if ($stmt->execute()) {
    // Redirect back to posts page with success message
    echo "<script>alert('Post deleted successfully'); window.location.href='../../views/admin/adminCodePostView.php';</script>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
