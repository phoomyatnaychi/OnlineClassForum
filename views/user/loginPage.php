<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>YouthGuide - Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="../../public/css/main.css">
<style type="text/tailwindcss">
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #DAE0E6;
        }
        /* .material-icons{
            color:var(--main-color);
        }
        .btn{
            background-color: var(--main-color);
        }
        .btn:hover{
            background-color: var(--secondary-color);
        }
        .registerLink{
            color:var(--main-color);
        } */
    
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 max-w-4xl w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class=" md:p-12 flex flex-col justify-center">
                <div class="flex items-center mb-8">
                    <span class="material-icons text-orange-600 text-4xl">school</span>
                    <h1 class="text-3xl font-bold ml-2">YouthGuide</h1>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Login</h2>
                <p class="text-gray-600 mb-8">Welcome back! Please enter your details.</p>

                <form action="../../app/models/checkLoginPage.php" method="POST">

                    <!-- email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
                        <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="email" name="email" placeholder="you@example.com" required="" type="email"/>
                    </div>

                    <!-- password -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                        </div>
                        <div class="relative">
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                            <i class="fa-solid fa-eye absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" id="togglePassword"></i>
                        </div>
                    </div>
                    <!-- button -->
                    <button class="btn w-full bg-orange-600 text-white py-2.5 rounded-md font-semibold transition-colors" type="submit" name="login">Sign In</button>

                     <!-- //to show error message -->
                    <?php if (isset($_GET['error'])): ?>
                        <p class="text-red-500 text-sm mb-3"><?= htmlspecialchars($_GET['error']) ?></p>
                    <?php endif; ?>
                    <!-- <button class="btn w-full bg-600 text-white py-2.5 rounded-md font-semibold hover:bg-orange-700 transition-colors" type="submit"><a href="main.html">Sign In</a></button> -->

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600"> Don't have an account? 
                        <a class="registerLink font-semibold text-orange-600 hover:underline" href="registerPage.php">Sign up</a>
                        </p>
                    </div>
                </form>
            </div>
            <!-- photo -->
            <div class="hidden md:block">
                <img class="w-full h-full" src="../../public/images/registerPoster2.jpg" alt="Students studying together"/>

                <!-- <img alt="Students studying together" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsUVPuR-56GmFI16a6f340IVXzD-56e0UIrAMz3FWCPbGhqJHvvrW9_CE3xYegEFtksqoFf_j88t3UEwfpHxygvO04ErCvzG0IFeUrqfXPa-3o0xx7KZp2XpeZxvjuCfLpdjAOrGvk-NB6v7xrb9L4EYq9Fc6Y6uoaGwXUC1jd_3Vf0YXZVkFuXzmXajIVoy5mW5hOx2i1luHmfB9SIF4Rq54NN1c0qqZVmc9VYRjA9BnAawlh65Np_y0HtyI-D-dxB4x0OqfxCuo"/> -->
            </div>
        </div>
    </div>

    <script>
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
       

        // Apply toggle to both fields
        toggleVisibility("password", "togglePassword");
       
    </script>
</body>
</html>