<?php
require 'db.php';

// Check if ID parameter is provided
if (!isset($_GET['Matric'])) {
    header('Location: index.php');
    exit;
}

$matric = $_GET['Matric'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $race = $_POST['Race'];
    $gender = $_POST['Gender'];

    // Upload image file
    $image = $_FILES['SImage'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_path = 'C:\xampp\htdocs\php_database\images\\' . $image_name;
    move_uploaded_file($image_tmp, $image_path);

    // Update student entry
    $query = $connection->prepare('UPDATE student_tbl SET Race = ?, Gender = ?, SImage = ? WHERE Matric = ?');
    $query->execute([$race, $gender, $image_path, $matric]);

    // Redirect to index.php after successful update
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Student Entry</title>
</head>

<body>
    <h1>Update Student Entry</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="Race">Race:</label><br>
        <input type="text" name="Race" value="" required><br><br>

        <label for="Gender">Gender:</label><br>
        <input type="text" name="Gender" value="" required><br><br>

        <label for="SImage">Image:</label><br>
        <input type="file" name="SImage" required><br><br>

        <button type="submit">Save</button>
        <a href="index.php"><button type="button">Cancel</button></a>
    </form>
</body>

</html>
