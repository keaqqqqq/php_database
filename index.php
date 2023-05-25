<?php
require 'db.php';

// Fetch all diary entries
$query = $connection->query('SELECT * FROM student_tbl');
$tables = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Information</title>
    <style>
        body{
            text-align: center;
        } 
        td,th{
            padding: 25px;
        }
        table{
            margin: 0 auto;
        }
        a{
            padding: 10px;
        }
        a:link, a:visited {
        background-color: #f44336;
        color: white;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        }

        a:hover, a:active {
        background-color: red;
        }
    </style>
</head>

<body>
    <h1>Student Information Record</h1>
    <table>
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Email</th>
                <th>Race</th>
                <th>Gender</th>
                <th>Image</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tables as $table) : ?>
                <tr>
                    <td><?php echo $table['Matric']; ?></td>
                    <td><?php echo $table['SName']; ?></td>
                    <td><?php echo $table['Email']; ?></td>
                    <td><?php echo $table['Race']; ?></td>
                    <td><?php echo $table['Gender']; ?></td>
                    <?php if (empty($table['SImage'])): ?>
                        <td><img src="" width="0" height="0"></td>
                    <?php else: ?>
                        <td><img src="images/<?php echo basename($table['SImage']); ?>" width="80" height="80"></td>
                    <?php endif; ?>
                    <td>
                        <a href="edit.php?Matric=<?php echo $table['Matric']; ?>">Edit</a>
                        <a href="update.php?Matric=<?php echo $table['Matric']; ?>">Update</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="list.php">Search</a>
</body>

</html>
