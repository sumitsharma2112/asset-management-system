<?php
session_start();
if(!isset($_SESSION['AdminLoginId']))
{
header("location: Admin Login.php");
}
?>
<?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: Admin Login.php");
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Management System</title>
    <style>
        /* New CSS Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .header-container {
            background-color: #2c3e50;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .header {
            display: flex;  /* Use Flexbox for layout */
            justify-content: space-between;  /* Align items with space between */
            align-items: center;  /* Center items vertically */
            max-width: 1200px;
            margin: 0 auto;
        }

        header nav {
            display: flex;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;  /* Align navigation items horizontally */
            gap: 20px;  /* Space between menu items */
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #f39c12;
            color: #fff;
        }

        .header form {
            margin: 0;  /* Remove default form margin */
        }

        .header button {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 16px;
            border: 2px solid black;
            border-radius: 5px;
            cursor: pointer;  /* Change cursor to pointer on hover */
            transition: background-color 0.3s ease, color 0.3s ease;  /* Smooth transition for hover effects */
        }

        /* Hover effect for button */
        .header button:hover {
            background-color: #ddd;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background: linear-gradient(to right, #ffffff, #f9f9f9);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form select,
        form input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        form input[type="text"]:focus,
        form input[type="number"]:focus,
        form input[type="date"]:focus,
        form select:focus {
            border-color: #3498db;
            outline: none;
        }

        form input[type="submit"] {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #34495e;
            transform: scale(1.05);
        }

        form input[type="file"] {
            border: none;
        }

        form input[type="file"]::file-selector-button {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form input[type="file"]::file-selector-button:hover {
            background-color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #2c3e50;
            color: white;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav ul {
                flex-direction: column;
                align-items: flex-start;
            }

            nav ul li {
                display: block;
                margin-bottom: 10px;
            }

            .header button {
                align-self: flex-end;
            }
        }

    </style>

</head>
<body>
    <header>
    <div class="header-container">
        <div class="header">
            <header>
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="view_assets.php">View Assets</a></li>
                        <li><a href="add_asset.php">Add Asset</a></li>
                        <li><a href="assign_asset.php">Assign Asset</a></li>
                        <li><a href="view_assignments.php">View Assignments</a></li>
                    </ul>
                </nav>
            </header>
            <form method="POST">
                <button name="Logout" style="color: #000;">LOG OUT</button>
            </form>
        </div>
    </div>
       
    </header>
    <main>
