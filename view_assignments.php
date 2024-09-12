<?php
include('config/database.php');
include('templates/header.php');

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
    $status = 'unassigned';
    

    // Handling image upload
    $image = $_FILES['image']['name'];
    $image_target = "uploads/images/" . basename($image);

    try {
        // Check if serial number already exists
        $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM assets WHERE serial_number = ?");
        $check_stmt->execute([$serial_number]);
        $count = $check_stmt->fetchColumn();

        if ($count > 0) {
            echo "An asset with this serial number already exists.";
        } else {
            // Insert the new asset
            $stmt = $pdo->prepare("INSERT INTO assets (category, brand, model, serial_number, processor, ownership, rent_date, rent_revoke_date, description, `condition`, location, assignedto, `usage`, `compatibility`, `purchase_date`, `warranty_exp_date`, status, `image`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$category, $brand, $model, $serial_number, $processor, $ownership, $rent_date, $rent_revoke_date, $description, $condition, $location, $assignedto, $usage, $compatibility, $purchase_date, $warranty_exp_date, $status, $image]);
            
            

            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_target)) {
                echo "Asset added successfully!";
            } else {
                echo "Failed to upload image.";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<br><br>
<h2 style="text-align: center;">Add New Asset</h2>
<form action="add_asset.php" method="post" enctype="multipart/form-data">
    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="Laptop">Laptop</option>
        <option value="Adapter">Adapter</option>
        <option value="Hard Disk">Hard Disk</option>
        <option value="Server">Server</option>
        <option value="Keyboard">Keyboard</option>
        <option value="Mouse">Mouse</option>
        <option value="Monitor">Monitor</option>
        <option value="CPU">CPU</option>
        <option value="External Hard disk">External Hard disk</option>
        <option value="Pendrive">Pendrive</option>
        <option value="Walkie Talkie">Walkie Talkie</option>
        <option value="Tab">Tab</option>
        <option value="Printer">Printer</option>
        <option value="Extension">Extension</option>
        <option value="Camera">Camera</option>
        <option value="Air-Purifier">Air-Purifier</option>
        <option value="Head-Phone">Head-Phone</option>
        <option value="Coffee-Meachine">Coffee-Meachine</option>
        <option value="Microwave">Microwave</option>
        <option value="Induction">Induction</option>
    </select>
    <br>

    <label>Brand:</label>
    <input type="text" name="brand" required><br>

    <label>Model:</label>
    <input type="text" name="model" required><br>

    <label>Serial Number:</label>
    <input type="text" name="serial_number" required><br>

    <label>Processor:</label>
    <input type="text" name="processor"><br>

    <label for="ownership">Ownership</label>
    <select id="ownership" name="ownership" required onchange="toggleRentFields()">
        <option value="owner">Company owned</option>
        <option value="rented">Rented</option>
    </select>
<br>

        <div id="conditionalFields" class="conditional-fields">
            <label>Rent Date:</label>
            <input type="date" name="rent_date"><br>

            <label>Rent Revoke Date:</label>
            <input type="date" name="rent_revoke_date"><br>
        </div>

    <label>Asset-Description:</label>
    <input type="text" name="description"><br>

    <label>Condition:</label>
    <input type="text" name="condition"><br>

    <label>Location:</label>
    <input type="text" name="location"><br>

    <label>Assigned-To:</label>
    <input type="text" name="assignedto"><br>

    <label>Usage:</label>
    <input type="text" name="usage"><br>

    <label>Compatibility:</label>
    <input type="text" name="compatibility"><br>

    <label>Purchase Date:</label>
    <input type="date" name="purchase_date"><br>

    <label>Warranty Expiry Date:</label>
    <input type="date" name="warranty_exp_date"><br>

    <label>Image:</label>
    <input type="file" accept="image/png, image/jpeg, image/jpg," name="image" required><br>

    <input type="submit" value="Add Asset">
</form>
<style>
        .conditional-fields {
            display: none;
            margin-top: 10px;
        }
    </style>
<script>
        function toggleRentFields() {
            var ownership = document.getElementById('ownership').value;
            var conditionalFields = document.getElementById('conditionalFields');

            if (ownership === 'rented') {
                conditionalFields.style.display = 'block';
            } else {
                conditionalFields.style.display = 'none';
            }
        }

        // Initial call to set the correct visibility on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleRentFields();
        });

    </script>
