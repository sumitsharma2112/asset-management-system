<?php
include('config/database.php');

if (isset($_GET['id'])) {
    $asset_id = $_GET['id'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM Assets WHERE asset_id = ?');
        $stmt->execute([$asset_id]);
        $asset = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($asset) {
            // Create a CSV file
            $filename = "asset_" . $asset_id . ".csv";
            $file = fopen('php://output', 'w');

            // Set headers
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // Add the CSV headers
            $headers = array_keys($asset);
            fputcsv($file, $headers);

            // Add the data
            fputcsv($file, $asset);

            // Close the file pointer
            fclose($file);
            exit;
        } else {
            echo "Asset not found.";
        }
    } catch (PDOException $e) {
        die("Error retrieving asset: " . $e->getMessage());
    }
} else {
    echo "Invalid request.";
}
