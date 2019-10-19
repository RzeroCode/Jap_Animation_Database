<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$pageusername = $_SESSION['username'];
if (empty($pageusername)) {
    echo "<script>location.assign('index.html')</script>";
}
error_reporting(E_ALL ^ E_DEPRECATED);

$link = mysqli_connect("localhost", "root", "", "japanese_animation");


// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$check = mysqli_query($link, "SELECT * FROM animation, studio WHERE studio.StudioID = animation.StudioID");

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

<!-- START OF HEADER -->

<head>
    <meta charset="utf-8">
    <title>japDB | It just werks</title>
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
	</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/dev/assets/' . "nav.html"); ?>

    <div class="container">
        <div class="row">
            <div class="col">&nbsp;</div>
        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-hover tablecontain">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Studio</th>
                        <th scope="col">Name</th>
                        <th scope="col">Prequel</th>
                        <th scope="col">Sequel</th>
                        <th scope="col">Episodes</th>
                        <th scope="col">Season</th>
                        <th scope="col">Rating</th>
                        <?php
                        if (!empty($_SESSION['admin']))
                            echo '<th scope="col"></th>';
                        ?>
                    </tr>
                </thead>
                <tbody id="pageTable">
                    <?php
                    $row_number = count($myarr);
                    for ($i = 0; $i < $row_number; $i++) {
                        echo "<tr>";
                        echo "<td>" . $myarr[$i]['StudioName'] . "</td>";
                        echo "<td>" . $myarr[$i]['Animation Name'] . "</td>";
                        echo "<td>" . $myarr[$i]['Prequel'] .  "</td>";
                        echo "<td>" . $myarr[$i]['Sequel'] .  "</td>";
                        echo "<td>" . $myarr[$i]['Number of episodes'] .  "</td>";
                        echo "<td>" . $myarr[$i]['Airing season'] .  "</td>";
                        echo "<td>" . $myarr[$i]['Rating'] .  "</td>";
                        if (!empty($_SESSION['admin']))
                            echo '<td  scope="row"><a class="btn btn-sm btn-success" id="Edit' . $myarr[$i]['AnimationID'] . '" href="singlerow.php?i=' . $myarr[$i]['AnimationID'] . '&t=1"role=" button">View</a><a class="btn  btn-sm btn-danger" href="actions/removeAnimationRow.php?t=1&i=' . $myarr[$i]['AnimationID'] . '" role="button">Remove</a></td>';

                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
</body>
<script>
let list = document.getElementsByTagName("tr")
for(i=0;i<list.length ; i++){
list[i].onclick = function(){
window.location.href = this.lastChild.getElementsByClassName("btn-success")[0].href;

}
}
</script>

</html>