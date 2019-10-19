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
	$idx = $_GET['i'];
	if ($_GET["t"] === "1") {
		$tablename = "Animation";
		$check = mysqli_query($link, "SELECT * FROM animation WHERE animation.AnimationID = $idx");
	} else if ($_GET["t"] === "2") {
		$tablename = "Studios";
		$check = mysqli_query($link, "SELECT * FROM studio WHERE studio.StudioID = $idx");
	} else if ($_GET["t"] === "3") {
		$tablename = "Employees";
		$check = mysqli_query($link, "SELECT * FROM employees WHERE employees.EmployeeID = $idx");
	} else {
		die("ERROR: Which table to be supplied was not provided.");
	}


	if (!$check) { // add this check.
		die('Invalid query: ' . mysql_error());
	}

	$myarr = array();

	while ($row = mysqli_fetch_array($check)) {
		array_push($myarr, $row);
	}

	?>

	<!doctype html>

	<html lang="en">

	<head>
	    <meta charset="utf-8">
	    <title>japDB | 毎日がんばるぞい！</title>
	    <link rel="icon" href="/dev/jDB.png">
	    <!-- 			<link rel="apple-touch-icon" sizes="57x57" href="/dev/icfaov/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/dev/icfaov/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/dev/icfaov/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/dev/icfaov/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/dev/icfaov/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/dev/icfaov/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/dev/icfaov/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/dev/icfaov/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/dev/icfaovdev/icfaov/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/dev/icfaov/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/dev/icfaov/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/dev/icfaov/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/dev/icfaov/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="dev/icfaov/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff"> -->
	    <meta name="description" content="Page to see tables and do queries.">
	    <meta name="BOSOZOKU CREW" content="B00gle botnet">

	    <! Bootstrap files>
	        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	            crossorigin="anonymous">
	        <link rel="stylesheet" href="/dev/main.css" />

	        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	            crossorigin="anonymous"></script>
	        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
	            crossorigin="anonymous"></script>
	        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
	            crossorigin="anonymous"></script>
	        <script>
	        var parts = window.location.search.substr(1).split("&");
	        var $_GET = {};
	        for (var i = 0; i < parts.length; i++) {
	            var temp = parts[i].split("=");
	            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	        }
	        </script>


	</head>

	<body>

	    <?php include($_SERVER['DOCUMENT_ROOT'] . '/dev/assets/' . "nav.html"); ?>
	    <div class="container">
	        <div class="row">
	            <div class="col">&nbsp;</div>
	        </div>
	        <div class="container">
	            <table class="table table-striped table-hover containtable">
	                <thead class="thead-dark">
	                    <?php
						if ($_GET['t'] === "1") {
							echo '<tr><th scope="col">Studio ID<br><input class="headtext" type="text"/></th>
							<th scope="col">AnimationID<br><input class="headtext todisable" type="text"/></th>
							<th scope="col">Name<br><input class="headtext" type="text"/></th>
							<th scope="col">Prequel<br><input class="headtext" type="text"/></th>
							<th scope="col">Sequel<br><input class="headtext" type="text"/></th>
							<th scope="col"># episodes<br><input class="headtext" type="text"/></th>
							<th scope="col">Airing season<br><input class="headtext" type="text"/></th>
							<th scope="col">Rating<br><input class="headtext" type="text"/></th>';
							if(!empty($_SESSION['admin'])){
							echo '<th scope="col">
							<a id="addButton" type="submit" class="btn btn-sm btn-success"  role="button">Add</a>
							<a id="updateButton" type="submit" style="display:none" class="btn btn-sm btn-success" href="#" role="button">Update</a>
							</th>';}
							echo '</tr>
							</thead>
							</form>
							<tbody>';
							echo "<tr id='onlyrow'>";
							echo "<td class='tditem'>" . $myarr[0]['StudioID'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['AnimationID'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Animation Name'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Prequel'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Sequel'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Number of episodes'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Airing season'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Rating'] . "</td>";
							echo '<td  scope="row"><a class="btn  btn-sm btn-danger" href="actions/removeAnimationRow.php?i=' . $myarr[0]['AnimationID'] . '&t=1" role="button">Remove</a></td>';

							echo "</tr>";
						}
						if ($_GET['t'] === "2") {
							echo '<tr><th scope="col">Studio<br><input class="headtext" type="text"/></th>
							<th scope="col">StudioID<br><input class="headtext todisable" type="text"/></th>
							<th scope="col">Rating<br><input class="headtext" type="text"/></th>';
							if(!empty($_SESSION['admin']))
								echo '<th scope="col">
								<a id="addButton" type="submit" class="btn btn-sm btn-success"  role="button">Add</a>
								<a id="updateButton" type="submit" style="display:none" class="btn btn-sm btn-success" href="#" role="button">Update</a>
								</th>';
							'</thead>
							<tbody>';
							echo "<tr id='onlyrow'>";
							echo "<td class='tditem'>" . $myarr[0]['StudioName'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['StudioID'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['rating'] . "</td>";
							if(!empty($_SESSION['admin']))
							echo '<td  scope="row"><a class="btn  btn-sm btn-danger" href="actions/removeAnimationRow.php?i=' . $myarr[0]['StudioID'] . '&t=2" role="button">Remove</a></td>';

							echo "</tr>";
						}
						if ($_GET['t'] === "3") {
							echo '<tr>
							<th scope="col">ID<br><input class="headtext todisable" type="text"/></th>
							<th scope="col">StudioID<br><input class="headtext" type="text"/></th>
							<th scope="col">Name<br><input class="headtext" type="text"/></th>
							<th scope="col">Pay<br><input class="headtext" type="text"/></th>
							<th scope="col">Job<br><input class="headtext" type="text"/></th>';
							if (!empty($_SESSION['admin']))
							echo '<th scope="col">
							<a id="addButton" type="submit" class="btn btn-sm btn-success"  role="button">Add</a>
							<a id="updateButton" type="submit" style="display:none" class="btn btn-sm btn-success" href="#" role="button">Update</a>
							</th>';
							echo '</tr>
					</thead>
					<tbody>';
							echo "<tr id='onlyrow'>";
							echo "<td class='tditem'>" . $myarr[0]['EmployeeID'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['StudioID'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['EmployeeName'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Pay'] . "</td>";
							echo "<td class='tditem'>" . $myarr[0]['Job'] . "</td>";
							if (!empty($_SESSION['admin']))
								echo '<td  scope="row"><a class="btn  btn-sm btn-danger" href="actions/removeAnimationRow.php?i=' . $myarr[0]['EmployeeID'] . '&t=3" role="button">Remove</a></td>';

							echo "</tr>";
						}

						?>
	                    </tbody>
	            </table>
	        </div>
	</body>
	<script>
let row = document.getElementById("onlyrow");
row.onclick = function() {
    document.getElementById("addButton").style = "display:none";
    document.getElementById("updateButton").style = "display:block";
    let tditems = document.getElementsByClassName("tditem");
	let inputitems = document.getElementsByClassName("headtext");
	if (document.getElementsByClassName("todisable")[0]!==null)document.getElementsByClassName("todisable")[0].setAttribute("disabled","");
    for (let i = 0; i < tditems.length; i++) {
        inputitems[i].value = tditems[i].textContent;
    }
}
document.getElementById("addButton").onclick = function() {
    let inputitems = document.getElementsByClassName("headtext");
    let urllocation = "/dev/modifytable.php?";
    for (let i = 0; i < inputitems.length; i++) {
        urllocation += i + "=" + inputitems[i].value + "&";
    }
    urllocation += "t=" + $_GET['t'];
    window.location.href = urllocation;
}
document.getElementById("updateButton").onclick = function() {
    let inputitems = document.getElementsByClassName("headtext");
    let urllocation = "/dev/modifytable.php?";
    for (let i = 0; i < inputitems.length; i++) {
        urllocation += i + "=" + inputitems[i].value + "&";
    }
    urllocation += "t=" + $_GET['t'] + "&";
    urllocation += "i=" + $_GET['i'];
    window.location.href = urllocation;
}
	</script>

	</html>