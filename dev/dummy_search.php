<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$link = mysqli_connect("localhost", "root", "", "japanese_animation");


// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (empty($_POST['search'])) {
    echo "<script>alert('You have an empty field.');</script>";
}
$mysql_result = mysqli_query($link, $_POST['search']);
$row_cnt = mysqli_num_rows($mysql_result);
echo '<script>alert("' . $_POST['search'] . '");</script>';
if ($row_cnt != 0) {
    echo "<script>alert('Invalid SQL.');</script>";
} else {
    echo "<script>location.assign('tablejp.php')</script>";
}
