<?php
// Start session and get user name
session_start();
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
// Connect to database
$db_server = "localhost:3306";
$db_user = "root";
$db_pass = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT coding_id AS id, title, content, type, organization, level, start_date, end_date, duration, contact_info, coding_image AS image, created_at, 'coding' AS category
    FROM coding_class_info
    UNION ALL
    SELECT language_id AS id, title, content, type, organization, level, start_date, end_date, duration, contact_info, lan_image AS image, created_at, 'language' AS category
    FROM language_class_info
    ORDER BY RAND()
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>YouthGuide</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<style type="text/tailwindcss">
    body { font-family: 'Inter', sans-serif; background-color: #DAE0E6; }
    .main-container { display: grid; grid-template-columns: 1fr; max-width: 1200px; margin: 0 auto; gap: 24px; padding: 24px; }
    @media (min-width: 1024px) { .main-container { grid-template-columns: 1fr 312px; } }
    .post-card { background-color: #FFFFFF; border-radius: 4px; border: 1px solid #CCCCCC; display: flex; cursor: pointer; transition: border-color 0.2s; }
    .post-card:hover { border-color: #FF4500; }
    .vote-section { background-color: #F8F9FA; padding: 8px 4px; display: flex; flex-direction: column; align-items: center; width: 40px; border-top-left-radius: 4px; border-bottom-left-radius: 4px; }
    .content-section { padding: 12px; width: calc(100% - 40px); }
    .active-tab { color: #FF4500; border-bottom-width: 2px; border-color: #FF4500; }

    /* Default styles for tabs */
    #tab-all.active, #tab-coding.active, #tab-language.active {
        color: #FF4500;             /* orange text */
        border-bottom-width: 2px;   /* underline */
        border-color: #FF4500;
    }
   /* Remove hover effects for inactive tabs */
.tab:not(.active):hover {
  color: gray; /* orange text on hover */
  border-bottom: 2px solid transparent;
}
    
</style>
</head>
<body>

<!-- navigation bar -->
<header class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <span class="material-icons text-orange-600 text-3xl">school</span>
                <h1 class="text-xl font-bold ml-2">YouthGuide</h1>
            </div>
            <div class="flex-1 max-w-lg mx-8">
                <div class="relative">
                    <input class="w-full pl-10 pr-4 py-2 border rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search for courses..." type="text"/>
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a class="text-gray-600 hover:bg-orange-100 p-2 rounded-full" href="userSuggestion.php">
                    <span>Suggestions</span>
                    <span class="material-icons ml-2 align-middle">chat_bubble_outline</span>
                    
                </a>
                <div class="flex items-center gap-2">
                    <?php if ($user_name): ?>
                        <span class="font-medium text-gray-800"><?= htmlspecialchars($user_name) ?></span>
                    <?php endif; ?>
                    <img alt="User avatar" class="w-8 h-8 rounded-full cursor-pointer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1HLPM2pWMZwVF7rAP0MwtFHcq9PDbvbq-xO0T2cV2Qs5P-Ak5oE-_scg6WCY6oj4Nq9YIU2rCYS2hkpPe50ze2T4StMMQ17kX20RuNdPqrHLuPWKQOB-W4nFqTzSDMwgNHjavx4aV1wVfpCryVSGyVhfVWbJCUzigBoMc6ttDGTWusoMvn3MXAcN49KJqtm4bd2zW_fy73OLhRADRjmoxjjIhW41PW9rDpL3FftXMJwxjgj3V7_IvZdZ8qOj8Bn4SNMo3Hqu0hgc"/>
                </div>
                
            </div>
            <div class="px-4 py-4 border-t right-2">
                    <a class="flex items-center px-4 py-2 text-orange-500 hover:bg-orange-200 rounded-md" href="userLogout.php">
                        <span class="material-icons">logout</span>
                        <span class="ml-3">Logout</span>
                    </a>
                </div>
        </div>
    </div>
</header>
<!-- spacing after header so content doesn't go under -->
 <div class="h-16"></div>

<!-- tabs -->
<nav class="bg-white border-b border-gray-200 sticky top-16 z-40">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-start h-12 space-x-8">
      <!-- All tab active by default -->
      <a id="tab-all" class="flex items-center px-3 py-2 text-sm font-medium text-orange-600 border-b-2 border-orange-600"
         href="#">All</a>

      <!-- Other tabs inactive by default -->
      <a id="tab-coding" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-orange-600 hover:border-b-2 hover:border-orange-600"
         href="#">
        <span class="material-icons mr-1">code</span>
        Coding Classes
      </a>

      <a id="tab-language" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-orange-600 hover:border-b-2 hover:border-orange-600"
         href="#">
        <span class="material-icons mr-1">translate</span>
        Language Classes
      </a>
    </div>
  </div>
</nav>
<div class="main-container">
<main>

<!-- POST FEED START -->
<div class="flex flex-col gap-4" id="post-feed">
<?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="post-card" data-category="<?= $row['category'] ?>">
        <div class="vote-section">
            <button class="text-gray-500 hover:text-orange-600"><span class="material-icons text-xl">arrow_upward</span></button>
            <button class="text-gray-500 hover:text-blue-600 mt-1"><span class="material-icons text-xl">arrow_downward</span></button>
        </div>
        <div class="content-section">
            <div class="flex items-center text-xs text-gray-500 mb-2">
                <img alt="Class avatar" class="w-5 h-5 rounded-full mr-2" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuO-soE5GfMsxl8xZ13qDPa06Ja7bt2njlGOrvOl9UjdRZaKDWjRq13cCm7nTjrgEJlJi9rlA4HbhOn2G-odLzjf2pbk4b0iZbAvUKYDo80N1qYe_BUzDnF5-BUzRSOs3iBki_Ty2Xuj6T0VazxG7JDbGCLb1fORBPt3i70gs2whAUgp0lEKlFOi6ZKAHuqfpORtDhXqcV4AYoAVDRfLQvuFxLFysja4xfA9pSrF6lP_QnENT4kcAOMwPID1PjCa6WG-soH9rF7wU"/>
                <span class="font-bold text-black mr-1">
                    <?= $row['category'] === 'coding' ? 'c/' . htmlspecialchars($row['title']) : 'l/' . htmlspecialchars($row['title']) ?>
                </span>
                <span>Posted on <?= date("M d, Y", strtotime($row['created_at'])) ?></span>
            </div>
            <h3 class="text-lg font-medium mb-2"><?= htmlspecialchars($row['title']) ?></h3>
            <?php
                $preview = substr(strip_tags($row['content']), 0, 1500); // first 150 chars
                if (strlen($row['content']) > 1500) {
                    $preview .= "...";
                }
            ?>
            <p class="text-gray-700 text-sm mb-3"><?= htmlspecialchars($preview) ?></p>

            <?php if (!empty($row['image'])): ?>
                <img class="w-full h-auto object-cover rounded-md max-h-80"
                     src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="Course Image"/>
            <?php endif; ?>
            <!-- to show case level of each classes -->
            <div class="flex items-center gap-4 mt-3 text-gray-500 text-sm">
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    <?= $row['level'] === 'beginner' ? 'bg-green-200 text-green-700' : 
                        ($row['level'] === 'elementary' ? 'bg-blue-200 text-blue-700' :
                        ($row['level'] === 'pre-intermediate' ? 'bg-purple-200 text-purple-700' :
                        ($row['level'] === 'intermediate' ? 'bg-yellow-200 text-yellow-700' : 'bg-red-200 text-red-700'))) ?>">
                    <?= ucfirst($row['level']) ?>
                </span>
            </div>
            <!-- View Detail Button -->
            <div class="mt-3">
                <a href="detailPage.php?id=<?= $row['id'] ?>&category=<?= $row['category'] ?>"
                class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                    View Detail
                </a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
<?php else: ?>
    <p class="text-gray-500">No courses available.</p>
<?php endif; ?>
</div>
<!-- POST FEED END -->

</main>
    <aside>
    <div class="bg-white rounded-md border border-gray-300">
        <div class="p-3 border-b border-gray-200 bg-gray-50 rounded-t-md">
            <h4 class="font-semibold text-gray-800">Class Categories</h4>
        </div>
        <div class="p-3">
        <ul class="space-y-2">
            <li>
            <a class="flex items-center p-2 text-gray-700 rounded-md bg-orange-100 border-l-4 border-orange-500" href="#">
            <span class="material-icons text-orange-600 mr-3">code</span>
            <span class="font-semibold text-sm">Coding Classes</span>
            </a>
            </li>
            <li>
            <a class="flex items-center p-2 text-gray-600 hover:bg-gray-100 rounded-md" href="#">
            <span class="material-icons mr-3">translate</span>
            <span class="text-sm font-medium">Language Classes</span>
            </a>
            </li>
        </ul>
        </div>
    </div>
    <div class="bg-white rounded-md border border-gray-300 mt-6">
        <div class="p-3 border-b border-gray-200">
            <h4 class="font-semibold">Popular Classes</h4>
        </div>
        <div class="p-3">
            <ul class="space-y-3">
                <li class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-lg font-bold mr-3">1</span>
                        <img alt="Class avatar" class="w-8 h-8 rounded-full mr-3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuO-soE5GfMsxl8xZ13qDPa06Ja7bt2njlGOrvOl9UjdRZaKDWjRq13cCm7nTjrgEJlJi9rlA4HbhOn2G-odLzjf2pbk4b0iZbAvUKYDo80N1qYe_BUzDnF5-BUzRSOs3iBki_Ty2Xuj6T0VazxG7JDbGCLb1fORBPt3i70gs2whAUgp0lEKlFOi6ZKAHuqfpORtDhXqcV4AYoAVDRfLQvuFxLFysja4xfA9pSrF6lP_QnENT4kcAOMwPID1PjCa6WG-soH9rF7wU"/>
                        <div>
                            <p class="font-semibold text-sm">c/WebDesign</p>
                        </div>
                    </div>
                    <button class="border border-orange-600 text-orange-600 px-3 py-1 rounded-full text-sm font-semibold hover:bg-orange-600 hover:text-white transition-colors">View</button>
                </li>
                <li class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-lg font-bold mr-3">2</span>
                        <img alt="Class avatar" class="w-8 h-8 rounded-full mr-3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCw_-qmlAe11Gf92fIkRukcqaOrHMAnxfhfenkq5SIgHZluys43vbGKJqeCPUH6lJARltp4o966uErN4Cd3wwOwmnLP7K-Y_xlJZpNbVZRWoCd1QXP72DB9ftPXr78FqTLLGUxmOiWSD0mTwmJHabxl72o8behKiaduKWUbpc8Du6Jq4C-1D8kQYsOcImQUR61rIZUKa_W_JU5YRr3obAapvJ5g5UMe9Z8Hrh8aW5DERsXyVhKcv1S-_ppzdfjEU1Wyq73peyd3sq8"/>
                        <div>
                            <p class="font-semibold text-sm">c/Python</p>
                        </div>
                    </div>
                    <button class="border border-orange-600 text-orange-600 px-3 py-1 rounded-full text-sm font-semibold hover:bg-orange-600 hover:text-white transition-colors">View</button>
                </li>
                <li class="flex items-center justify-between">
                    <div class="flex items-center">
                            <span class="text-lg font-bold mr-3">3</span>
                            <img alt="Class avatar" class="w-8 h-8 rounded-full mr-3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCw_-qmlAe11Gf92fIkRukcqaOrHMAnxfhfenkq5SIgHZluys43vbGKJqeCPUH6lJARltp4o966uErN4Cd3wwOwmnLP7K-Y_xlJZpNbVZRWoCd1QXP72DB9ftPXr78FqTLLGUxmOiWSD0mTwmJHabxl72o8behKiaduKWUbpc8Du6Jq4C-1D8kQYsOcImQUR61rIZUKa_W_JU5YRr3obAapvJ5g5UMe9Z8Hrh8aW5DERsXyVhKcv1S-_ppzdfjEU1Wyq73peyd3sq8"/>
                        <div>
                            <p class="font-semibold text-sm">c/GraphicDesign</p>
                        </div>
                    </div>
                    <button class="border border-orange-600 text-orange-600 px-3 py-1 rounded-full text-sm font-semibold hover:bg-orange-600 hover:text-white transition-colors">View</button>
                </li>
            </ul>
        </div>
        <div class="p-3">
            <button class="bg-orange-600 text-white w-full py-2 rounded-full font-semibold">View All</button>
        </div>
    </div>
    </aside>
</div>
<footer class="bg-white mt-6 shadow-t-sm">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">About</h3>
                <ul class="mt-4 space-y-2">
                    <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">About CourseForum</a></li>
                    <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Careers</a></li>
                    <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Press</a></li>
                </ul>
            </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Help</h3>
            <ul class="mt-4 space-y-2">
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Help Center</a></li>
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Admin Policies</a></li>
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Contact Us</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Tools</h3>
            <ul class="mt-4 space-y-2">
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Mobile Apps</a></li>
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Site Map</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Legal</h3>
            <ul class="mt-4 space-y-2">
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">User Agreement</a></li>
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Privacy Policy</a></li>
                <li><a class="text-base text-gray-500 hover:text-gray-900" href="#">Content Policy</a></li>
            </ul>
        </div>
</div>
<div class="mt-8 border-t border-gray-200 pt-8">
<p class="text-base text-gray-400 text-center">© 2024 CourseForum, Inc. All rights reserved.</p>
</div>
</div>
</footer>

<!-- JS for filtering posts -->
<script>
const tabs = {
    all: document.getElementById('tab-all'),
    coding: document.getElementById('tab-coding'),
    language: document.getElementById('tab-language')
};

const posts = document.querySelectorAll('.post-card');

// Remove active from all, then add to clicked tab
function setActiveTab(activeTab) {
  Object.values(tabs).forEach(tab => {
    tab.classList.remove('text-orange-600', 'border-b-2', 'border-orange-600');
    tab.classList.add('text-gray-500');
  });
   const tab = tabs[activeTab];
  tab.classList.remove('text-gray-500');
  tab.classList.add('text-orange-600', 'border-b-2', 'border-orange-600');
}

function filterPosts(category) {
    posts.forEach(post => {
        post.style.display = (category === 'all' || post.dataset.category === category) ? 'flex' : 'none';
    });
}

// Add click events
tabs.all.addEventListener('click', () => { filterPosts('all'); setActiveTab('all'); });
tabs.coding.addEventListener('click', () => { filterPosts('coding'); setActiveTab('coding'); });
tabs.language.addEventListener('click', () => { filterPosts('language'); setActiveTab('language'); });
</script>

</body>
</html>

<?php $conn->close(); ?>
