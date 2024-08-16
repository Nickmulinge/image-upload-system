<?php
include 'db.php';

$sql = "SELECT * FROM images ORDER BY uploaded_on DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Image Gallery</h1>
        <div class="gallery">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="gallery-item">
                        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['image_name']; ?>">
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No images found</p>
            <?php endif; ?>
        </div>
        <a href="upload.php">Upload Another Image</a>
    </div>
</body>
</html>
