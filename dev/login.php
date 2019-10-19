<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$link = mysqli_connect("localhost", "root", "", "japanese_animation");
if ($link === false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (isset($_POST['log'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		echo "<script>alert('You have an empty field.');</script>";

		echo "<script>location.assign('index.html')</script>";  // go back to the login page
	}
	$username = mysql_real_escape_string($_POST['username']);     // to get rid of the tricky characters which can destroy the database.
	$password = md5($_POST['password']);  // turn into a hash function.
	$mysql_result = mysqli_query($link, "SELECT * from password WHERE Name LIKE '$username' AND Password LIKE '$password' LIMIT 1 ");
	$row_cnt = mysqli_num_rows($mysql_result);
	if ($row_cnt !== 1)   // if there is no such user like that.
	{
		echo "<script>alert('The username (" . $_POST['username'] . ") or the password does not exist in the database');</script>";
		echo "<script>location.assign('index.html')</script>";  // go back to the login page
	} else {
		$result = mysqli_query($link, "SELECT Admin from password WHERE Name LIKE '$username' AND Password LIKE '$password' LIMIT 1 ");
		$result = mysqli_fetch_array($result);
		session_start();
		$_SESSION["admin"] = $result[0];
		$_SESSION["username"] = $username;
		echo "<script>location.assign('tablejp.php')</script>";  // go to the new page
	}
}
?>