<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$link = mysqli_connect("localhost", "root", "", "japanese_animation");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(empty($_GET['i']) || empty($_GET['t']))
  {
		echo "<script>alert('You have an empty field.');</script>";
		echo"<script>location.assign('/dev/tablejp.php')</script>"; 
  }
  else{
	$idx = $_GET['i'];
	if ($_GET["t"] === "1") {
		mysqli_query($link,"DELETE FROM animation WHERE animation.AnimationID =".$_GET['i']);
		echo"<script>location.assign('/dev/tablejp.php')</script>";
	} else if ($_GET["t"] === "2") {
		mysqli_query($link,"DELETE FROM studio WHERE studio.StudioID =".$_GET['i']);
		echo"<script>location.assign('/dev/table.php?t=2')</script>";
	} else if ($_GET["t"] === "3") {
		mysqli_query($link,"DELETE FROM employees WHERE employees.EmployeeID =".$_GET['i']);
		echo"<script>location.assign('/dev/table.php?t=3')</script>";
	} else {
		die("ERROR: Which table to be supplied was not provided.");
	}
}
;
  echo"<script>location.assign('/dev/tablejp.php')</script>"; 
  ?>