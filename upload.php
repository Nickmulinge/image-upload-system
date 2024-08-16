<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image_name);

        // Check if file is an image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO images (image_name, image_path) VALUES ('$image_name', '$target_file')";
                if ($conn->query($sql) === TRUE) {
                    $message = "The file " . basename($image_name) . " has been uploaded.";
                } else {
                    $message = "Error: " . $conn->error;
                }
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        } else {
            $message = "File is not an image.";
        }
    } else {
        $message = "No file was uploaded or there was an error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Upload Image</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" required>
            <button type="submit">Upload</button>
        </form>
        <p><?php echo $message; ?></p>
        <a href="gallery.php">View Gallery</a>
    </div>
</body>
</html>
