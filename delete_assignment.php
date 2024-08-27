<?php
include('config/database.php');

// Check if assignment_id is passed
if (isset($_GET['id'])) {
    $assignment_id = $_GET['id'];

    try {
        // Delete the specific assignment
        $stmt = $pdo->prepare('DELETE FROM Assignments WHERE assignment_id = ?');
        $stmt->execute([$assignment_id]);

        echo "<script>alert('Assignment deleted successfully!');</script>";
        echo "<script>window.location.href = 'view_assignments.php';</script>";
        exit();
    } catch (PDOException $e) {
        die("Error deleting assignment: " . $e->getMessage());
    }
} else {
    echo "No assignment ID specified.";
}
?>
