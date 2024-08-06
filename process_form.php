<?php
// Include the database connection
include 'connection.php'; // Ensure this path is correct

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $asset_name = isset($_POST['asset_name']) ? mysqli_real_escape_string($con, $_POST['asset_name']) : '';
    $model_number = isset($_POST['model_number']) ? mysqli_real_escape_string($con, $_POST['model_number']) : '';
    $serial_number = isset($_POST['serial_number']) ? mysqli_real_escape_string($con, $_POST['serial_number']) : '';
    $processor_name = isset($_POST['processor_name']) ? mysqli_real_escape_string($con, $_POST['processor_name']) : '';
    $operating_system = isset($_POST['operating_system']) ? mysqli_real_escape_string($con, $_POST['operating_system']) : '';
    $ram = isset($_POST['ram']) ? mysqli_real_escape_string($con, $_POST['ram']) : '';
    $rom = isset($_POST['rom']) ? mysqli_real_escape_string($con, $_POST['rom']) : '';
    $keyboard = isset($_POST['keyboard']) ? mysqli_real_escape_string($con, $_POST['keyboard']) : '';
    $mouse = isset($_POST['mouse']) ? mysqli_real_escape_string($con, $_POST['mouse']) : '';
    $assigned_to = isset($_POST['assigned_to']) ? mysqli_real_escape_string($con, $_POST['assigned_to']) : '';

    // Prepare the SQL query
    $sql = "INSERT INTO laptop (asset_name, model_number, serial_number, processor_name, operating_system, ram, rom, keyboard, mouse, assigned_to) 
            VALUES ('$asset_name', '$model_number', '$serial_number', '$processor_name', '$operating_system', '$ram', '$rom', '$keyboard', '$mouse', '$assigned_to')";

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
