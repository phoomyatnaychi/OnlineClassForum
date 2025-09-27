<?php
// coding_post_detail.php

// Database connection
$conn = new mysqli("localhost", "root", "", "onlineclass_forum");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get coding_id from URL
if (isset($_GET['id'])) {
    $language_id = intval($_GET['id']);

    // Fetch post by coding_id
    $stmt = $conn->prepare("SELECT * FROM language_class_info WHERE language_id = ?");
    $stmt->bind_param("i", $language_id);
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
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Panel - Post Detail</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<style type="text/tailwindcss">
body { font-family: 'Inter', sans-serif; background-color: #f0f2f5; }
</style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen bg-gray-100">
     <!-- Sidebar start-->
  <aside class="w-64 bg-white shadow-md flex flex-col">
      <div class="flex items-center justify-center h-16 bg-white border-b">
          <span class="material-icons text-orange-600 text-3xl">school</span>
          <h1 class="text-xl font-bold ml-2">YouthGuide</h1>
      </div>
      <nav class="flex-1 px-4 py-4 space-y-2">
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminUserPanel.php">
              <span class="material-icons">group</span>
              <span class="ml-3">Users</span>
          </a>
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminCodePostView.php">
              <span class="material-icons">code</span>
              <span class="ml-3">Coding Classes</span>
          </a>
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 bg-gray-200 rounded-md" href="adminLanPostView.php">
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
    
    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="flex items-center justify-between p-4 bg-white border-b">
            <div class="flex items-center">
                <a href="adminLanPostView.php" class="text-gray-600 hover:bg-gray-100 p-2 rounded-full mr-2">
                    <span class="material-icons">arrow_back</span>
                </a>
                <h2 class="text-2xl font-semibold text-gray-800">Post Details</h2>
            </div>
            <div class="flex items-center space-x-4">
                <a href="adminLanPostEdit.php?id=<?= $post['language_id'] ?>" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 flex items-center">
                <span class="material-icons mr-2">edit</span> Edit Post
                </a>

                <a href="../../app/models/adminLanPostDelete.php?id=<?= $post['language_id'] ?>" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 flex items-center"
               onclick="return confirm('Are you sure you want to delete this post?');">
                <span class="material-icons mr-2">delete</span> Delete Post
                </a>
                 
                <div class="relative">
                <img alt="User avatar" class="w-10 h-10 rounded-full cursor-pointer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1HLPM2pWMZwVF7rAP0MwtFHcq9PDbvbq-xO0T2cV2Qs5P-Ak5oE-_scg6WCY6oj4Nq9YIU2rCYS2hkpPe50ze2T4StMMQ17kX20RuNdPqrHLuPWKQOB-W4nFqTzSDMwgNHjavx4aV1wVfpCryVSGyVhfVWbJCUzigBoMc6ttDGTWusoMvn3MXAcN49KJqtm4bd2zW_fy73OLhRADRjmoxjjIhW41PW9rDpL3FftXMJwxjgj3V7_IvZdZ8qOj8Bn4SNMo3Hqu0hgc"/>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($post['title']) ?></h3>
                        <p class="text-gray-600 mb-6"><?= nl2br(htmlspecialchars($post['content'])) ?></p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Type</h4>
                                <p class="text-lg text-gray-800"><?= htmlspecialchars($post['type']) ?></p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Organization</h4>
                                <p class="text-lg text-gray-800"><?= htmlspecialchars($post['organization']) ?></p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Level</h4>
                                <p class="text-lg text-gray-800"><?= htmlspecialchars($post['level']) ?></p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Duration</h4>
                                <p class="text-lg text-gray-800"><?= htmlspecialchars($post['duration']) ?> Days</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Start Date</h4>
                                <p class="text-lg text-gray-800"><?= date('M d, Y', strtotime($post['start_date'])) ?></p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">End Date</h4>
                                <p class="text-lg text-gray-800"><?= date('M d, Y', strtotime($post['end_date'])) ?></p>
                            </div>
                        </div>

                        <div class="border-t pt-6">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Contact Information</h4>
                            <div class="flex items-center text-gray-800 mb-2">
                                <span class="material-icons mr-3 text-gray-500">person</span>
                                <p><?= htmlspecialchars($post['contact_info']) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Uploaded Image</h4>
                        <?php if(!empty($post['lan_image'])): ?>
                            <img class="w-full h-64 object-cover rounded-lg shadow-sm" 
                                 src="data:image/jpeg;base64,<?= base64_encode($post['lan_image']); ?>" 
                                 alt="Class Image"/>
                        <?php else: ?>
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="material-icons text-gray-500">image</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
