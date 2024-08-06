<?php

// Include the database connection
include 'connection.php'; // Ensure this path is correct

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $emp_name = isset($_POST['emp_name']) ? mysqli_real_escape_string($con, $_POST['emp_name']) : '';
    $asset_name = isset($_POST['asset_name']) ? mysqli_real_escape_string($con, $_POST['asset_name']) : '';
    $emp_number = isset($_POST['emp_number']) ? mysqli_real_escape_string($con, $_POST['emp_number']) : '';
    $emp_address = isset($_POST['emp_address']) ? mysqli_real_escape_string($con, $_POST['emp_address']) : '';
    $returned_date = isset($_POST['returned_date']) ? mysqli_real_escape_string($con, $_POST['returned_date']) : '';

    // Prepare the SQL query
    $sql = "INSERT INTO returns (emp_name, asset_name, emp_number, emp_address, returned_date, created_at) 
            VALUES ('$emp_name', '$asset_name', '$emp_number', '$emp_address', '$returned_date', CURRENT_TIMESTAMP())";

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
