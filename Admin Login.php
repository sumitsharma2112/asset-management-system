<?php
require("Connection.php");
?>
<html>
<head>
    <title>ADMIN LOGIN PANEL</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjxIIvE5QZmVoXW8pHgtBsmT92w2GZTfjK3/3U6A+AGDVB7PyX9f+d" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="mycss.css">
</head>
<body>
    <div class="login-form">
        <h2>ADMIN LOGIN PANEL</h2>
        <form method="POST">
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Admin Name" name="AdminName">
            </div>

            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name="AdminPassword">
            </div>

            <button type="submit" name="Signin">Sign In</button>

            <div class="extra">
                <a href="#">Forgot Password ?</a>
            </div>
        </form>
    </div>

<?php

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['Signin'])) {
    // Prepare and bind
    $stmt = $con->prepare("SELECT * FROM `admin_login` WHERE `Admin_Name` = ? AND `Admin_Password` = ?");
    
    // Check if preparation was successful
    if ($stmt === false) {
        die("Prepare failed: " . $con->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $_POST['AdminName'], $_POST['AdminPassword']);

    // Execute the statement
    $stmt->execute();

    // Store result
    $stmt->store_result();

    // Check if a matching row is found
    if ($stmt->num_rows == 1) {
        session_start();
        $_SESSION['AdminLoginId'] = $_POST['AdminName'];
        header("Location: Admin Panel.php");
        exit();
    } else {
        echo "<script>alert('Incorrect Password');</script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$con->close();

// if(isset($_POST['Signin']))
// {
//     $query = "SELECT * FROM `admin_login` WHERE `Admin_Name`=`$_POST[AdminName]` AND `Admin_Password`=`$_POST[AdminPassword]`";

//     $result = mysqli_query($con, $query);
    
//     if(mysqli_num_rows($result)==1)
//     {
//         session_start();
//         $_SESSION['AdminLoginId'] = $_POST['AdminName'];
//         header("location: Admin Panel.php");
//     }
//     else
//     {
//         echo"<script>alert('Incorrect Password');</script>";
//     }
// }

?>

</body>
</html>