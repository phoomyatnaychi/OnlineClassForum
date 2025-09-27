<?php
session_start();

// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/loginPage.php");
    exit;
}

// DB connection
$db_server = "localhost:3306";
$db_user   = "root";
$db_pass   = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch coding suggestions
$codingSuggestions = $conn->query("SELECT suggestion_content, created_at FROM coding_suggestion WHERE user_id = $user_id ORDER BY created_at DESC");

// Fetch language suggestions
$languageSuggestions = $conn->query("SELECT suggestion_content, created_at FROM language_suggestion WHERE user_id = $user_id ORDER BY created_at DESC");

// Fetch general suggestions
$generalSuggestions = $conn->query("SELECT suggestion_content, created_at FROM general_suggestion WHERE user_id = $user_id ORDER BY created_at DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>YouthGuide - Suggestion Box</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
  <style type="text/tailwindcss">
    body { font-family: 'Inter', sans-serif; background-color: #DAE0E6; }
  </style>
</head>
<body class="bg-gray-100">

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

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <div class="bg-white rounded-lg shadow-md">
    <div class="p-6 border-b border-gray-200">
        <button onclick="window.location.href='http://localhost/PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/user/main.php'" 
            class="text-gray-600 hover:text-orange-500 mr-4">
            <span class="material-icons">arrow_back</span>
        </button>
      <h2 class="text-2xl font-bold text-gray-800 flex items-center">
        <span class="material-icons text-orange-600 mr-3 text-3xl">lightbulb</span>
        Suggestion Box
      </h2>
      <p class="text-gray-600 mt-2">Have an idea or feedback? We'd love to hear from you. Share your suggestions.</p>
    </div>

    <!-- ✅ Success / Error Messages -->
    <div class="p-6">
      <?php if (isset($_GET['success'])): ?>
        <p class="text-green-600 text-sm mb-4">Your suggestion has been submitted successfully!</p>
      <?php elseif (isset($_GET['error'])): ?>
        <p class="text-red-600 text-sm mb-4">Something went wrong. Please try again.</p>
      <?php endif; ?>

      <!-- ✅ Suggestion Form -->
      <form method="POST" action="../../app/models/submitSuggestion.php">
        <!-- <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
          <input type="text" name="suggestion_title" required class="w-full border-gray-300 rounded-md shadow-sm">
        </div> -->

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Suggestion For:</label>
          <select name="suggestion_type" required class="w-full border-gray-300 rounded-md shadow-sm">
            <option value="Coding">Coding</option>
            <option value="Language">Language</option>
            <option value="General">General</option>
          </select>
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Details</label>
          <textarea name="suggestion_content" rows="6" required class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-orange-600 text-white font-bold py-2 px-6 rounded-full hover:bg-orange-700 flex items-center">
            <span class="material-icons mr-2">send</span>
            Submit Suggestion
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ✅ Past Suggestions -->
  <div class="mt-12">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Your Past Suggestions</h3>

    <?php while ($row = $codingSuggestions->fetch_assoc()): ?>
      <div class="bg-white p-5 rounded-lg shadow-md mb-4">
        <p class="text-sm font-semibold text-gray-800">[Coding Suggestion] </p>
        <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($row['suggestion_content']) ?></p>
        <p class="text-xs text-gray-400 mt-2">Submitted on: <?= $row['created_at'] ?></p>
      </div>
    <?php endwhile; ?>

    <?php while ($row = $languageSuggestions->fetch_assoc()): ?>
      <div class="bg-white p-5 rounded-lg shadow-md mb-4">
        <p class="text-sm font-semibold text-gray-800">[Language Suggestion]</p>
        <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($row['suggestion_content']) ?></p>
        <p class="text-xs text-gray-400 mt-2">Submitted on: <?= $row['created_at'] ?></p>
      </div>
    <?php endwhile; ?>

    <?php while ($row = $generalSuggestions->fetch_assoc()): ?>
      <div class="bg-white p-5 rounded-lg shadow-md mb-4">
        <p class="text-sm font-semibold text-gray-800">[General Suggestion]</p>
        <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($row['suggestion_content']) ?></p>
        <p class="text-xs text-gray-400 mt-2">Submitted on: <?= $row['created_at'] ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
