<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form method="Post">
        <label>Search</label>
        <input type="text" name="search">
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php
$con = new PDO("mysql:host=localhost;dbname=student", 'root', '');
if (isset($_POST["submit"])) {
    $str = $_POST["search"];
    $sth = $con->prepare("SELECT * FROM `student_tbl` WHERE Race = '$str' OR Gender = '$str'");

    $sth->setFetchMode(PDO::FETCH_OBJ);
    $sth->execute();

    $rowCount = $sth->rowCount();
    if ($rowCount > 0) {
        ?>
        <br><br><br>
        <table>
            <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Email</th>
                <th>Race</th>
                <th>Gender</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $sth->fetch()) {
                ?>
                <tr>
                    <td><?php echo $row->Matric; ?></td>
                    <td><?php echo $row->SName; ?></td>
                    <td><?php echo $row->Email; ?></td>
                    <td><?php echo $row->Race; ?></td>
                    <td><?php echo $row->Gender; ?></td>
                    <td><img src="images/<?php echo basename($row->SImage); ?>" width="100" height="100"></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "No results found.";
    }
}
?>
