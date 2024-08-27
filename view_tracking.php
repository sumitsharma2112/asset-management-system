<?php
include('config/database.php');
include('templates/header.php');

if (isset($_GET['id'])) {
    $asset_id = $_GET['id'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM AssetHistory WHERE asset_id = ? ORDER BY timestamp DESC');
        $stmt->execute([$asset_id]);
        $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error retrieving asset history: " . $e->getMessage());
    }
}
?>

<h2>Asset Tracking Information</h2>

<?php if (!empty($history)): ?>
    <table border="1">
        <tr>
            <th>Action</th>
            <th>User</th>
            <th>Timestamp</th>
            <th>IP Address</th>
        </tr>
        <?php foreach ($history as $entry): ?>
        <tr>
            <td><?php echo ucfirst($entry['action']); ?></td>
            <td><?php echo $entry['user_name']; ?></td>
            <td><?php echo $entry['timestamp']; ?></td>
            <td><?php echo !empty($entry['ip_address']) ? $entry['ip_address'] : 'N/A'; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No tracking information found for this asset.</p>
<?php endif; ?>

<br>

<a href="view_assets.php" class="back-button">Back to Asset List</a>

<style>
    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border: 2px solid #2c3e50;
    }

    .back-button:hover {
        background-color: white;
        color: #2c3e50;
        transform: scale(1.05);
        border-color: #2c3e50;
    }

    .back-button:active {
        background-color: #34495e;
        transform: scale(0.98);
    }
</style>

