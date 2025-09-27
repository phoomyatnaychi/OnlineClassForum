<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>YouthGuide - Log Out </title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<style type="text/tailwindcss">
        body {
            font-family: 'Inter', sans-serif;
        }
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 1,
          'wght' 400,
          'GRAD' 0,
          'opsz' 48
        }
    </style>
    </head>
        <body class="flex flex-col min-h-screen bg-gray-100">
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-16">
                            <div class="flex items-center">
                            <span class="material-symbols-outlined text-orange-500 text-4xl">
                                                    school
                                                </span>
                            <h1 class="text-xl font-bold ml-2 text-gray-800">YouthGuide</h1>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                <img alt="User avatar" class="w-8 h-8 rounded-full cursor-pointer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1HLPM2pWMZwVF7rAP0MwtFHcq9PDbvbq-xO0T2cV2Qs5P-Ak5oE-_scg6WCY6oj4Nq9YIU2rCYS2hkpPe50ze2T4StMMQ17kX20RuNdPqrHLuPWKQOB-W4nFqTzSDMwgNHjavx4aV1wVfpCryVSGyVhfVWbJCUzigBoMc6ttDGTWusoMvn3MXAcN49KJqtm4bd2zW_fy73OLhRADRjmoxjjIhW41PW9rDpL3FftXMJwxjgj3V7_IvZdZ8qOj8Bn4SNMo3Hqu0hgc"/>
                                </div>
                            </div>
                    </div>
                </div>
            </header>
        <main class="flex-grow flex items-center justify-center px-4">
        <div class="relative w-full max-w-md">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                        <div class="bg-white/60 backdrop-blur-lg rounded-2xl shadow-lg p-8 w-full text-center z-10 relative">
                            <div class="w-24 h-24 bg-gradient-to-br from-red-400 to-orange-500 rounded-full mx-auto flex items-center justify-center mb-6 shadow-md">
                                <span class="material-symbols-outlined text-white text-6xl">logout</span>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-3">Leaving So Soon?</h2>
                            <p class="text-gray-600 mb-8">Are you sure you want to log out of your account?</p>
                            <div class="flex justify-center gap-4">
                                <a href="main.php" class="px-8 py-3 rounded-full text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold transition-all duration-300 transform hover:scale-105">Cancel</a>
                                <a href="../../app/models/userLogOut.php" class="px-8 py-3 rounded-full text-white bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">Log Out</a>
                            </div>
                        </div>
                    </div>
        </main>
        <footer class="bg-white mt-12">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="border-t border-gray-200 pt-6">
                    <p class="text-base text-gray-500 text-center">© 2024 CourseForum, Inc. All rights reserved.</p>
                </div>
            </div>
        </footer>
<style>
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>

</body></html>