<?php
require("connection.php");
?>
<html>
<head>
    <title>ADMIN LOGIN PANEL</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjxIIvE5QZmVoXW8pHgtBsmT92w2GZTfjK3/3U6A+AGDVB7PyX9f+d" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="mycss.css">


</style>

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
        header("Location: index.php");
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
<style>
        body {
            background: linear-gradient(135deg, #3498db, #8e44ad);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: #fff;
        }

        .login-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .login-form h2 {
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 28px;
            color: #ffffff;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #aaa;
        }

        .input-field input {
            width: calc(100% - 40px);
            padding: 10px 20px 10px 40px;
            border: 2px solid transparent;
            border-radius: 25px;
            outline: none;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 16px;
        }

        .input-field input::placeholder {
            color: #ddd;
        }

        .input-field input:focus {
            border-color: #fff;
        }

        .login-form button {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-radius: 25px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-form button:hover {
            background-color: #2980b9;
        }

        .extra {
            margin-top: 20px;
        }

        .extra a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .extra a:hover {
            color: #ddd;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @media (max-width: 480px) {
            .login-form {
                padding: 20px;
            }

            .login-form h2 {
                font-size: 24px;
            }

            .input-field input {
                font-size: 14px;
            }

            .login-form button {
                font-size: 14px;
            }
        }
    </STYLE>