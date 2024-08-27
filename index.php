<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Management System</title>
    <link rel="stylesheet" href="/asset/css/styles.css"> <!-- Path to CSS file -->
<style>
    .maintenance {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 20px;
    margin: 20px 0;
    border-radius: 8px;
    font-family: Arial, sans-serif;
}

/* Heading Styling */
.maintenance h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 15px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

/* Paragraph Styling */
.maintenance p {
    color: #555;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* List Styling */
.maintenance ul {
    list-style-type: disc;
    padding-left: 20px;
}

.maintenance li {
    color: #333;
    font-size: 16px;
    margin-bottom: 10px;
    line-height: 1.6;
}

/* Emphasis on Important Text */
.maintenance li strong {
    color: #007bff;
}

/* Additional Styling */
.maintenance li:before {
    content: "•";
    color: #007bff;
    font-weight: bold;
    display: inline-block;
    width: 20px;
    margin-left: -20px;
}

.maintenance li:hover {
    background-color: #e9f5ff;
    border-radius: 5px;
    padding: 5px;
}

</style>

</head>
<body>

<?php
include('config/database.php');
include('templates/header.php');
?>
<br>
<div style="text-align: center;">
<p>Manage office assets efficiently with this system. Use the navigation links above to manage assets and assignments.</p>

</div><br>
<section class="maintenance">
    <h2>Asset Maintenance and Care</h2>
    <p>Proper maintenance of assets is crucial to extending their lifespan and ensuring they perform optimally. Please adhere to the following guidelines:</p>
    <ul>
        <li>*Regular Checks*: Periodically check the condition of your assets and report any wear and tear.</li>
        <li>*Scheduled Maintenance*: Follow any maintenance schedules provided for your assets.</li>
        <li>*Safe Storage*: Store your assets safely when not in use to prevent damage or loss.</li>
        <li>*Cleaning*: Keep your assets clean and free from dust and debris.</li>
    </ul>
</section>
<?php
include('templates/footer.php');
?>
</body>
</html>








