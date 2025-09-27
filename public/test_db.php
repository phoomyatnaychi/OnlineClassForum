<?php
// Quick database connection test for browser
require_once __DIR__ . '/../app/config/db.php';

// If db.php dies on failure, you'll see that message already. If it didn't die,
// check the $conn object.
if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    echo "Database connection successful.";
} else {
    // If db.php used die() on error this code may not run; still attempt to report.
    $err = isset($conn->connect_error) ? $conn->connect_error : 'unknown error';
    echo "Database connection failed: " . htmlspecialchars($err);
}
