<!DOCTYPE html>
<html lang="en">
<head>
<title> Athlete table </title>
<style>
table {
	border-collapse: collapse;
    border-spacing: 20px 0;
}
th, td{
	width: 150px;
    text-align: center;
    padding: 5px;
	border: 1px solid black;
}
</style>
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

$country_id = $_GET['country_id'];
$part_name = $_GET['part_name'];

$sql = "SELECT name, gender, (weight / height * height) as bmi FROM Cyclist WHERE ISO_id = '$country_id' AND name LIKE '%$part_name%'";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> Name </th> <th> Gender </th> <th> BMI </th>"; //table headings
if (mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)){
	echo "<tr><td>" . $row['name'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['bmi'] . "</td></tr>";
	}
}
echo "</table>";
?>
</body>
</html>