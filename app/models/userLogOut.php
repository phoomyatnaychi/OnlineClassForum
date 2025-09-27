<?php
session_start();

// Clear all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/user/loginPage.php");
exit;
?>
