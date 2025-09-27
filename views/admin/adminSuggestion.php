<?php
// ====== DB Connection ======
$db_server = "localhost:3306";
$db_user   = "root";
$db_pass   = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ====== Fetch Coding Suggestions ======
$sqlCoding = "
    SELECT cs.cs_id, cs.suggestion_content, cs.created_at, u.name, u.student_card 
    FROM coding_suggestion cs 
    JOIN users u ON cs.user_id = u.user_id
    ORDER BY cs.created_at DESC
";
$resultCoding = $conn->query($sqlCoding);

// ====== Fetch Language Suggestions ======
$sqlLanguage = "
    SELECT ls.ls_id, ls.suggestion_content, ls.created_at, u.name, u.student_card 
    FROM language_suggestion ls 
    JOIN users u ON ls.user_id = u.user_id
    ORDER BY ls.created_at DESC
";
$resultLanguage = $conn->query($sqlLanguage);

// ====== Determine active tab ======
$activeTab = (!isset($_GET['tab']) || empty($_GET['tab'])) ? 'coding' : $_GET['tab'];

// ====== Fetch General Suggestions ======
$sqlGeneral = "
    SELECT gs.gs_id, gs.suggestion_content, gs.created_at, u.name, u.student_card 
    FROM general_suggestion gs 
    JOIN users u ON gs.user_id = u.user_id
    ORDER BY gs.created_at DESC
";
$resultGeneral = $conn->query($sqlGeneral);

// ====== Determine active tab ======
$activeTab = (!isset($_GET['tab']) || empty($_GET['tab'])) ? 'coding' : $_GET['tab'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel - Suggestions</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminLanPostView.php">
              <span class="material-icons">language</span>
              <span class="ml-3">Language Classes</span>
          </a>
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 bg-gray-200 rounded-md" href="adminSuggestion.php">
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
                <h2 class="text-2xl font-semibold text-gray-800">User's Suggestions</h2>
            </div>
            <div class="flex items-center space-x-4">
            <div class="relative">
            <input class="w-full pl-10 pr-4 py-2 border rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search users..." type="text"/>
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
      <div x-data="{ tab: '<?= $activeTab ?>' }">
        <!-- Tabs -->
        <div class="border-b border-gray-200">
          <nav aria-label="Tabs" class="-mb-px flex space-x-8">
            <button :class="{ 'border-orange-500 text-orange-600': tab === 'coding', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'coding' }" @click="tab = 'coding'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Coding Suggestions
            </button>
            <button :class="{ 'border-orange-500 text-orange-600': tab === 'language', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'language' }" @click="tab = 'language'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Language Suggestions
            </button>
            <button :class="{ 'border-orange-500 text-orange-600': tab === 'general', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'general' }" @click="tab = 'general'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                General Suggestions
            </button>
          </nav>
        </div>

        <!-- Coding Suggestions -->
        <div class="mt-8" x-show="tab === 'coding'">
          <div class="bg-white p-8 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Coding Suggestions</h3>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/2">Suggestion</th>
                    <th class="relative px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <?php while($row = $resultCoding->fetch_assoc()): ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <?php if (!empty($row['student_card'])): ?>
                              <img class="h-10 w-10 rounded-full" src="data:image/jpeg;base64,<?= base64_encode($row['student_card']); ?>"/>
                          <?php else: ?>
                              <span class="material-icons text-gray-400">person</span>
                          <?php endif; ?>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['name']) ?></div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-pre-wrap text-sm text-gray-700"><?= nl2br(htmlspecialchars($row['suggestion_content'])) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"> 
                      <form method="POST" action="../../app/models/deleteSuggestion.php" onsubmit="return confirm('Are you sure you want to delete this suggestion?');">
                          <input type="hidden" name="id" value="<?= $row['cs_id']; ?>">
                          <input type="hidden" name="tab" value="coding">
                          <input type="hidden" name="type" value="coding">
                          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Language Suggestions -->
        <div class="mt-8" x-show="tab === 'language'">
          <div class="bg-white p-8 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Language Suggestions</h3>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/2">Suggestion</th>
                    <th class="relative px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <?php while($row = $resultLanguage->fetch_assoc()): ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <?php if (!empty($row['student_card'])): ?>
                              <img class="h-10 w-10 rounded-full" src="data:image/jpeg;base64,<?= base64_encode($row['student_card']); ?>"/>
                          <?php else: ?>
                              <span class="material-icons text-gray-400">person</span>
                          <?php endif; ?>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['name']) ?></div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-pre-wrap text-sm text-gray-700"><?= nl2br(htmlspecialchars($row['suggestion_content'])) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <form method="POST" action="../../app/models/deleteSuggestion.php" onsubmit="return confirm('Are you sure you want to delete this suggestion?');">
                          <input type="hidden" name="id" value="<?= $row['ls_id']; ?>">
                          <input type="hidden" name="tab" value="language">
                          <input type="hidden" name="type" value="language">
                          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- General Suggestions -->
        <div class="mt-8" x-show="tab === 'general'">
          <div class="bg-white p-8 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">General Suggestions</h3>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/2">Suggestion</th>
                    <th class="relative px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <?php while($row = $resultGeneral->fetch_assoc()): ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <?php if (!empty($row['student_card'])): ?>
                              <img class="h-10 w-10 rounded-full" src="data:image/jpeg;base64,<?= base64_encode($row['student_card']); ?>"/>
                          <?php else: ?>
                              <span class="material-icons text-gray-400">person</span>
                          <?php endif; ?>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['name']) ?></div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-pre-wrap text-sm text-gray-700"><?= nl2br(htmlspecialchars($row['suggestion_content'])) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"> 
                      <form method="POST" action="../../app/models/deleteSuggestion.php" onsubmit="return confirm('Are you sure you want to delete this suggestion?');">
                          <input type="hidden" name="id" value="<?= $row['gs_id']; ?>">
                          <input type="hidden" name="tab" value="general">
                          <input type="hidden" name="type" value="general">
                          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>
<script defer src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
</body>
</html>
