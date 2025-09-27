<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "onlineclass_forum");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get coding_id from URL
if (isset($_GET['id'])) {
    $coding_id = intval($_GET['id']);

    // Fetch post by coding_id
    $stmt = $conn->prepare("SELECT * FROM coding_class_info WHERE coding_id = ?");
    $stmt->bind_param("i", $coding_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if (!$post) {
        die("Post not found.");
    }
} else {
    die("No post specified.");
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Panel - Edit Post</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<style type="text/tailwindcss">
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen bg-gray-100">
<!-- Sidebar start-->
  <aside class="w-64 bg-white shadow-md flex flex-col">
      <div class="flex items-center justify-center h-16 bg-white border-b">
          <span class="material-icons text-orange-600 text-3xl">school</span>
          <h1 class="text-xl font-bold ml-2">CourseForum</h1>
      </div>
      <nav class="flex-1 px-4 py-4 space-y-2">
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminUserPanel.php">
              <span class="material-icons">group</span>
              <span class="ml-3">Users</span>
          </a>
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 bg-gray-200 rounded-md" href="adminCodePostView.php">
              <span class="material-icons">code</span>
              <span class="ml-3">Coding Classes</span>
          </a>
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminLanPostView.php">
              <span class="material-icons">language</span>
              <span class="ml-3">Language Classes</span>
          </a>
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminSuggestion.php">
              <span class="material-icons">lightbulb</span>
              <span class="ml-3">Suggestions</span>
          </a>
      </nav>
      <div class="px-4 py-4 border-t">
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminLogout.php">
              <span class="material-icons">logout</span>
              <span class="ml-3">Logout</span>
          </a>
      </div>
  </aside>
  <!-- Sidebar end-->
<div class="flex-1 flex flex-col overflow-hidden">
<header class="flex items-center justify-between p-4 bg-white border-b">
    <div class="flex items-center">
        <button onclick="window.location.href='http://localhost/PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminCodePostView.php'" 
            class="text-gray-600 hover:text-orange-500 mr-4">
            <span class="material-icons">arrow_back</span>
        </button>
        <h2 class="text-2xl font-semibold text-gray-800">Edit Post</h2>
    </div>
<div class="flex items-center space-x-4">

<div class="relative">
<img alt="User avatar" class="w-10 h-10 rounded-full cursor-pointer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1HLPM2pWMZwVF7rAP0MwtFHcq9PDbvbq-xO0T2cV2Qs5P-Ak5oE-_scg6WCY6oj4Nq9YIU2rCYS2hkpPe50ze2T4StMMQ17kX20RuNdPqrHLuPWKQOB-W4nFqTzSDMwgNHjavx4aV1wVfpCryVSGyVhfVWbJCUzigBoMc6ttDGTWusoMvn3MXAcN49KJqtm4bd2zW_fy73OLhRADRjmoxjjIhW41PW9rDpL3FftXMJwxjgj3V7_IvZdZ8qOj8Bn4SNMo3Hqu0hgc"/>
</div>
</div>
</header>
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
<div class="bg-white p-8 rounded-lg shadow-md">
<form class="space-y-6" action="../../app/models/adminCodePostEdit.php" method="POST" enctype="multipart/form-data">
    <!-- hidden id so PHP knows which record to update -->
    <input type="hidden" name="coding_id" value="<?php echo $post['coding_id']; ?>">

    <div>
        <label class="block text-sm font-medium text-gray-700" for="post-title">Title</label>
        <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
               id="post-title" 
               name="post-title" 
               type="text" 
               value="<?php echo htmlspecialchars($post['title']); ?>"/>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700" for="post-content">Content</label>
        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                  id="post-content" 
                  name="post-content" 
                  rows="4"><?php echo htmlspecialchars($post['content']); ?></textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700" for="type">Language</label>
            <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                   id="type" 
                   name="type" 
                   type="text" 
                   value="<?php echo htmlspecialchars($post['type']); ?>"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700" for="post-organization">Organization</label>
            <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                   id="post-organization" 
                   name="post-organization" 
                   type="text" 
                   value="<?php echo htmlspecialchars($post['organization']); ?>"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700" for="post-level">Level</label>
            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                    id="post-level" 
                    name="post-level">
                <option value="beginner" <?php if($post['level']=="beginner") echo "selected"; ?>>Beginner</option>
                <option value="intermediate" <?php if($post['level']=="intermediate") echo "selected"; ?>>Intermediate</option>
                <option value="advanced" <?php if($post['level']=="advanced") echo "selected"; ?>>Advanced</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700" for="post-duration">Duration</label>
            <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                   id="post-duration" 
                   name="post-duration" 
                   type="text" 
                   value="<?php echo htmlspecialchars($post['duration']); ?>"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700" for="start-date">Start Date</label>
            <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                   id="start-date" 
                   name="start-date" 
                   type="date" 
                   value="<?php echo $post['start_date']; ?>"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700" for="end-date">End Date</label>
            <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                   id="end-date" 
                   name="end-date" 
                   type="date" 
                   value="<?php echo $post['end_date']; ?>"/>
        </div>
    </div>

    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">Contact Information</h4>
        <div class="space-y-4">
            <div class="flex items-center">
                <span class="material-icons mr-3 text-gray-500">person</span>
                <input class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" 
                       name="contact-info" 
                       type="text" 
                       value="<?php echo htmlspecialchars($post['contact_info']); ?>"/>
            </div>
        </div>
    </div>

    <!-- Image upload -->
    <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>

    <!-- Show image if it already exists in DB -->
    <?php if(!empty($post['coding_image'])): ?>
        <img id="preview" 
             src="data:image/jpeg;base64,<?php echo base64_encode($post['coding_image']); ?>" 
             alt="Class Image" 
             class="w-48 h-32 object-cover rounded-lg mb-3">
    <?php else: ?>
        <img id="preview" 
             src="#" 
             alt="No Image" 
             class="w-48 h-32 object-cover rounded-lg mb-3 hidden">
    <?php endif; ?>

    <input type="file" name="coding_image" id="coding_image"
           accept="image/*"
           class="block w-full text-sm text-gray-500 
                  file:mr-4 file:py-2 file:px-4 
                  file:rounded-md file:border-0 
                  file:text-sm file:font-semibold 
                  file:bg-orange-50 file:text-orange-700 
                  hover:file:bg-orange-100">
    </div>


    <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 flex items-center" type="submit">
        <span class="material-icons mr-2">save</span> Save Changes
    </button>
</form>

</div>
</main>
</div>
</div>

<!-- JS for live preview -->
<script>
document.getElementById("coding_image").addEventListener("change", function(event) {
    const preview = document.getElementById("preview");
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove("hidden"); // show preview
        }
        reader.readAsDataURL(file);
    }
});
</script>
</body></html>