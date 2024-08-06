<?php

// Include the database connection
include 'connection.php'; // Ensure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $model_number = mysqli_real_escape_string($con, $_POST['model_number']);
    $processor = mysqli_real_escape_string($con, $_POST['processor']);
    $ip_address = mysqli_real_escape_string($con, $_POST['ip_address']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $process = mysqli_real_escape_string($con, $_POST['process']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $memory = mysqli_real_escape_string($con, $_POST['memory']);
    $serial_number = mysqli_real_escape_string($con, $_POST['serial_number']);
    $assigned_to = mysqli_real_escape_string($con, $_POST['assigned_to']);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO server (model_number, processor, ip_address, location, process, status, memory, serial_number, assigned_to, createdAt) 
            VALUES ('$model_number', '$processor', '$ip_address', '$location', '$process', '$status', '$memory', '$serial_number', '$assigned_to', CURRENT_TIMESTAMP())";

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