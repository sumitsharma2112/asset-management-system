<?php
include('config/database.php'); // Ensure this file includes your PDO connection setup
include('templates/header.php');
// Handle Image Upload
if (isset($_POST['upload'])) {
    $assetId = $_POST['asset_id'];
    $images = $_FILES['images'];

    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $file_name = $images['name'][$key];
        $file_tmp = $images['tmp_name'][$key];

        // Set the upload directory
        $uploadDir = "uploads/"; // Ensure this folder exists and has the right permissions
        $targetFile = $uploadDir . basename($file_name);

        // Move uploaded file to the directory
        if (move_uploaded_file($file_tmp, $targetFile)) {
            $stmt = $pdo->prepare("INSERT INTO AssetImages (asset_id, image_path) VALUES (?, ?)");
            $stmt->execute([$assetId, $targetFile]);
        }
    }
}

// Handle Image Deletion
if (isset($_GET['delete'])) {
    $imageId = $_GET['delete'];

    // Fetch image path
    $stmt = $pdo->prepare("SELECT image_path FROM AssetImages WHERE id = ?");
    $stmt->execute([$imageId]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if image was found and delete file
    if ($image && file_exists($image['image_path'])) {
        unlink($image['image_path']);
    }

    // Delete record from database
    $stmt = $pdo->prepare("DELETE FROM AssetImages WHERE id = ?");
    $stmt->execute([$imageId]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Gallery</title>
    <style>
        /* Your existing CSS */
        .gallery-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .gallery-container h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .image-item {
            display: inline-block;
            margin: 10px;
            position: relative;
        }
        .image-item img {
            max-width: 150px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .image-item button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="gallery-container">
        <h2>Asset Gallery</h2>

        <!-- Upload Image Form -->
        <form method="POST" enctype="multipart/form-data">
            <label for="asset_id">Select Asset:</label>
            <input type="number" name="asset_id" required>
            <input type="file" name="images[]" multiple required>
            <input type="submit" name="upload" value="Upload Images">
        </form>

        <!-- Display Gallery -->
        <div class="gallery">
            <?php
            // Fetch all images from the database
            $stmt = $pdo->prepare("SELECT * FROM AssetImages");
            $stmt->execute();
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($images) {
                foreach ($images as $image) {
                    echo '<div class="image-item">';
                    echo '<img src="' . htmlspecialchars($image['image_path']) . '" alt="Asset Image">';
                    echo '<button onclick="deleteImage(' . htmlspecialchars($image['id']) . ')">X</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No images found.</p>';
            }
            ?>
        </div>
    </div>

    <script>
        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                window.location.href = 'asset_gallery.php?delete=' + imageId;
            }
        }
    </script>
</body>
</html>
