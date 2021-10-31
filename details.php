<!DOCTYPE html>
<html lang="en">
<head>
<title> Athletes born between the two dates </title>
</head>

<body>
<?php

$servername = 'localhost';
$username = 'coa123cycle';
$password = 'bgt87awx';
$dbname = 'coa123cdb';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$date_1 = strtr($_GET['date_1'], '/', '-');
$newdate1 = date('Y/m/d', strtotime($date_1)); //converting the date to the right format so sql search is successful

$date_2 = strtr($_GET['date_2'], '/', '-');
$newdate2 = date('Y/m/d', strtotime($date_2));

if ($newdate1 <= $newdate2) { //statement is done so it doesn't matter which order user inputs the date in
	$sql = "SELECT cy.name, c.country_name, c.gdp, c.population FROM Country AS c LEFT JOIN Cyclist AS cy ON c.ISO_id = cy.ISO_id WHERE cy.dob BETWEEN '$newdate1' AND '$newdate2';";
}
else {
	$sql = "SELECT cy.name, c.country_name, c.gdp, c.population FROM Country AS c LEFT JOIN Cyclist AS cy ON c.ISO_id = cy.ISO_id WHERE cy.dob BETWEEN '$newdate2' AND '$newdate1';";
}

$result = mysqli_query($conn, $sql);

$emparray = array();
while($row =mysqli_fetch_assoc($result)){
	$emparray[] = $row;
	}
	echo json_encode($emparray);
    mysqli_close($conn);
?>
</body>
</html>
