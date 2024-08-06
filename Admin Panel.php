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
    <title>Admin Panel</title>



    <style>
        body{
            margin: 0px;
        }
        div.header{
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: #204969;
            color: #fff;
        }
        div.header button{
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            text-align: center;
        }

        button {
            padding: 12px 24px;
            margin: 10px;
            border: none;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(1);
        }

        .form-container {
            display: none;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }


        input[type="submit"]:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        input[type="submit"]:active {
            transform: scale(1);
        }
        .button-container {
    display: flex;
    justify-content: flex-end; /* Align buttons to the right */
    margin-top: 20px;
}

input[type="submit"] {
    padding: 12px;
    border: none;
    background-color: #28a745;
    color: white;
    border-radius: 15px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s, transform 0.2s;
    margin-right: 10px; /* Space between submit and go-back button */
}

button.go-back {
    width: 150px; /* Set the desired width */
    padding: 8px 12px;
    border-radius: 15px;
    background-color: #6c757d;
    border: none;
    font-size: 16px;
}

button.go-back:hover {
    background-color: #5a6268;
    }

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: #fff;
    padding: 15px; /* Reduced padding for smaller form */
    border-radius: 5px;
    width: 90%;
    max-width: 300px; /* Reduced max-width for smaller modal */
    position: relative;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); /* Lighter shadow */
    overflow: hidden; /* Prevent overflow */
}

.close {
    position: absolute;
    top: 5px; /* Reduced top position */
    right: 5px; /* Reduced right position */
    font-size: 14px; /* Smaller close button */
    cursor: pointer;
    color: #333;
}

.modal-content h2 {
    margin-top: 0;
    font-size: 18px; /* Smaller heading size */
    margin-bottom: 10px; /* Reduced margin */
}

form {
    font-size: 0px; /* Smaller font size for the form */
}

label {
    display: block;
    margin-bottom: 5px; /* Reduced margin between labels */
}

input[type="text"] {
    width: 100%;
    padding: 8px; /* Reduced padding inside input fields */
    margin-bottom: 10px; /* Space between input fields */
    font-size: 14px; /* Smaller font size for input fields */
}

input[type="submit"] {
    padding: 8px 15px; /* Adjusted padding for submit button */
    font-size: 14px; /* Smaller font size for submit button */
}
    </style>


     <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


</head>
<body>


    <div class = "header">
    <h1>WELCOME TO ADMIN PANEL(ASSET-MANAGEMENT-SYSTEM) - <?php echo $_SESSION['AdminLoginId']?></h1> 
    <form method="POST">
    <button name="Logout" style="color: #000;">LOG OUT</button>
    </form>
    </div>
    


<div class="container">
        <button onclick="showForm('laptop')">Laptop</button>
        <button onclick="showForm('charger')">Charger</button>
        <button onclick="showForm('harddisk')">Hard Disk</button>
        <button onclick="showForm('server')">Server</button>
        <button onclick="showForm('mobile')">Mobile</button>
        <button onclick="openModal('assign')">Assigned Asset</button>
        <button onclick="openModal('return')">Return Asset</button>
        
        <div id="forms">
            <div id="laptop" class="form-container">
                <h2>Laptop Detail</h2>
                <form id="laptop-form" method="post" action="process_form.php">
                <label>Asset Name: <input type="text" name="asset_name" required></label>
                <label>Model Number: <input type="text" name="model_number" required></label>
                <label>Serial Number: <input type="text" name="serial_number" required></label>
                <label>Processor Name: <input type="text" name="processor_name"></label>
                <label>Operating System: <input type="text" name="operating_system"></label>
                <label>Ram: <input type="text" name="ram"></label>
                <label>Rom: <input type="text" name="rom"></label>
                <label>Keyboard: <input type="text" name="keyboard"></label>
                <label>Mouse: <input type="text" name="mouse"></label>
                <label>Assigned To: <input type="text" name="assigned_to"></label>
                <input type="submit" value="Submit">
                <button type="button" class="go-back" onclick="goBack()">Back to Page</button>
                </form>
            </div>
            
            <div id="charger" class="form-container">
                <h2>Charger Detail</h2>
                <form id="charger-form" action="submit_charger.php" method="POST">
                <label>Serial Number: <input type="text" name="serial_number" required></label>
                <label>Wattage: <input type="text" name="wattage"></label>
                <label>Asset Company Name: <input type="text" name="company_name"></label>
                <label>Assigned To: <input type="text" name="assigned_to"></label>
                <input type="submit" value="Submit">
                <button type="button" class="go-back" onclick="goBack()">Back to Page</button>
                </form>
            </div>
            
            <div id="harddisk" class="form-container">
                <h2>Hard Disk Detail</h2>
                <form id="harddisk-form" action="submit_harddisk.php" method="post">
                <label>Model Number: <input type="text" name="model_number" required></label>
                <label>Capacity: <input type="text" name="capacity"></label>
                <label>RPM: <input type="text" name="rpm"></label>
                <label>Serial Number: <input type="text" name="serial_number" required></label>
                <label>Assigned To: <input type="text" name="assigned_to"></label>
                <input type="submit" value="Submit">
                <button type="button" class="go-back" onclick="goBack()">Back to Page</button>
                </form>
            </div>
            
            <div id="server" class="form-container">
                <h2>Server Detail</h2>
                <form id="server-form" action="submit_server.php" method="post">
                <label>Model Number: <input type="text" name="model_number" required></label>
                <label>Processor: <input type="text" name="processor"></label>
                <label>IP Address: <input type="text" name="ip_address"></label>
                <label>Location: <input type="text" name="location"></label>
                <label>Process: <input type="text" name="process"></label>
                <label>Status: <input type="text" name="status"></label>
                <label>Memory: <input type="text" name="memory"></label>
                <label>Serial Number: <input type="text" name="serial_number" required></label>
                <label>Assigned To: <input type="text" name="assigned_to"></label>
                <input type="submit" value="Submit">
                <button type="button" class="go-back" onclick="goBack()">Back to Page</button>
                </form>
            </div>

            <div id="mobile" class="form-container">
                <h2>Mobile Detail</h2>
                <form id="mobile-form" action="process_mobile_form.php" method="post">
                <label>Model Number: <input type="text" name="model_number" required></label>
                <label>device_id: <input type="text" name="processor"></label>
                <label>user_id: <input type="text" name="ip_address"></label>
                <label>device_name: <input type="text" name="location"></label>
                <label>os: <input type="text" name="process"></label>
                <label>os_version: <input type="text" name="status"></label>
                <label>Memory: <input type="text" name="memory"></label>
                <label>Serial Number: <input type="text" name="serial_number" required></label>
                <label>Assigned To: <input type="text" name="assigned_to"></label>
                <input type="submit" value="Submit">
                <button type="button" class="go-back" onclick="goBack()">Back to Page</button>
                </form>
            </div>
        </div>
    </div>

    <div id="assign-modal" class="modal">
        <div class="modal-content">
                <span class="close" onclick="closeModal('assign')">&times;</span>
                <h2>Assign Asset</h2>
                <form id="assign-form" action="Assigned_form.php" method="post">
                <label>Asset Name: <input type="text" name="asset_name" required></label><br>
                <label>Employee Name: <input type="text" name="emp_name" required></label><br>
                <label>Phone Number: <input type="text" name="emp_number" required></label><br>
                <label>Employee Address <input type="text" name="emp_address" required></label><br>
                <label>Assigned Date: <input type="text" name="assigned_date" required></label><br>
                <input type="submit" value="Submit">
                </form>
        </div>
    </div>

    <!-- Return Asset Modal -->
    <div id="return-modal" class="modal">
        <div class="modal-content">
                <span class="close" onclick="closeModal('return')">&times;</span>
                <h2>Return Asset</h2>
                <form id="return-form" action="process_return.php" method="post">
                <label>Returned By: <input type="text" name="emp_name" required></label><br>
                <label>Asset Name: <input type="text" name="asset_name" required></label><br>
                <label>Phone Number: <input type="text" name="emp_number" required></label><br>
                <label>Employee Address <input type="text" name="emp_address" required></label><br>
                <label>Returned Date: <input type="text" name="returned_by" required></label><br>
                <input type="submit" value="Submit">
                </form>
        </div>
    </div>

    <script>
            function openModal(modalId) {
            document.getElementById(modalId + '-modal').style.display = 'flex';
            }

            function closeModal(modalId) {
            document.getElementById(modalId + '-modal').style.display = 'none';
            }

             // Close modal when clicking outside of it
             window.onclick = function(event) {
             if (event.target.classList.contains('modal')) {
                 event.target.style.display = 'none';
             }
            }
    </script>


    <script>
            const formDataStorage = {};

            function showForm(formId) {
            document.querySelectorAll('.form-container').forEach(form => {
                form.style.display = 'none';
            });
            document.getElementById(formId).style.display = 'block';
            }

            function goBack() {
            document.querySelectorAll('.form-container').forEach(form => {
                form.style.display = 'none';
             });
            }

    </script>
</body>
</html>