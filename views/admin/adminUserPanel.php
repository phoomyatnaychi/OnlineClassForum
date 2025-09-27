<?php
 // conntecting to database
    $db_server="localhost:3306";
    $db_user="root";
    $db_pass="";
    $db_name="onlineclass_forum";
    $conn="";

    $conn=new mysqli($db_server,$db_user,$db_pass,$db_name);

    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }
    // Get pending users
    $pendingUsers = $conn->query("SELECT * FROM users WHERE status = 'pending' ORDER BY created_at DESC");
    

    // Get accepted users
    $acceptedUsers = $conn->query("SELECT * FROM users WHERE status = 'accept' ORDER BY created_at DESC");
  
    // Get denied users
    $deniedUsers = $conn->query("SELECT * FROM users WHERE status = 'denied' ORDER BY created_at DESC");
  
    ?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Panel - CourseForum</title>
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
<body class="bg-gray-100"  x-data="{activeTab: new URLSearchParams(window.location.search).get('tab') || 'pending'}">
<div class="flex h-screen bg-gray-100">
<!-- Sidebar start-->
  <aside class="w-64 bg-white shadow-md flex flex-col">
      <div class="flex items-center justify-center h-16 bg-white border-b">
          <span class="material-icons text-orange-600 text-3xl">school</span>
          <h1 class="text-xl font-bold ml-2">YouthGuide</h1>
      </div>
      <nav class="flex-1 px-4 py-4 space-y-2">
              <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 bg-gray-200 rounded-md" href="adminUserPanel.php">
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
<h2 class="text-2xl font-semibold text-gray-800">User Management</h2>
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
    <div class="border-b border-gray-200 mb-6">
        <nav aria-label="Tabs" class="-mb-px flex space-x-8">
        <a href="?tab=pending" 
            @click.prevent="activeTab = 'pending'; history.pushState(null, '', '?tab=pending')"
            :class="{ 'border-orange-500 text-orange-600': activeTab === 'pending' }"
            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Pending Users
        </a>
        <a href="?tab=accepted" 
            @click.prevent="activeTab = 'accepted'; history.pushState(null, '', '?tab=accepted')"
            :class="{ 'border-orange-500 text-orange-600': activeTab === 'accepted' }"
            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Accepted Users
        </a>
        <a href="?tab=denied" 
            @click.prevent="activeTab = 'denied'; history.pushState(null, '', '?tab=denied')"
            :class="{ 'border-orange-500 text-orange-600': activeTab === 'denied' }"
            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Denied Users
        </a>
        </nav>
    </div>
        <!-- pending users -->
        <div x-show="activeTab === 'pending'">
        <h3 class="text-xl font-medium text-gray-700 mb-6">Pending Users</h3>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                 <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="px-2 py-3">No.</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Class</th>
                            <th class="px-5 py-3">Student Card</th>
                            <th class="px-5 py-3">Expectation</th>
                            <th class="px-3 py-3">Status</th>
                            <th class="px-3 py-3">Role</th>
                            <th class="px-5 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($pendingUsers->num_rows > 0) {
                            while($row = $pendingUsers->fetch_assoc()) {
                                // Student card image (base64)
                                $cardImg = !empty($row['student_card']) 
                                    ? 'data:image/jpeg;base64,' . base64_encode($row['student_card']) 
                                    : 'https://via.placeholder.com/150';

                                // Status colors
                                $statusColor = match($row['status']) {
                                    'accept' => 'green',
                                    'denied' => 'red',
                                    default => 'yellow'
                                };
                        ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-2 py-4 text-sm align-middle"><?= $no++; ?></td>
                            <td class="px-4 py-4 text-sm align-middle"><?= htmlspecialchars($row['email']); ?></td>
                            <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['name']); ?></td>
                            <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['class']); ?></td>
                            <td class="px-5 py-4 text-sm align-middle">
                                <img src="<?= $cardImg; ?>" alt="Student Card" class="w-16 h-10 object-cover rounded-md cursor-pointer" onclick="openModal('<?= $cardImg; ?>')">
                            </td>
                            <td class="px-5 py-4 text-sm align-middle">
                                <div class="max-h-20 max-w-xs overflow-y-auto overflow-x-hidden p-1 border rounded break-words">
                                    <?= htmlspecialchars($row['expectation']); ?>
                                </div>
                            </td>

                            <td class="px-3 py-4 text-sm align-middle">
                                <span class="relative inline-block px-3 py-1 font-semibold text-<?= $statusColor ?>-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-<?= $statusColor ?>-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= ucfirst($row['status']); ?></span>
                                </span>
                            </td>
                            <td class="px-3 py-4 text-sm align-middle"><?= ucfirst($row['role']); ?></td>
                            <td class="px-5 py-4 text-sm font-medium align-middle">
                                <div class="flex items-center space-x-2">
                                    <form method="POST" action="../../app/models/updatePendingUserStatus.php" class="inline">
                                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                        <button name="action" type="submit" value="accept" class="bg-green-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600">Accept</button>
                                        
                                    </form>
                                    <form method="POST" action="../../app/models/updatePendingUserStatus.php" class="inline" onsubmit="return confirm('Are you sure you want to deny this user?');">
                                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                        <button name="action" type="submit" value="deny" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">Deny</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='9' class='px-5 py-4 text-center text-sm'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <span class="text-xs xs:text-sm text-gray-900">Showing 1 to 1 of 1 Entries</span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                                    Prev
                                                </button>
                            <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                                    Next
                                                </button>
                        </div>
                </div>
            </div>
        </div>

        
        <!-- accpeted users start-->
    <div x-show="activeTab === 'accepted'" >
        <!-- under navi -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-medium text-gray-700">Accepted Users</h3>
        <button >
        <a href="adminUserInsert.php"
        class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 flex items-center">
        <span class="material-icons mr-2">add</span> Create New Account
        </a>
</button>
    </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr class="border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <th class="px-2 py-3">No.</th>
                                        <th class="px-5 py-3">Email</th>
                                        <th class="px-5 py-3">Name</th>
                                        <th class="px-4 py-3">Class</th>
                                        <th class="px-5 py-3">Student Card</th>
                                        <th class="px-4 py-3">Expectation</th>
                                        <th class="px-2 py-3">Status</th>
                                        <th class="px-2 py-3">Role</th>
                                        <th class="px-5 py-3 w-50">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($acceptedUsers->num_rows > 0) {
                                        while($row = $acceptedUsers->fetch_assoc()) {
                                            // Student card image (base64)
                                            $cardImg = !empty($row['student_card']) 
                                                ? 'data:image/jpeg;base64,' . base64_encode($row['student_card']) 
                                                : 'https://via.placeholder.com/150';

                                            // Status colors
                                            $statusColor = match($row['status']) {
                                                'accept' => 'green',
                                                'denied' => 'red',
                                                default => 'yellow'
                                            };
                                    ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-2 py-4 text-sm align-middle"><?= $no++; ?></td>
                                        <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['email']); ?></td>
                                        <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['name']); ?></td>
                                        <td class="px-4 py-4 text-sm align-middle"><?= htmlspecialchars($row['class']); ?></td>
                                        <td class="px-5 py-4 text-sm align-middle">
                                            <img src="<?= $cardImg; ?>" alt="Student Card" class="w-16 h-10 object-cover rounded-md cursor-pointer" onclick="openModal('<?= $cardImg; ?>')">
                                        </td>
                                        <td class="px-4 py-4 text-sm align-middle">
                                            <div class="max-h-20 max-w-xs overflow-y-auto overflow-x-hidden p-1 border rounded break-words">
                                                <?= htmlspecialchars($row['expectation']); ?>
                                            </div>
                                        </td>
                                        <td class="px-2 py-4 text-sm align-middle">
                                            <span class="relative inline-block px-3 py-1 font-semibold text-<?= $statusColor ?>-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-<?= $statusColor ?>-200 opacity-50 rounded-full"></span>
                                                <span class="relative"><?= ucfirst($row['status']); ?></span>
                                            </span>
                                        </td>
                                        <td class="px-2 py-4 text-sm align-middle"><?= ucfirst($row['role']); ?></td>
                                        <td class="px-5 py-4 w-50 text-center text-sm font-medium align-middle"> 
                                            <div class="flex items-center space-x-2">
                                                <form method="post" action="updateUserStatus.php" class="inline">
                                                    <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                    <!-- Update Button -->
                                                    <button type="button" 
                                                            onclick="openUpdateModal(<?= $row['user_id']; ?>, '<?= $row['role']; ?>', '<?= $row['class']; ?>', '<?= $row['status']; ?>')" 
                                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600">
                                                        Update
                                                    </button>

                                                </form>
                                                <form method="post" action="../../app/models/deleteAcceptUser.php" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">Delete</button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9' class='px-5 py-4 text-center text-sm'>No users found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Update User Modal start-->
                            <div id="updateModal" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
                                <button onclick="closeUpdateModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">&times;</button>
                                <h2 class="text-lg font-semibold mb-4">Update User</h2>
                                
                                <form method="post" action="../../app/models/updateAcceptUser.php">
                                <input type="hidden" id="updateUserId" name="user_id">

                                <!-- Role -->
                                <label class="block mb-2 text-sm">Role</label>
                                <select name="role" id="updateRole" class="w-full border rounded p-2 mb-4">
                                    <option value="student">Student</option>
                                    <option value="admin">Admin</option>
                                </select>

                                <!-- Class -->
                                <label class="block mb-2 text-sm">Class</label>
                                <select name="class" id="updateClass" class="w-full border rounded p-2 mb-4">
                                    <option value="First Year">First Year</option>
                                    <option value="Second Year">Second Year</option>  
                                    <option value="Third Year">Third Year</option>
                                    <option value="Fourth Year">Fourth Year</option>  
                                    <option value="Fifth Year">Fifth Year</option>
                                </select>

                                <!-- Status -->
                                <label class="block mb-2 text-sm">Status</label>
                                <select name="status" id="updateStatus" class="w-full border rounded p-2 mb-4">
                                    <option value="accept">Accepted</option>
                                    <option value="denied">Denied</option>
                                    <option value="pending">Pending</option>
                                </select>

                                <!-- Save -->
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                                </form>
                            </div>
                            </div>
                            <!-- Update User Modal end-->
                            <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                                <span class="text-xs xs:text-sm text-gray-900">Showing 1 to 2 of 9 Entries</span>
                                <div class="inline-flex mt-2 xs:mt-0">
                                    <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                                                        Prev
                                                                    </button>
                                    <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                                                        Next
                                                                    </button>
                                </div>
                            </div>
            </div>
    </div>
    <!-- accepted users end -->
    <!-- denied users start -->
   
    <div x-show="activeTab === 'denied'">
        <h3 class="text-xl font-medium text-gray-700 mb-6">Denied Users</h3>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                           
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr class="border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <th class="px-5 py-3">No.</th>
                                        <th class="px-5 py-3">Email</th>
                                        <th class="px-5 py-3">Name</th>
                                        <th class="px-5 py-3">Class</th>
                                        <th class="px-5 py-3">Student Card</th>
                                        <th class="px-5 py-3">Expectation</th>
                                        <th class="px-3 py-3">Status</th>
                                        <th class="px-3 py-3">Role</th>
                                        <th class="px-5 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($deniedUsers->num_rows > 0) {
                                        while($row = $deniedUsers->fetch_assoc()) {
                                            // Student card image (base64)
                                            $cardImg = !empty($row['student_card']) 
                                                ? 'data:image/jpeg;base64,' . base64_encode($row['student_card']) 
                                                : 'https://via.placeholder.com/150';

                                            // Status colors
                                            $statusColor = match($row['status']) {
                                                'accept' => 'green',
                                                'denied' => 'red',
                                                default => 'yellow'
                                            };
                                    ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-5 py-4 text-sm align-middle"><?= $no++; ?></td>
                                        <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['email']); ?></td>
                                        <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['name']); ?></td>
                                        <td class="px-5 py-4 text-sm align-middle"><?= htmlspecialchars($row['class']); ?></td>
                                        <td class="px-5 py-4 text-sm align-middle">
                                            <img src="<?= $cardImg; ?>" alt="Student Card" class="w-16 h-10 object-cover rounded-md cursor-pointer" onclick="openModal('<?= $cardImg; ?>')">
                                        </td>
                                        <td class="px-5 py-4 text-sm align-middle">
                                            <div class="max-h-20 max-w-xs overflow-y-auto overflow-x-hidden p-1 border rounded break-words">
                                                <?= htmlspecialchars($row['expectation']); ?>
                                            </div>
                                        </td>
                                        <td class="px-3 py-4 text-sm align-middle">
                                            <span class="relative inline-block px-3 py-1 font-semibold text-<?= $statusColor ?>-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-<?= $statusColor ?>-200 opacity-50 rounded-full"></span>
                                                <span class="relative"><?= ucfirst($row['status']); ?></span>
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 text-sm align-middle"><?= ucfirst($row['role']); ?></td>
                                        <td class="px-5 py-4 text-sm font-medium align-middle">
                                            <div class="flex items-center space-x-2">
                                                <!-- Accept -->
                                                <form method="post" action="../../app/models/updateDenyUser.php" class="inline">
                                                    <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                    <button name="action" value="accept" class="bg-green-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600">
                                                        Accept
                                                    </button>
                                                </form>
                                                <!-- Delete -->
                                                <form method="post" action="../../app/models/updateDenyUser.php" class="inline" 
                                                    onsubmit="return confirm('Are you sure you want to permanently delete this user?');">
                                                    <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                    <button name="action" value="delete" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9' class='px-5 py-4 text-center text-sm'>No users found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                                <span class="text-xs xs:text-sm text-gray-900">Showing 1 to 2 of 9 Entries</span>
                                <div class="inline-flex mt-2 xs:mt-0">
                                    <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                                                        Prev
                                                                    </button>
                                    <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                                                        Next
                                                                    </button>
                                </div>
                            </div>
            </div>
    </div>

    <!-- denied users end -->
     <!-- showing the view of student card start -->
        <!-- Image Preview Modal -->
            <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50">
                <div class="bg-white p-4 rounded-lg shadow-lg relative">
                    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">&times;</button>
                    <img id="modalImage" src="" alt="Student Card" class="max-w-3xl max-h-[80vh] rounded-lg">
                </div>
            </div>

     <!-- showing the view of student card end -->
</main>
</div>
</div>
<script defer="" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script defer="" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<!-- showing the view of deatil student card start -->
        <script>
        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Update User Modal Functions
        function openUpdateModal(id, role, userClass, status) {
            document.getElementById('updateUserId').value = id;
            document.getElementById('updateRole').value = role;
            document.getElementById('updateClass').value = userClass;
            document.getElementById('updateStatus').value = status;
            document.getElementById('updateModal').classList.remove('hidden');
        }
        function closeUpdateModal() {
            document.getElementById('updateModal').classList.add('hidden');
        }
        </script>
</body></html>