<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "onlineclass_forum");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Step 1: Get coding_id from URL
// Get coding_id from URL or POST
if (isset($_GET['id'])) {
    $language_id = intval($_GET['id']);
} elseif (isset($_POST['language_id'])) {
    $language_id = intval($_POST['language_id']);
} else {
    die("No language_id provided");
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
    $lan_image = null;
    if (isset($_FILES['lan_image']) && $_FILES['lan_image']['error'] === UPLOAD_ERR_OK) {
        $lan_image = file_get_contents($_FILES['lan_image']['tmp_name']);
    }

    if ($lan_image !== null) {
        // Update including image
        $sql = "UPDATE language_class_info 
                SET title=?, content=?, type=?, organization=?, level=?, 
                    start_date=?, end_date=?, duration=?, contact_info=?, lan_image=? 
                WHERE language_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", 
            $title, $content, $type, $organization, $level,
            $start_date, $end_date, $duration, $contact_info, $lan_image, $language_id
        );
    } else {
        // Update without touching the image
        $sql = "UPDATE language_class_info 
                SET title=?, content=?, type=?, organization=?, level=?, 
                    start_date=?, end_date=?, duration=?, contact_info=? 
                WHERE language_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", 
            $title, $content, $type, $organization, $level,
            $start_date, $end_date, $duration, $contact_info, $language_id
        );
    }

    if ($stmt->execute()) {
        echo "<script>alert('Post updated successfully'); window.location.href='http://localhost/PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminLanPostView.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
