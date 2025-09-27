<?php
// Connect to database
$db_server = "localhost:3306";
$db_user = "root";
$db_pass = "";
$db_name = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $type = $_POST['type'];
    $organization = $_POST['organization'];
    $level = $_POST['level'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $contact_info = $_POST['contact'];

    
    // Ensure $studentCard is at least an empty string if no file uploaded
    $coding_image = isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['file-upload']['tmp_name'])
    : "";

    // Insert into database using class_duration function
    $sql = "INSERT INTO coding_class_info (title, content, type, organization, level, start_date, end_date, contact_info, coding_image, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $title, $content, $type, $organization, $level, $start_date, $end_date, $contact_info, $coding_image);

    if (!empty($coding_image)) {
        $stmt->send_long_data(8, $coding_image); // index 8 = coding_image
    }

    if ($stmt->execute()) {
        echo "<p>Post created successfully!</p>";
        header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminCodePostView.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
