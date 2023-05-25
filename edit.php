<?php
require 'db.php';

// Check if ID parameter is provided
if (!isset($_GET['Matric'])) {
    header('Location: index.php');
    exit;
}

$matric = $_GET['Matric'];

// Fetch diary entry by ID
$query = $connection->prepare('SELECT `Matric`, `SName`, `Email` FROM student_tbl WHERE Matric = ?');
$query->execute([$matric]);
$table = $query->fetch(PDO::FETCH_ASSOC);

// If entry doesn't exist, redirect to index.php
if (!$table) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $newMatric = $_POST['Matric'];
    $name = $_POST['SName'];
    $email = $_POST['Email'];

    // Update diary entry
    $query = $connection->prepare('UPDATE student_tbl SET Matric = ?, SName = ?, Email = ? WHERE Matric = ?');
    $query->execute([$newMatric, $name, $email, $matric]);

    // Redirect to index.php after successful update
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Student Entry</title>
</head>

<body>
    <h1>Edit Student Entry</h1>
    <form method="POST">
        <label for="Matric">Matric:</label><br>
        <input type="text" name="Matric" value="<?php echo $table['Matric']; ?>" required><br><br>

        <label for="SName">Name:</label><br>
        <input type="text" name="SName" value="<?php echo $table['SName']; ?>" required><br><br>

        <label for="Email">Email:</label><br>
        <input type="email" name="Email" value="<?php echo $table['Email']; ?>" required><br><br>

        <button type="submit">Save</button>
        <a href="index.php"><button type="button">Cancel</button></a>
    </form>
</body>
</html>