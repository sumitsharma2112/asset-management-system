<?php
include('config/database.php');

// Check if the download button was clicked
if (isset($_POST['download_excel'])) {
    // Set the headers to download the file as Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=assignments.xls");

    // Output the table headers
    echo "Name\tEmployee ID\tMobile Number\tEmail Id\tDepartment\tDesignation\tDate Of Joining\tResidence Location\tGender\tPAN Number\n";

    // Fetching data from the database
    try {
        $stmt = $pdo->query('SELECT * FROM Asset_Assignments');
        $assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error retrieving assets: " . $e->getMessage());
    }

    // Output the data in each row
    foreach ($assets as $asset) {
        echo $asset['full_name'] . "\t" . $asset['employee_id'] . "\t" . $asset['mobile_number'] . "\t" . $asset['email_id'] . "\t" . 
             $asset['department'] . "\t" . $asset['designation'] . "\t" . $asset['joining_date'] . "\t" . $asset['residence_location'] . "\t" . 
             $asset['gender'] . "\t" . $asset['pan_number'] . "\n";
    }
    exit;
}

include('templates/header.php');

// Fetching data from the database
try {
    $stmt = $pdo->query('SELECT * FROM Asset_Assignments');
    $assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error retrieving assets: " . $e->getMessage());
}
?>

<br><br>
<h2 style="text-align: center;">View Assignments</h2>

<!-- Print and Download buttons -->
<div style="text-align: center;">
    <form method="post">
        <button type="submit" name="download_excel" class="btn-download">Download Excel</button>
    </form>
    <button class="btn-info" onclick="window.print()">Print</button>
</div>

<?php if (!empty($assets)): ?>
    <table border="1" style="width: 100%; margin-top: 20px;">
        <tr>
            <th>Name</th>
            <th>Employee ID</th>
            <th>Mobile Number</th>
            <th>Email Id</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Date Of Joining</th>
            <th>Residence Location</th>
            <th>Gender</th>
            <th>PAN Number</th>
        </tr>
        <?php foreach ($assets as $asset): ?>
        <tr>
            <td><?php echo $asset['full_name']; ?></td>
            <td><?php echo $asset['employee_id']; ?></td>
            <td><?php echo $asset['mobile_number']; ?></td>
            <td><?php echo $asset['email_id']; ?></td>
            <td><?php echo $asset['department']; ?></td>
            <td><?php echo $asset['designation']; ?></td>
            <td><?php echo $asset['joining_date']; ?></td>
            <td><?php echo $asset['residence_location']; ?></td>
            <td><?php echo $asset['gender']; ?></td>
            <td><?php echo $asset['pan_number']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No assets found.</p>
<?php endif; ?>

<style>
    .btn-download, .btn-update, .btn-delete, .btn-info {
        display: inline-block;
        margin: 5px 0;
        padding: 5px 10px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 12px;
    }

    .btn-download {
        background-color: #4CAF50;
    }

    .btn-download:hover {
        background-color: #45a049;
    }

    .btn-update {
        background-color: #FFA500;
    }

    .btn-update:hover {
        background-color: #FF8C00;
    }

    .btn-delete {
        background-color: #FF0000;
    }

    .btn-delete:hover {
        background-color: #DC143C;
    }

    .btn-info {
        background-color: #1E90FF;
    }

    .btn-info:hover {
        background-color: #4682B4;
    }
</style>
