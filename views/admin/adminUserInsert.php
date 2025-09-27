<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Panel - CourseForum</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style type="text/tailwindcss">
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }
    </style>
</head>
    <body class="bg-gray-100" x-data="{ activeTab: 'pending', showCreateUserForm: true }">
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
        <div x-cloak="" x-show="showCreateUserForm">
            <div class="flex items-center mb-6">
                <button onclick="window.location.href='http://localhost/PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminUserPanel.php?tab=accepted'" 
                        class="text-gray-600 hover:text-orange-500 mr-4">
                    <span class="material-icons">arrow_back</span>
                </button>
                <h3 class="text-xl font-medium text-gray-700">Insert New User Data</h3>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
            <form action="../../app/models/adminInsertUser.php" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                    <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="email" name="email" placeholder="you@example.com" required="" type="email"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="name" name="fullName" placeholder="Your name" required="" type="text"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                    <div class="relative">
                    <input 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm pr-10" 
                    id="password" 
                    name="password" 
                    placeholder="••••••••" 
                    required 
                    type="password"
                />
                <i class="fa-solid fa-eye absolute left-[95%] top-[50%] -translate-y-1/2 text-gray-500 cursor-pointer" id="togglePassword"></i>
                </div>  
                <p id="password-strength" class="text-sm mt-1"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="confirm-password">
                        Confirm Password
                    </label>
                    <div class="relative">
                    <input 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm pr-10" 
                        id="confirmPassword" 
                        name="confirmPassword" 
                        placeholder="••••••••" 
                        required 
                        type="password"
                    />
                    <i class="fa-solid fa-eye absolute right-3 top-[50%] -translate-y-1/2 text-gray-500 cursor-pointer" id="toggleConfirmPassword"></i>
                </div>
                <p id="confirmMessage" class="text-sm mt-1 text-red-500"></p>
                </div>
                <div>
            <label class="block text-sm font-medium text-gray-700" for="class">Class</label>
                <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="classOptions" name="classOptions" required="">
                <option class="opt">First Year</option>
                <option class="opt">Second Year</option>
                <option class="opt">Third Year</option>
                <option class="opt">Fourth Year</option>
                <option class="opt">Fifth Year</option>
                </select>
            </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Student Card</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center" id="uploadBox">
                <svg aria-hidden="true" class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <div class="flex text-sm text-gray-600">
                <label class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500" for="student-card-upload">
                <span>Upload a file</span>
                <input type="file" id="fileInput" name="studentCard" accept="image/*" hidden required>
                <img id="preview" src="" alt="">
            </label>
            <p class="pl-1">or drag and drop</p>
        </div>
            <!-- <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p> -->
    </div>
    </div>
    </div>
    

        <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700" for="expectation">Expectation</label>
        <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="expectation" name="expectation" rows="4"></textarea>
        </div>
    </div>
        <div class="mt-6 flex justify-end">
        <!-- <button @click="showCreateUserForm = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 mr-2" type="reset" >Cancel</button> -->
        <button class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600" type="submit">Create Account</button>
        </div>
    </form>
    </div>
    </div>
    </main>
    </div>
    </div>
    <script defer="" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

     <!-- java script -->
     <script>
    const uploadBox = document.getElementById("uploadBox");
    const fileInput = document.getElementById("fileInput");
    const preview = document.getElementById("preview");

    // Click box opens file dialog
    uploadBox.addEventListener("click", () => fileInput.click());

    // Handle file selection
    fileInput.addEventListener("change", (e) => {
      showImage(e.target.files[0]);
    });

    // Drag & drop events
    uploadBox.addEventListener("dragover", (e) => {
      e.preventDefault();
      uploadBox.classList.add("dragover");
    });

    uploadBox.addEventListener("dragleave", () => {
      uploadBox.classList.remove("dragover");
    });

    uploadBox.addEventListener("drop", (e) => {
      e.preventDefault();
      uploadBox.classList.remove("dragover");
      if (e.dataTransfer.files.length > 0) {
        showImage(e.dataTransfer.files[0]);
      }
    });

    // Show preview
    function showImage(file) {
      if (!file.type.startsWith("image/")) return;
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }

    // Toggle function
    function toggleVisibility(inputId, toggleId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(toggleId);

      icon.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
      });
    }

    // Set initial icon to fa-eye
    document.getElementById("togglePassword").classList.add("fa-eye");
    document.getElementById("toggleConfirmPassword").classList.add("fa-eye");

    // Apply toggle to both fields
    toggleVisibility("password", "togglePassword");
    toggleVisibility("confirmPassword", "toggleConfirmPassword");

    // Password strength indicator
    const passwordInput = document.getElementById("password");
    const strengthText = document.getElementById("password-strength");
    passwordInput.addEventListener("input", function () {
        const password = passwordInput.value;
        let strength = "";
        let color = "";

        // Conditions
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        if (password.length < 6) {
            strength = "Too short";
            color = "text-red-500";
        } else if (hasUpper && hasLower && hasNumber && hasSpecial && password.length >= 8) {
            strength = "Strong ✅";
            color = "text-green-500";
        } else {
            strength = "Weak ⚠️ (add uppercase, numbers & special characters)";
            color = "text-yellow-500";
        }

        strengthText.textContent = strength;
        strengthText.className = `text-sm mt-1 ${color}`;
        });

        //confirm password match
         const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const message = document.getElementById("confirmMessage");
        const submitBtn = document.getElementById("submitBtn");

         confirmPassword.addEventListener("input", () => {
        if (password.value !== confirmPassword.value) {
        message.textContent = "❌ Passwords do not match";
        message.classList.add("text-red-500");
        message.classList.remove("text-green-500");
        submitBtn.disabled = true; // prevent submit
        } else {
        message.textContent = "✅ Passwords match";
        message.classList.add("text-green-500");
        message.classList.remove("text-red-500");
        submitBtn.disabled = false; // allow submit
        }
    });


  </script>
    </body></html>