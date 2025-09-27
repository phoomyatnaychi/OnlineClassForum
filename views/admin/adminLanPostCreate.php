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
<div class="bg-white p-8 rounded-lg shadow-md" id="newPostForm">
    <div class="flex items-center mb-6">
        <button onclick="window.location.href='adminLanPostView.php'" 
                        class="text-gray-600 hover:text-orange-500 mr-4">
                    <span class="material-icons">arrow_back</span>
        </button>
        <h3 class="text-2xl font-bold text-gray-800">Create New Post</h3>
    </div>
    
    <form action="../../app/models/adminLanPostCreate.php" method="POST" enctype="multipart/form-data">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
          <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="title" name="title" placeholder="e.g., Introduction to Java" type="text"/>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700" for="type">Type</label>
          <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="type" name="type" placeholder="e.g., IELTS, JLPT, HSK" type="text"/>
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700" for="content">Content</label>
          <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="content" name="content" placeholder="Describe the class..." rows="4"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700" for="organization">Organization</label>
          <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="organization" name="organization" placeholder="Who created the class?" type="text"/>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700" for="level">Level</label>
          <input class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md" id="level" name="level" placeholder="English Intermediate, HSK-5, JYLP,..." type="text"/>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700" for="start_date">Start Date</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="start_date" name="start_date" type="date"/>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700" for="end_date">End Date</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="end_date" name="end_date" type="date"/>
          </div>
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700" for="contact">Contact Information</label>
          <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" id="contact" name="contact" placeholder="e.g., email@example.com or phone number" type="text"/>
        </div>
    
    <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700">Image Upload</label>
    <!-- drag and drop image here  -->
    <div class="mt-1 flex text-sm text-gray-600 justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" id="uploadBox">
        <div class="space-y-1 text-center">
            <svg aria-hidden="true" class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <p>Drag & Drop an image<br>or <span style="color:orangered;text-decoration:underline;">Browse</span></p>
        <input type="file" id="file-upload" name="file-upload" accept="image/*" hidden required>
      <!-- Hidden by default -->
      <img id="preview" src="" alt="" class="mt-3 mx-auto max-h-40 hidden">
        </div>
    </div>
</div>
</div>
<div class="mt-8 flex justify-end space-x-3">
<button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300" type="button">Cancel</button>
<button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 flex items-center" type="submit">
<span class="material-icons mr-2">add_circle_outline</span> Create Post
                            </button>
</div>
</form>
</div>
</main>
</div>
</div>

<script>
  // Image upload preview and drag & drop
  const uploadBox = document.getElementById("uploadBox");
  const fileInput = document.getElementById("file-upload");
  const preview = document.getElementById("preview");

  // Click box opens file dialog
  uploadBox.addEventListener("click", () => fileInput.click());

  // Handle file selection
  fileInput.addEventListener("change", (e) => {
    if (e.target.files.length > 0) {
      showImage(e.target.files[0]);
    }
  });

  // Drag & drop events
  uploadBox.addEventListener("dragover", (e) => {
    e.preventDefault();
    uploadBox.classList.add("border-indigo-500"); // highlight on drag
  });

  uploadBox.addEventListener("dragleave", () => {
    uploadBox.classList.remove("border-indigo-500");
  });

  uploadBox.addEventListener("drop", (e) => {
    e.preventDefault();
    uploadBox.classList.remove("border-indigo-500");
    if (e.dataTransfer.files.length > 0) {
      showImage(e.dataTransfer.files[0]);
    }
  });

  // Show image preview
  function showImage(file) {
    if (!file.type.startsWith("image/")) {
      alert("Please upload an image file.");
      return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
      preview.classList.remove("hidden"); // show the image
    };
    reader.readAsDataURL(file);
  }
</script>
</body></html>