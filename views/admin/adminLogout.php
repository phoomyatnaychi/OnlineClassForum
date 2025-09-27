<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Admin Logout Confirmation</title>
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
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md" href="adminSuggestion.php">
              <span class="material-icons">lightbulb</span>
              <span class="ml-3">Suggestions</span>
          </a>
      </nav>
      <div class="px-4 py-4 border-t">
          <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 bg-gray-200 rounded-md" href="adminLogout.php">
              <span class="material-icons">logout</span>
              <span class="ml-3">Logout</span>
          </a>
      </div>
  </aside>
  <!-- Sidebar end-->

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <header class="flex items-center justify-between p-4 bg-white border-b">
        <h2 class="text-2xl font-semibold text-gray-800">Administrator Logout</h2>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <img alt="User avatar" class="w-10 h-10 rounded-full cursor-pointer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1HLPM2pWMZwVF7rAP0MwtFHcq9PDbvbq-xO0T2cV2Qs5P-Ak5oE-_scg6WCY6oj4Nq9YIU2rCYS2hkpPe50ze2T4StMMQ17kX20RuNdPqrHLuPWKQOB-W4nFqTzSDMwgNHjavx4aV1wVfpCryVSGyVhfVWbJCUzigBoMc6ttDGTWusoMvn3MXAcN49KJqtm4bd2zW_fy73OLhRADRjmoxjjIhW41PW9rDpL3FftXMJwxjgj3V7_IvZdZ8qOj8Bn4SNMo3Hqu0hgc"/>
          </div>
        </div>
      </header>

      <main class="flex-1 flex items-center justify-center p-6 bg-gray-100">
        <div class="w-full max-w-md">
          <div class="bg-white p-8 rounded-lg shadow-md text-center">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-red-100 mb-6">
              <span class="material-icons text-5xl text-red-600">logout</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Confirm Logout</h3>
            <p class="text-gray-600 mb-8">Are you sure you want to log out of the administrator panel?</p>
            <div class="flex justify-center gap-4">
              <!-- Cancel button -->
              <a href="admin_dashboard.php" 
                 class="w-full bg-gray-300 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-400 font-semibold text-center">
                Cancel
              </a>
              <!-- Logout button -->
              <a href="../user/loginPage.php" 
                 class="w-full bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 font-semibold text-center">
                Log Out
              </a>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
