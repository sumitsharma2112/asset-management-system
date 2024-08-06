<?php

// Include the database connection
include 'connection.php'; // Ensure this path is correct

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $model_number = isset($_POST['model_number']) ? mysqli_real_escape_string($con, $_POST['model_number']) : '';
    $device_id = isset($_POST['device_id']) ? mysqli_real_escape_string($con, $_POST['device_id']) : '';
    $user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($con, $_POST['user_id']) : '';
    $device_name = isset($_POST['device_name']) ? mysqli_real_escape_string($con, $_POST['device_name']) : '';
    $os = isset($_POST['os']) ? mysqli_real_escape_string($con, $_POST['os']) : '';
    $os_version = isset($_POST['os_version']) ? mysqli_real_escape_string($con, $_POST['os_version']) : '';
    $memory = isset($_POST['memory']) ? mysqli_real_escape_string($con, $_POST['memory']) : '';
    $serial_number = isset($_POST['serial_number']) ? mysqli_real_escape_string($con, $_POST['serial_number']) : '';
    $assigned_to = isset($_POST['assigned_to']) ? mysqli_real_escape_string($con, $_POST['assigned_to']) : '';

    // Prepare the SQL query
    $sql = "INSERT INTO mobile_devices (model_number, device_id, user_id, device_name, os, os_version, memory, serial_number, assigned_to, createdAt) 
            VALUES ('$model_number', '$device_id', '$user_id', '$device_name', '$os', '$os_version', '$memory', '$serial_number', '$assigned_to', CURRENT_TIMESTAMP())";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
} else {
    echo "Invalid request method.";
}
?>
