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
    if($_SERVER['REQUEST_METHOD']==='POST'){
    

    //collect form data from register.html form
    $fullName=$_POST['fullName'];
    $email=$_POST['email'];
    $class=$_POST['classOptions'];
    $password=$_POST['password'];
    $confirmPass=$_POST['confirmPassword'];
    $expectation=$_POST['expectation'];

    //checking if new password match confrimpassword
    if($password !== $confirmPass){
        die("Passwords do not match!");
    }

    // encryption=> hash password before storing
    $hashedPassword=password_hash($password,PASSWORD_DEFAULT);

   // Ensure $studentCard is at least an empty string if no file uploaded
    $studentCard = isset($_FILES['studentCard']) && $_FILES['studentCard']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['studentCard']['tmp_name'])
    : "";

    // s → string
    // i → integer
    // d → double (float)
    // b → blob (binary data, like images or files)
    //insert into database
    $sql="INSERT INTO users (email,name,password,class,student_card,expectation,status) VALUES (?,?,?,?,?,?,'accept')";
    $stmt=$conn->prepare($sql);
    // bind all 6 params as strings for now
    $stmt->bind_param("ssssss", $email, $fullName, $hashedPassword, $class, $studentCard, $expectation);

    // If the blob is not empty, send it
    if(!empty($studentCard)){
        $stmt->send_long_data(4, $studentCard); // index 4 = 5th param = student_card
    }
    if($stmt->execute()){
        echo"New user added successfully";
        
        header("Location: /PHP_project/FourthYearDatabaseProject/OnlineClassForum/views/admin/adminUserPanel.php?tab=accepted");
        exit();

    }else{
        echo "Error".$stmt->error;
    }

    $stmt->close();
    $conn->close();

    }