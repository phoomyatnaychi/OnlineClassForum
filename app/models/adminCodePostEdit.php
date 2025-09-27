<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "onlineclass_forum");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Step 1: Get coding_id from URL
// Get coding_id from URL or POST
if (isset($_GET['id'])) {
    $coding_id = intval($_GET['id']);
} elseif (isset($_POST['coding_id'])) {
    $coding_id = intval($_POST['coding_id']);
} else {
    die("No coding_id provided");
}


   // Step 2: If form submitted -> update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['post-title'];
    $content = $_POST['post-content'];
    $type = $_POST['type'];
    $organization = $_POST['post-organization'];
    $level = $_POST['post-level'];
    $duration = $_POST['post-duration'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $contact_info = $_POST['contact-info'];

    // Handle image (only if a new one is uploaded)
    $coding_image = null;
    if (isset($_FILES['coding_image']) && $_FILES['coding_image']['error'] === UPLOAD_ERR_OK) {
        $coding_image = file_get_contents($_FILES['coding_image']['tmp_name']);
    }

    if ($coding_image !== null) {
        // Update including image
        $sql = "UPDATE coding_class_info 
                SET title=?, content=?, type=?, organization=?, level=?, 
                    start_date=?, end_date=?, duration=?, contact_info=?, coding_image=? 
                WHERE coding_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", 
            $title, $content, $type, $organization, $level,
            $start_date, $end_date, $duration, $contact_info, $coding_image, $coding_id
        );
    } else {
        // Update without touching the image
        $sql = "UPDATE coding_class_info 
                SET title=?, content=?, type=?, organization=?, level=?, 
                    start_date=?, end_date=?, duration=?, contact_info=? 
                WHERE coding_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", 
            $title, $content, $type, $organization, $level,
            $start_date, $end_date, $duration, $contact_info, $coding_id
        );
    }

    if ($stmt->execute()) {
        echo "<script>alert('Post updated successfully'); window.location.href='http://localhost/PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminCodePostView.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
