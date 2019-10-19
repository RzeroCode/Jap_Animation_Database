<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$pageusername = $_SESSION['username'];
error_reporting(E_ALL ^ E_DEPRECATED);

$link = mysqli_connect("localhost", "root", "", "japanese_animation");


// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_GET["t"] === "1") {
    if (!empty($_GET["i"])) {
        if($_GET['3']===""){
            $_GET['3'] = "NULL";
        }
        if($_GET['4']===""){
            $_GET['4'] = "NULL";
        }
        if (!empty($_GET['3']) || !empty($_GET['4'])) {
            mysqli_query($link, "UPDATE `animation` SET `StudioID` = '" . $_GET['0'] . "',`AnimationID` = '" . $_GET['1'] . "', `Animation Name` = '" . $_GET['2'] . "', `Prequel` = " . $_GET['3'] . ", `Sequel` = " . $_GET['4'] . ", `Number of episodes` = '" . $_GET['5'] . "', `Airing season` = '" . $_GET['6'] . "', `Rating` = '" . $_GET['7'] . "' WHERE `animation`.`AnimationID` = " . $_GET['i'] . " ");
        }
        else{
            mysqli_query($link, "UPDATE `animation` SET `StudioID` = '" . $_GET['0'] . "',`AnimationID` = '" . $_GET['1'] . "', `Animation Name` = '" . $_GET['2'] . "', `Prequel` = NULL, `Sequel` = NULL, `Number of episodes` = '" . $_GET['5'] . "', `Airing season` = '" . $_GET['6'] . "', `Rating` = '" . $_GET['7'] . "' WHERE `animation`.`AnimationID` = " . $_GET['i'] . " ");
        }
    } else {
        if ($_GET['3'] === "" || $_GET['4'] === "") {
            mysqli_query($link, "INSERT INTO `animation` VALUES (" . $_GET['0'] . ", " . $_GET['1'] . ", '" . $_GET['2'] . "',NULL,NULL, '" . $_GET['5'] . "', '" . $_GET['6'] . "', " . $_GET['7'] . ")");
        } else {
            mysqli_query($link, "INSERT INTO `animation` VALUES (" . $_GET['0'] . ", " . $_GET['1'] . ", '" . $_GET['2'] . "', " . $_GET['3'] . ", " . $_GET['4'] . ", '" . $_GET['5'] . "', '" . $_GET['6'] . "', " . $_GET['7'] . ")");
        }
       }


    echo "<script>location.assign('tablejp.php');</script>";
} else if ($_GET["t"] === "2") {
    if (isset($_GET['i']))
        mysqli_query($link, "UPDATE `studio` SET `StudioName` = '" . $_GET['0'] . "', `StudioID` = '" . $_GET['1'] . "', `rating` = '" . $_GET['2'] . "' WHERE `studio`.`StudioID` = '" . $_GET['i'] . "'");
    else
        mysqli_query($link, "INSERT INTO `studio` VALUES ('" . $_GET['0'] . "', '" . $_GET['1'] . "', '" . $_GET['2'] . "')");
    echo "<script>location.assign('table.php?t=2');</script>";
} else if ($_GET["t"] === "3") {
    if (isset($_GET['i']))
        mysqli_query($link, "UPDATE `employees` SET `EmployeeID` = '" .   $_GET['0'] . "', `StudioID` = '" .   $_GET['1'] . "', `EmployeeName` = '" .   $_GET['2'] . "', `Pay` = '" .   $_GET['3'] . "', `Job` = '" .   $_GET['4'] . "' WHERE `EmployeeID` = '" .   $_GET['i'] . "'");
    else
        mysqli_query($link, "INSERT INTO `employees` VALUES ( '" .$_GET['0'] . "', '" .   $_GET['1'] . "','" .   $_GET['2'] . "', '" .   $_GET['3'] . "','" .$_GET['4'] . "')");
    echo "<script>location.assign('table.php?t=3');</script>";
} else {
    die("ERROR: Which table to be supplied was not provided.");
}
die(mysqli_error($link));
echo "<script>location.assign('tablejp.php');</script>";
