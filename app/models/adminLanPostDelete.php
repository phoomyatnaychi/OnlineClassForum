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

$language_id = intval($_GET['id']);

// Delete the record
$sql = "DELETE FROM language_class_info WHERE language_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $language_id);

if ($stmt->execute()) {
    // Redirect back to posts page with success message
    echo "<script>alert('Post deleted successfully'); window.location.href='../../views/admin/adminLanPostView.php';</script>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
