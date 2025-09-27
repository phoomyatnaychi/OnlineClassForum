<?php
session_start(); // Start the session

//Display error message if set
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red;margin-left:30px;margin-top:25px;'>" . $_SESSION['error'] . "</p>";
        // Clear the error message after displaying it
        unset($_SESSION['error']);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>YouthGuide - Register</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style type="text/tailwindcss">
        body {
            font-family: 'Inter', sans-serif;
            background-color: #DAE0E6;
        }

        /* student card upload box */
        .upload-box {
        height: 200px;
        border: 2px dashed #aaa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        cursor: pointer;
        text-align: center;
        }
        .upload-box.dragover {
        border-color: orangered;
        background-color: #fff3f0;
        }
        .upload-box img {
        max-width: 100%;
        max-height: 150px;
        margin-top: 10px;
        }
        /* password */
        
                
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 flex justify-center">
    <div class="grid grid-cols-1 md:grid-cols-2 max-w-6xl w-full bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="p-8 md:p-12 flex flex-col justify-center">
        <div class="flex items-center mb-6">
            <span class="material-icons text-orange-600 text-4xl">school</span>
            <h1 class="text-2xl font-bold ml-2">YouthGuide</h1>
        </div>
      <h2 class="text-3xl font-bold text-gray-900 mb-2">Register</h2>
      <p class="text-gray-600 mb-8">Don't have an account? Create One Right Now!</p>
      
    
      <!-- form start -->
      <form class="uploadForm" action="../../app/models/insertRegisterPage.php" method="POST" enctype="multipart/form-data">
        <!-- full name -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1" for="fullName">Full Name</label>
            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="fullName" name="fullName" placeholder="Your name" required="" type="text"/>
        </div>
        <!-- email -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="email" name="email" placeholder="you@example.com" required="" type="email"/>
        </div>
        <!-- select class -->
        <div class="form-group mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1" for="class">Select Class</label>
            <select class="form-control w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="classOptions" name="classOptions" required="">
            <option class="opt">First Year</option>
            <option class="opt">Second Year</option>
            <option class="opt">Third Year</option>
            <option class="opt">Fourth Year</option>
            <option class="opt">Fifth Year</option>
            </select>
        </div>

        <!-- New password -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-1">
          <label class="block text-sm font-medium text-gray-700" for="password">New Password</label>
            </div>
            <div class="relative">
          <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="password" name="password" placeholder="••••••••" required="" type="password"/>
          <i class="fa-solid fa-eye absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
            <p class="text-red-500 text-sm mt-1 hidden" id="passwordError"></p>
        </div>

        <!-- Reconfirm password -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-1">
          <label class="block text-sm font-medium text-gray-700" for="confirmPassword">Confirm Password</label>
            </div>
            <div class="relative">
          <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="confirmPassword" name="confirmPassword" placeholder="••••••••" required="" type="password"/>
          <i class="fa-solid fa-eye absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" id="toggleConfirmPassword"></i>
            </div>
            <p class="text-red-500 text-sm mt-1 hidden" id="confirmPasswordError"></p>
        </div>

        <!-- student card -->
        <div class="mb-4">
            <label class="block text-sm mb-2 font-medium text-gray-700" for="studentCard">Please Insert Your Student Card here</label>
            <!-- drag and drop image here  -->
             <div class="upload-box text-sm font-medium text-gray-700" id="uploadBox">
              
                <p>Drag & Drop an image<br>or <span style="color:orangered;text-decoration:underline;">Browse</span></p>
                <input type="file" id="fileInput" name="studentCard" accept="image/*" hidden required>
                <img id="preview" src="" alt="">
            </div>
            <p class="text-red-500 text-sm mt-1 hidden" id="studentCardError"></p>
        </div>
        
        <!-- Expectation -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1" for="expectation">Why do you expect from our forum?</label>
            <textarea rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="expectation" name="expectation" placeholder="I want to join this online forum because..." required=""></textarea>
        </div>
        <p class="text-red-500 text-sm mt-1 hidden" id="expectationError"></p>

        <button class="w-full bg-orange-600 text-white py-2.5 rounded-md font-semibold hover:bg-orange-700 transition-colors" type="submit">Sign In</button>
        <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
        Have a problem creating account?<a class="font-semibold text-orange-600 hover:underline" href="#">Contact admin team</a>
        </p>
        </div>
      </form>
      </div>
      <div class="hidden md:block">
      <img class="w-full h-full" src="../../public/images/registerPoster3.jpg" alt="Students studying together"/>
        <!-- <img alt="Students studying together" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsUVPuR-56GmFI16a6f340IVXzD-56e0UIrAMz3FWCPbGhqJHvvrW9_CE3xYegEFtksqoFf_j88t3UEwfpHxygvO04ErCvzG0IFeUrqfXPa-3o0xx7KZp2XpeZxvjuCfLpdjAOrGvk-NB6v7xrb9L4EYq9Fc6Y6uoaGwXUC1jd_3Vf0YXZVkFuXzmXajIVoy5mW5hOx2i1luHmfB9SIF4Rq54NN1c0qqZVmc9VYRjA9BnAawlh65Np_y0HtyI-D-dxB4x0OqfxCuo"/> -->
      </div>
      </div>
</div>

    <!-- java script -->
     <script>
const uploadBox = document.getElementById("uploadBox");
const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("preview");

const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
const expectation = document.getElementById('expectation');

const passwordError = document.getElementById('passwordError');
const confirmPasswordError = document.getElementById('confirmPasswordError');
const studentCardError = document.getElementById('studentCardError');
const expectationError = document.getElementById('expectationError');

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

// Toggle password visibility
function toggleVisibility(input, icon) {
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

toggleVisibility(password, document.getElementById("togglePassword"));
toggleVisibility(confirmPassword, document.getElementById("toggleConfirmPassword"));

// Form validation
const form = document.querySelector('.uploadForm');
form.addEventListener('submit', function(e) {
    let valid = true;

    // Reset all error messages
    passwordError.classList.add('hidden');
    confirmPasswordError.classList.add('hidden');
    studentCardError.classList.add('hidden');
    expectationError.classList.add('hidden');

    // Check student card
    if (fileInput.files.length === 0) {
        studentCardError.textContent = 'Please upload your student card.';
        studentCardError.classList.remove('hidden');
        valid = false;
    }

    // Check expectation
    if (expectation.value.trim() === '') {
        expectationError.textContent = 'Please fill in your expectation.';
        expectationError.classList.remove('hidden');
        valid = false;
    }

    // Check password strength
    const strongPwd = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?_#&])[A-Za-z\d@$!%*_?#&]{8,}$/;
    if (!strongPwd.test(password.value)) {
        passwordError.textContent = 'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.';
        passwordError.classList.remove('hidden');
        valid = false;
    }

    // Check confirm password
    if (password.value !== confirmPassword.value) {
        confirmPasswordError.textContent = 'Passwords do not match.';
        confirmPasswordError.classList.remove('hidden');
        valid = false;
    }

    if (!valid) e.preventDefault();
});
</script>

</body></html>
