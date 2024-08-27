<?php
include('config/database.php');

if (isset($_GET['id'])) {
    $asset_id = $_GET['id'];
    $user_name = "John Doe"; // Replace this with the actual user's name

    try {
        // Record the delete action in AssetHistory before deletion
        $stmt = $pdo->prepare("INSERT INTO AssetHistory (asset_id, user_name, action) VALUES (?, ?, 'delete')");
        $stmt->execute([$asset_id, $user_name]);

        // Delete the asset
        $stmt = $pdo->prepare('DELETE FROM Assets WHERE asset_id = ?');
        $stmt->execute([$asset_id]);

        echo "Asset deleted successfully!";
    } catch (PDOException $e) {
        echo "Error deleting asset: " . $e->getMessage();
    }
}
?>
