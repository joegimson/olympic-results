<!DOCTYPE html>
<html lang="en">
<head>
<title>BMI Table</title>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>

<table style = "width: 100%">
<?php
$min_weight = $_GET['min_weight'];
$max_weight = $_GET['max_weight'];
$min_height = $_GET['min_height'];
$max_height = $_GET['max_height'];

 function bmi($weight,$height) { //returns bmi of two values
	 $bmi = $weight/($height*$height);
	 return $bmi * 10000;
	 }

echo '<th> Height <br> &#8594 <br> Weight <br> &#8595 </th>';

for ($j=$min_height; $j <= $max_height; $j += 5) {
	echo '<th>' .$j. '</th>';
}

for ($i=$min_weight; $i <= $max_weight; $i += 5) {
	echo '<tr>';
	echo '<th>' .$i. '</th>';
	for ($j = $min_height; $j <= $max_height; $j += 5) {
		echo '<td>' .round(bmi($i, $j), 3). '</td>'; //rounds bmi to two d.p
		}
	echo'</tr>';
}
?>
</table>
</body>
</html>

