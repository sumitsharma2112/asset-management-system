<?php
include('config/database.php');
include('templates/header.php');

try {
    $stmt = $pdo->query('SELECT * FROM Assets');
    $assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error retrieving assets: " . $e->getMessage());
}
?>
<br><br>
<h2 style="text-align: center;">View Assets</h2>

<?php if (!empty($assets)): ?>
    <table border="1">
        <tr>
            <th>Asset ID</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Serial Number</th>
            <th>Processor</th>
            <th>Ownership</th>
            <th>Rent Date</th>
            <th>Rent Revoke Date</th>
            <th>Asset Description</th>
            <th>Condition</th>
            <th>Location</th>
            <th>Assigned To</th>
            <th>Usage</th>
            <th>Compatibility</th>
            <th>Purchase Date</th>
            <th>Warranty Expiry Date</th>
            <th>Status</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($assets as $asset): ?>
        <tr>
            <td><?php echo $asset['asset_id']; ?></td>
            <td><?php echo $asset['category']; ?></td>
            <td><?php echo $asset['brand']; ?></td>
            <td><?php echo $asset['model']; ?></td>
            <td><?php echo $asset['serial_number']; ?></td>
            <td><?php echo $asset['processor']; ?></td>
            <td><?php echo $asset['ownership']; ?></td>
            <td><?php echo $asset['rent_date']; ?></td>
            <td><?php echo $asset['rent_revoke_date']; ?></td>
            <td><?php echo $asset['description']; ?></td>
            <td><?php echo $asset['condition']; ?></td>
            <td><?php echo $asset['location']; ?></td>
            <td><?php echo $asset['assignedto']; ?></td>
            <td><?php echo $asset['usage']; ?></td>
            <td><?php echo $asset['compatibility']; ?></td>
            <td><?php echo $asset['purchase_date']; ?></td>
            <td><?php echo $asset['warranty_exp_date']; ?></td>
            <td><?php echo $asset['status']; ?></td>
            <td><img src="uploads/images/<?php echo $asset['image']; ?>" alt="Asset Image" width="100"></td>
            <td>
                <!-- Update Button for Individual Asset -->
                <a href="update_asset.php?id=<?php echo $asset['asset_id']; ?>" class="btn-update">Update</a>

                <!-- Delete Button for Individual Asset -->
                <a href="delete_asset.php?id=<?php echo $asset['asset_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this asset?');">Delete</a>

                <!-- Download Button for Individual Asset -->
                <a href="download_asset.php?id=<?php echo $asset['asset_id']; ?>" class="btn-download">Download</a>

                <!-- Tracking Info Button for Individual Asset -->
                <a href="view_tracking.php?id=<?php echo $asset['asset_id']; ?>" class="btn-info">Tracking Info</a>
            </td>
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
