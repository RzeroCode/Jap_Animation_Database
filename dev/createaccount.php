<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$link = mysqli_connect("localhost", "root", "", "japanese_animation");
if ($link === false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

	if (empty($_POST['username']) || empty($_POST['password'])) {
		echo `<script>alert('You have entered empty fields.');</script>`;
	}
	else{
	$username = mysql_real_escape_string($_POST['username']);
    $password = md5($_POST['password']);  // turn into a hash function.
    mysqli_query($link, "INSERT INTO password VALUES ('$username', '$password', NULL)");
	mysqli_query($link,"CREATE TABLE `japanese_animation`.`$username` ( `Post` VARCHAR(2000) NOT NULL , `Date` VARCHAR(60) NOT NULL ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin");
	session_start();
	$_SESSION['username'] = $username;
	echo "<script>location.assign('tablejp.php')</script>";
	

}
?>