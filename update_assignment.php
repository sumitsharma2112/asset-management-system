<?php
include('config/database.php');
include('templates/header.php');

// Check if assignment_id is passed
if (isset($_GET['id'])) {
    $assignment_id = $_GET['id'];

    try {
        // Fetch the specific assignment
        $stmt = $pdo->prepare('SELECT * FROM Assignments WHERE assignment_id = ?');
        $stmt->execute([$assignment_id]);
        $assignment = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($assignment) {
            // Update assignment if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $asset_id = $_POST['asset_id'];
                $employee_id = $_POST['employee_id'];
                $assigned_by = $_POST['assigned_by'];
                $assignment_date = $_POST['assignment_date'];
                $assign_to = $_POST['assign_to'];
                $status = $_POST['status'];

                $update_stmt = $pdo->prepare('UPDATE Assignments SET asset_id = ?, employee_id = ?, assigned_by = ?, assignment_date = ?, assign_to = ?, status = ? WHERE assignment_id = ?');
                $update_stmt->execute([$asset_id, $employee_id, $assigned_by, $assignment_date, $assign_to, $status, $assignment_id]);

                echo "<script>alert('Assignment updated successfully!');</script>";
                echo "<script>window.location.href = 'view_assignments.php';</script>";
                exit();
            }
        } else {
            echo "Assignment not found.";
        }
    } catch (PDOException $e) {
        die("Error retrieving assignment: " . $e->getMessage());
    }
} else {
    echo "No assignment ID specified.";
}
?>

<h2>Update Assignment</h2>
<form method="post">
    <label>Asset ID:</label>
    <input type="text" name="asset_id" value="<?php echo $assignment['asset_id']; ?>" required><br>

    <label>Employee ID:</label>
    <input type="text" name="employee_id" value="<?php echo $assignment['employee_id']; ?>" required><br>

    <label>Assigned By:</label>
    <input type="text" name="assigned_by" value="<?php echo $assignment['assigned_by']; ?>" required><br>

    <label>Assignment Date:</label>
    <input type="date" name="assignment_date" value="<?php echo $assignment['assignment_date']; ?>" required><br>

    <label>Assigned To:</label>
    <input type="text" name="assign_to" value="<?php echo $assignment['assign_to']; ?>" required><br>

    <label>Status:</label>
    <select name="status" required>
        <option value="Assigned" <?php if ($assignment['status'] == 'Assigned') echo 'selected'; ?>>Assigned</option>
        <option value="Returned" <?php if ($assignment['status'] == 'Returned') echo 'selected'; ?>>Returned</option>
    </select><br>

    <input type="submit" value="Update Assignment">
</form>
