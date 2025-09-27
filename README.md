# OnlineClassForum — Database setup & connection

This README explains how the project connects to the MySQL database, how to import the provided SQL, how to test the connection, and small recommended improvements.

## Files
- Database config: `app/config/db.php` (intended single place to create `$conn`).
- SQL dump: `database/onlineclass_forum.sql` (import into your MySQL server).
- Quick test page: `public/test_db.php` (verifies the connection in a browser).

Important note about the current codebase:

This project currently contains many PHP files that open their own `mysqli` connections inline (for example in `views/` and `app/models/`). That means simply editing `app/config/db.php` alone won't change those files — they must be updated to include the centralized config. The sections below explain how to migrate and the recommended include paths depending on the file location.

## Prerequisites
- XAMPP or another PHP + MySQL environment installed and running.
- PHP with mysqli extension enabled (XAMPP enables it by default).

## Import database
1. Using phpMyAdmin: open http://localhost/phpmyadmin, create database `onlineclass_forum` (if not present), then import `database/onlineclass_forum.sql`.
2. Using MySQL CLI (from PowerShell):

```powershell
mysql -u root -p; # enter password when prompted (press Enter if empty)
CREATE DATABASE IF NOT EXISTS onlineclass_forum; USE onlineclass_forum; SOURCE "${PWD}\database\onlineclass_forum.sql";
```

Note: adjust username/password if your setup differs.

## Testing the connection
1. Start Apache & MySQL in XAMPP.
2. Open your browser and visit:

```
http://localhost/OnlineClassForum/public/test_db.php
```

If the connection works you'll see "Database connection successful." If it fails you'll see the MySQL error text.

## Does the current `app/config/db.php` work?
Short answer: Yes — `app/config/db.php` is a fine centralized config and will work in a typical XAMPP setup if MySQL is running and credentials match. However, because many files in this repository still open their own connections, you should either:

- Update those files to `require_once` the centralized `app/config/db.php`, or
- Leave them unchanged (not recommended) and maintain credentials in each file separately.

Common gotchas:
- If MySQL isn't running, connection will fail.
- If `mysqli` PHP extension is disabled, it will fail (check `phpinfo()`).
- Using `localhost:3306` as the `host` string usually works, but it's cleaner to use `127.0.0.1` with the `port` argument or just `localhost`.

Recommended, more robust snippet for `app/config/db.php` (optional update):

```php
<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'onlineclass_forum';
$db_port = 3306;

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
```

This separates host and port and avoids edge cases with socket/host parsing.

How to migrate existing files to the centralized config
1. Find files that create a `new mysqli(...)`. You can search for the string `new mysqli`.
2. Replace the duplicated block with a single `require_once` that points to `app/config/db.php`. Use the correct relative path depending on the file location:

- From files in `app/models/` use:

    ```php
    require_once __DIR__ . '/../config/db.php';
    ```

- From files in `views/` use:

    ```php
    require_once __DIR__ . '/../../app/config/db.php';
    ```

- From files in `public/` use:

    ```php
    require_once __DIR__ . '/../app/config/db.php';
    ```

Example replacement (manual connection -> use centralized config):

Before:

```php
$db_server = "localhost:3306";
$db_user = "root";
$db_pass = "";
$db_name   = "onlineclass_forum";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
```

After:

```php
require_once __DIR__ . '/../../app/config/db.php'; // adjust relative path as needed
```

Note: adjust the relative path example above according to the file's directory.

## Troubleshooting
- Check XAMPP control panel: Apache and MySQL must be running.
- Confirm credentials in `app/config/db.php` match your MySQL user.
- Try connecting from a simple PHP script (see `public/test_db.php`).
- Check PHP error log and Apache error log in XAMPP for detailed errors.

## Project structure
```
index.php
README.md
app/
    config/
        db.php
    controllers/
        LoginController.php
        RegisterController.php
    models/
        adminCodePostCreate.php
        adminCodePostDelete.php
        adminCodePostEdit.php
        adminInsertUser.php
        adminLanPostCreate.php
        adminLanPostDelete.php
        adminLanPostEdit.php
        checkLoginPage.php
        deleteAcceptUser.php
        deleteSuggestion.php
        insertRegisterPage.php
        submitSuggestion.php
        updateAcceptUser.php
        updateDenyUser.php
        updatePendingUserStatus.php
        userLogOut.php
database/
    onlineclass_forum.sql
public/
    test_db.php
    css/
        main.css
    images/
        registerPoster1.jpg
        registerPoster2.jpg
        registerPoster3.jpg
    js/
        signin.js
    uploads/
        student_cards/
            (image files...)
views/
    admin/
        adminCodePostCreate.php
        adminCodePostDetail.php
        adminCodePostEdit.php
        adminCodePostView.php
        adminLanPostCreate.php
        adminLanPostDetail.php
        adminLanPostEdit.php
        adminLanPostView.php
        adminLogout.php
        adminSuggestion.php
        adminUserInsert.php
        adminUserPanel.php
        test.php
    user/
        detailPage.php
        loginPage.php
        main.php
        postTest.php
        registerPage.php
        userLogout.php
        userSavePosts.php
        userSuggestion.php
```

## Quick contract (what this README helps you do)
- Inputs: XAMPP running, `database/onlineclass_forum.sql` present, `app/config/db.php` configured.
- Output: A working `mysqli` connection exposed as `$conn`.
- Error modes: will `die()` with the connection error message if connect fails.

---
