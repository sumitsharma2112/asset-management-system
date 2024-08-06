<?php

// Include the database connection
include 'connection.php'; // Make sure this is the correct path

$insert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $serial_number = $_POST['serial_number'];
    $wattage = $_POST['wattage'];
    $company_name = $_POST['company_name'];
    $assigned_to = $_POST['assigned_to'];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO charger (serial_number, wattage, company_name, assigned_to, createdAt) 
            VALUES ('$serial_number', '$wattage', '$company_name', '$assigned_to', CURRENT_TIMESTAMP())";

    if (mysqli_query($con, $sql)) {
        $insert = true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
}
?>