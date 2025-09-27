<?php
// Connect to database
$db_server = "localhost:3306";
$db_user = "root";
$db_pass = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Get post ID, category, and tab from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = isset($_GET['category']) ? $_GET['category'] : 'coding'; // coding or language
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';

// Fetch post from DB
if ($category === 'coding') {
    $sql = "SELECT * FROM coding_class_info WHERE coding_id = $id";
} else {
    $sql = "SELECT * FROM language_class_info WHERE language_id = $id";
}
$result = $conn->query($sql);
$post = $result ? $result->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>YouthGuide - Post Detail</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
  <style>
  body { font-family: 'Inter', sans-serif; background-color: #DAE0E6; }
  .main-container { max-width: 1200px; margin: 0 auto; padding: 24px; }
  </style>
</head>
<body>

<header class="bg-white shadow-sm sticky top-0 z-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <span class="material-icons text-orange-600 text-3xl">school</span>
        <h1 class="text-xl font-bold ml-2">YouthGuide</h1>
      </div>
    </div>
  </div>
</header>

<div class="main-container">
<main>
  <?php if ($post): ?>
  <div class="bg-white rounded-md border border-gray-300 overflow-hidden">
    <div class="p-4">

    <div class="flex items-start gap-4 mb-4">
      <a class="text-gray-600 hover:text-gray-900" href="main.php?tab=<?= $tab ?>">
          <span class="material-icons text-3xl">arrow_back</span>
      </a>
      <div class="flex-grow">
        <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($post['title']) ?></h2>
      <div class="flex items-center text-sm text-gray-500">
        <span>Posted by <?= htmlspecialchars($post['poster'] ?? 'u/pro_admin') ?> <?= htmlspecialchars($post['created_at'] ?? '') ?></span>
      </div>
    </div>
  </div>

  <div class="flex flex-col md:flex-row items-start gap-6">
    <div class="w-full md:w-1/2">
    <?php if (!empty($post[$category === 'coding' ? 'coding_image' : 'lan_image'])): ?>
    <img src="data:image/jpeg;base64,<?= base64_encode($post[$category === 'coding' ? 'coding_image' : 'lan_image']) ?>" alt="Course Image" class="w-full h-96 object-cover rounded-md"/>
    <?php endif; ?>
    </div>
    <div class="w-full md:w-1/2">
    <p class="text-gray-700 mb-4"><?= htmlspecialchars($post['content']) ?></p>
    </div>
  </div>

    <div class="mt-6 border-t border-gray-200 pt-6">
      <h3 class="text-lg font-semibold mb-4">Course Details</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
      <div>
      <h4 class="font-semibold text-gray-600">Language</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['type'] ?? '-') ?></p>
    </div>
    <div>
      <h4 class="font-semibold text-gray-600">Organization</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['organization'] ?? '-') ?></p>
    </div>
    <div>
      <h4 class="font-semibold text-gray-600">Start Date</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['start_date'] ?? '-') ?></p>
    </div>
    <div>
      <h4 class="font-semibold text-gray-600">End Date</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['end_date'] ?? '-') ?></p>
    </div>
    <div>
      <h4 class="font-semibold text-gray-600">Level</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['level'] ?? '-') ?></p>
    </div>
    <div>
      <h4 class="font-semibold text-gray-600">Duration</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['duration'] ?? '-') ?></p>
    </div>
    <div class="md:col-span-2">
      <h4 class="font-semibold text-gray-600">Contact Information</h4>
      <p class="text-gray-800"><?= htmlspecialchars($post['contact_info'] ?? '-') ?></p>
    </div>
</div>
</div>

</div>
<?php else: ?>
<p class="text-gray-500">Post not found.</p>
<?php endif; ?>
</main>
</div>

</body>
</html>

<?php $conn->close(); ?>
