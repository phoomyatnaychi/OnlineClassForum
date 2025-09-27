<?php
// Connect to database
$db_server = "localhost:3306";
$db_user = "root";
$db_pass = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all coding classes
$sql = "SELECT * FROM coding_class_info ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Panel - Coding Posts View</title>
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
    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="flex items-center justify-between p-4 bg-white border-b">
            <div class="flex items-center">
                <h2 class="text-2xl font-semibold text-gray-800">My Posts</h2>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input class="w-full pl-10 pr-4 py-2 border rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search my posts..." type="text"/>
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                </div>
                <button class="text-gray-600 hover:bg-gray-100 p-2 rounded-full">
                    <span class="material-icons">notifications_none</span>
                </button>
                <div class="relative">
                    <img alt="User avatar" class="w-10 h-10 rounded-full cursor-pointer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1HLPM2pWMZwVF7rAP0MwtFHcq9PDbvbq-xO0T2cV2Qs5P-Ak5oE-_scg6WCY6oj4Nq9YIU2rCYS2hkpPe50ze2T4StMMQ17kX20RuNdPqrHLuPWKQOB-W4nFqTzSDMwgNHjavx4aV1wVfpCryVSGyVhfVWbJCUzigBoMc6ttDGTWusoMvn3MXAcN49KJqtm4bd2zW_fy73OLhRADRjmoxjjIhW41PW9rDpL3FftXMJwxjgj3V7_IvZdZ8qOj8Bn4SNMo3Hqu0hgc"/>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-medium text-gray-700">Your Uploaded Posts</h3>
                <a href="adminCodePostCreate.php" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 flex items-center">
                    <span class="material-icons mr-2">add_circle_outline</span> Insert New Post
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while($row = $result->fetch_assoc()): ?>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="adminCodePostDetail.php?id=<?= $row['coding_id'] ?>" class="block hover:shadow-lg transition-shadow">
                    <?php if(!empty($row['coding_image'])): ?>
                        <img alt="Class Photo" class="w-full h-48 object-cover" 
                             src="data:image/jpeg;base64,<?= base64_encode($row['coding_image']); ?>"/>
                    <?php else: ?>
                        <img alt="Class Photo" class="w-full h-48 object-cover" src="default-image.jpg"/>
                    <?php endif; ?>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-lg font-semibold text-gray-800 flex-1 pr-2"><?= htmlspecialchars($row['title']) ?></h4>
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full 
                                <?= $row['level'] === 'beginner' ? 'text-green-600 bg-green-200' : ($row['level']==='intermediate' ? 'text-yellow-600 bg-yellow-200' : 'text-red-600 bg-red-200') ?>">
                                <?= ucfirst($row['level']) ?>
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3 overflow-hidden"><?= htmlspecialchars($row['content']) ?></p>

                        
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">Published: <?= date('M d, Y', strtotime($row['created_at'])) ?></span>
                            <div class="flex space-x-2">
                                <a href="adminCodePostEdit.php?id=<?= $row['coding_id'] ?>" class="text-blue-600 hover:text-blue-800">
                                    <span class="material-icons">edit</span>
                                </a>
                                <a href="../../app/models/adminCodePostDelete.php?id=<?= $row['coding_id'] ?>" 
                                    class="text-red-600 hover:text-red-800"
                                    onclick="return confirm('Are you sure you want to delete this post?');">
                                    <span class="material-icons">delete</span>
                                </a>

                            </div>
                        </div>
                    </div>
                     </a>
                </div>
               
                <?php endwhile; ?>
            </div>

        </main>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
