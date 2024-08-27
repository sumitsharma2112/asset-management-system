<?php
include('config/database.php');

// Check if assignment_id is passed
if (isset($_GET['id'])) {
    $assignment_id = $_GET['id'];

    try {
        // Fetch the specific assignment
        $stmt = $pdo->prepare('SELECT * FROM Assignments WHERE assignment_id = ?');
        $stmt->execute([$assignment_id]);
        $assignment = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($assignment) {
            // Set headers to indicate file download
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=assignment_' . $assignment_id . '.csv');

            // Open output stream
            $output = fopen('php://output', 'w');

            // Write column headers
            fputcsv($output, ['Assignment ID', 'Asset ID', 'Employee ID', 'Assigned By', 'Assignment Date', 'Assign To', 'Status']);

            // Write the assignment data
            fputcsv($output, $assignment);

            // Close output stream
            fclose($output);
            exit();
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
