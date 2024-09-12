
<?php
ob_start(); // Start output buffering

include('config/database.php');
include('templates/header.php');

// Handle the deletion of an assignment
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        $stmt = $pdo->prepare('DELETE FROM asset_assignments WHERE asset_id = :asset_id');
        $stmt->execute([':asset_id' => $delete_id]);
        header("Location: view_assignments.php"); // Redirect to the same page after deletion
        exit;
    } catch (PDOException $e) {
        die("Error deleting asset: " . $e->getMessage());
    }
}

// Handle the update of an assignment
if (isset($_POST['update'])) {
    $asset_id = $_POST['asset_id'];
    $full_name = $_POST['full_name'];
    $employee_id = $_POST['employee_id'];
    $mobile_number = $_POST['mobile_number'];
    $email_id = $_POST['email_id'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $joining_date = $_POST['joining_date'];
    $residence_location = $_POST['residence_location'];
    $gender = $_POST['gender'];
    $pan_number = $_POST['pan_number'];

    try {
        $stmt = $pdo->prepare('UPDATE asset_assignments SET full_name = :full_name, employee_id = :employee_id, mobile_number = :mobile_number, email_id = :email_id, department = :department, designation = :designation, joining_date = :joining_date, residence_location = :residence_location, gender = :gender, pan_number = :pan_number WHERE asset_id = :asset_id');
        $stmt->execute([
            ':full_name' => $full_name,
            ':employee_id' => $employee_id,
            ':mobile_number' => $mobile_number,
            ':email_id' => $email_id,
            ':department' => $department,
            ':designation' => $designation,
            ':joining_date' => $joining_date,
            ':residence_location' => $residence_location,
            ':gender' => $gender,
            ':pan_number' => $pan_number,
            ':asset_id' => $asset_id
        ]);
        header("Location: view_assignments.php"); // Redirect to the same page after update
        exit;
    } catch (PDOException $e) {
        die("Error updating asset: " . $e->getMessage());
    }
}

// Fetching data from the database
try {
    $stmt = $pdo->query('SELECT * FROM asset_assignments');
    $assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error retrieving assets: " . $e->getMessage());
}

// Show edit form if `edit_id` is set
$edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;
if ($edit_id) {
    // Fetch the assignment details for editing
    try {
        $stmt = $pdo->prepare('SELECT * FROM asset_assignments WHERE asset_id = :asset_id');
        $stmt->execute([':asset_id' => $edit_id]);
        $edit_asset = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error retrieving asset details: " . $e->getMessage());
    }
}
?>

<!-- Your HTML content here -->
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Assignments</title>
    <script>
        function showEditForm() {
            document.getElementById('edit-form').style.display = 'block';
            document.getElementById('view-assignments').style.display = 'none';
        }

        function showViewAssignments() {
            document.getElementById('edit-form').style.display = 'none';
            document.getElementById('view-assignments').style.display = 'block';
        }
    </script>
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
</head>
<body>
    <br><br>
    <h2 style="text-align: center;">View Assignments</h2>

    <!-- Print and Download buttons -->
    <div style="text-align: center;">
        <form method="post">
            <button type="submit" name="download_excel" class="btn-download">Download Excel</button>
        </form>
        <button class="btn-info" onclick="window.print()">Print</button>
    </div>

    <!-- Edit Form -->
    <div id="edit-form" style="display: <?php echo $edit_id ? 'block' : 'none'; ?>;">
        <h3 style="text-align: center;">Edit Assignment</h3>
        <form method="post">
            <input type="hidden" name="asset_id" value="<?php echo htmlspecialchars($edit_asset['asset_id']); ?>">
            <label for="full_name">Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($edit_asset['full_name']); ?>" required><br><br>
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" value="<?php echo htmlspecialchars($edit_asset['employee_id']); ?>" required><br><br>
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($edit_asset['mobile_number']); ?>" required><br><br>
            <label for="email_id">Email Id:</label>
            <input type="email" id="email_id" name="email_id" value="<?php echo htmlspecialchars($edit_asset['email_id']); ?>" required><br><br>
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($edit_asset['department']); ?>" required><br><br>
            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($edit_asset['designation']); ?>" required><br><br>
            <label for="joining_date">Date Of Joining:</label>
            <input type="date" id="joining_date" name="joining_date" value="<?php echo htmlspecialchars($edit_asset['joining_date']); ?>" required><br><br>
            <label for="residence_location">Residence Location:</label>
            <input type="text" id="residence_location" name="residence_location" value="<?php echo htmlspecialchars($edit_asset['residence_location']); ?>" required><br><br>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male" <?php if ($edit_asset['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($edit_asset['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select><br><br>
            <label for="pan_number">PAN Number:</label>
            <input type="text" id="pan_number" name="pan_number" value="<?php echo htmlspecialchars($edit_asset['pan_number']); ?>" required><br><br>
            <button type="submit" name="update" class="btn-update">Update</button>
            <button type="button" onclick="showViewAssignments()" class="btn-info">Cancel</button>
        </form>
        <br><br>
    </div>

    <!-- View Assignments Table -->
    <div id="view-assignments" style="display: <?php echo $edit_id ? 'none' : 'block'; ?>;">
        <?php if (!empty($assets)): ?>
            <table border="1" style="width: 100%; margin-top: 20px;">
                <tr>
                    <th>Asset ID</th>
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
                    <th>Actions</th>
                </tr>
                <?php foreach ($assets as $asset): ?>
                <tr>
                    <td><?php echo htmlspecialchars($asset['asset_id']); ?></td>
                    <td><?php echo htmlspecialchars($asset['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($asset['employee_id']); ?></td>
                    <td><?php echo htmlspecialchars($asset['mobile_number']); ?></td>
                    <td><?php echo htmlspecialchars($asset['email_id']); ?></td>
                    <td><?php echo htmlspecialchars($asset['department']); ?></td>
                    <td><?php echo htmlspecialchars($asset['designation']); ?></td>
                    <td><?php echo htmlspecialchars($asset['joining_date']); ?></td>
                    <td><?php echo htmlspecialchars($asset['residence_location']); ?></td>
                    <td><?php echo htmlspecialchars($asset['gender']); ?></td>
                    <td><?php echo htmlspecialchars($asset['pan_number']); ?></td>
                    <td>
                        <!-- Edit Button for Individual Asset -->
                        <button onclick="showEditForm(); window.location.href='?edit_id=<?php echo urlencode($asset['asset_id']); ?>'" class="btn-update">Edit</button>

                        <!-- Delete Button for Individual Asset -->
                        <a href="?delete_id=<?php echo urlencode($asset['asset_id']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this assignment?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No assets found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
ob_end_flush(); // End output buffering and flush the output
?>
