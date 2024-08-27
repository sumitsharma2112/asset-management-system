<?php
include('config/database.php');
include('templates/header.php');

if (isset($_GET['id'])) {
    $asset_id = $_GET['id'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM Assets WHERE asset_id = ?');
        $stmt->execute([$asset_id]);
        $asset = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$asset) {
            echo "Asset not found!";
            exit;
        }
    } catch (PDOException $e) {
        die("Error retrieving asset: " . $e->getMessage());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $serial_number = $_POST['serial_number'];
        $processor = $_POST['processor'];
        $ownership = $_POST['ownership'];
        $rent_date = $_POST['rent_date'];
        $rent_revoke_date = $_POST['rent_revoke_date'];
        $description = $_POST['description'];
        $condition = $_POST['condition'];
        $location = $_POST['location'];
        $assignedto = $_POST['assignedto'];
        $usage = $_POST['usage'];
        $compatibility = $_POST['compatibility'];
        $purchase_date = $_POST['purchase_date'];
        $warranty_exp_date = $_POST['warranty_exp_date'];
        $user_name = $_POST['updated_by']; // Get the "Updated By" value from the form
        $ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user

        try {
            $stmt = $pdo->prepare("UPDATE Assets SET category=?, brand=?, model=?, serial_number=?, processor=?, ownership=?, rent_date=?, rent_revoke_date=?, description=?, `condition`=?, location=?, assignedto=?, `usage`=?, compatibility=?, purchase_date=?, warranty_exp_date=? WHERE asset_id=?");
            $stmt->execute([$category, $brand, $model, $serial_number, $processor, $ownership, $rent_date, $rent_revoke_date, $description, $condition, $location, $assignedto, $usage, $compatibility, $purchase_date, $warranty_exp_date, $asset_id]);

            // Record the update action in AssetHistory
            $stmt = $pdo->prepare("INSERT INTO AssetHistory (asset_id, user_name, action, ip_address) VALUES (?, ?, 'update', ?)");
            $stmt->execute([$asset_id, $user_name, $ip_address]);

            echo "Asset updated successfully!";
        } catch (PDOException $e) {
            echo "Error updating asset: " . $e->getMessage();
        }
    }
}
?>

<h2>Update Asset</h2>
<form action="update_asset.php?id=<?php echo $asset_id; ?>" method="post">
    <label>Category:</label>
    <input type="text" name="category" value="<?php echo $asset['category']; ?>" required><br>

    <label>Brand:</label>
    <input type="text" name="brand" value="<?php echo $asset['brand']; ?>" required><br>

    <label>Model:</label>
    <input type="text" name="model" value="<?php echo $asset['model']; ?>" required><br>

    <label>Serial Number:</label>
    <input type="text" name="serial_number" value="<?php echo $asset['serial_number']; ?>" required><br>

    <label>Processor:</label>
    <input type="text" name="processor" value="<?php echo $asset['processor']; ?>"><br>

    <label>Ownership:</label>
    <input type="text" name="ownership" value="<?php echo $asset['ownership']; ?>"><br>

    <label>Rent Date:</label>
    <input type="date" name="rent_date" value="<?php echo $asset['rent_date']; ?>"><br>

    <label>Rent Revoke Date:</label>
    <input type="date" name="rent_revoke_date" value="<?php echo $asset['rent_revoke_date']; ?>"><br>

    <label>Asset Description:</label>
    <input type="text" name="description" value="<?php echo $asset['description']; ?>"><br>

    <label>Condition:</label>
    <input type="text" name="condition" value="<?php echo $asset['condition']; ?>"><br>

    <label>Location:</label>
    <input type="text" name="location" value="<?php echo $asset['location']; ?>"><br>

    <label>Assigned-To:</label>
    <input type="text" name="assignedto" value="<?php echo $asset['assignedto']; ?>"><br>

    <label>Usage:</label>
    <input type="text" name="usage" value="<?php echo $asset['usage']; ?>"><br>

    <label>Compatibility:</label>
    <input type="text" name="compatibility" value="<?php echo $asset['compatibility']; ?>"><br>

    <label>Purchase Date:</label>
    <input type="date" name="purchase_date" value="<?php echo $asset['purchase_date']; ?>"><br>

    <label>Warranty Expiry Date:</label>
    <input type="date" name="warranty_exp_date" value="<?php echo $asset['warranty_exp_date']; ?>"><br>

    <label>Updated By:</label>
    <input type="text" name="updated_by" value="<?php echo isset($_POST['updated_by']) ? $_POST['updated_by'] : ''; ?>" required><br>

    <input type="submit" value="Update Asset">
</form>
