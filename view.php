<!DOCTYPE html>
<html lang="en">
<head>
<title> Comparison of Two Countries </title>
<style>
body {
	background-color: Coral;
}
input[type=submit]:hover {
  background-color: #0A1B5D;
  color:#E0BF1B;
}
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

<form action="" method="post"> <!-- form that user submits -->
    <table>
      <tr>
        <th scope="col">Key</th>
        <th scope="col">Value</th>
      </tr>
      <tr>
        <td><label for="iso_1">Enter country ID (iso_1)</label></td>
        <td>
          <input name="iso_1" type="text"  id="iso_1" size="12" value = "<?php echo isset($_POST['iso_1']) ? $_POST['iso_1'] : '' ?>" /> 
        </td>
      </tr>
      <tr>
        <td><label for="iso_2">Enter country ID (iso_2) </label></td>
        <td>
          <input name="iso_2" type="text"  id="iso_2" size="12" value = "<?php echo isset($_POST['iso_2']) ? $_POST['iso_2'] : '' ?>" />
        </td>
      </tr>
      <tr>
        <td>Compare</td>
        <td><input type="submit" name="submit" id="submit" value="Submit"  /></td>
      </tr>
	  <tr>
    </table>
	<input type = "checkbox" value = "1" <?php if (!empty($_POST['gold'])): ?> checked="checked"<?php endif; ?> name = "gold"> Show Gold Medals Won <br>
	<input type = "checkbox" value = "1" <?php if (!empty($_POST['ranktotal'])): ?> checked="checked"<?php endif; ?> name = "ranktotal"> Show Rank of Total Medals Won Compared to All Other Countries <br>
	<input type = "checkbox" value = "1" <?php if (!empty($_POST['totalathletes'])): ?> checked="checked"<?php endif; ?> name = "totalathletes"> Show Total Number of Athletes Competing <br>
	</form>
<img src = "https://static.dezeen.com/uploads/2007/06/dezeen_London-2012-Olympics-logo-by-Wolff-Olins_1.jpg" alt = "London 2012 Logo" style = "float:right">
<?php
//there are statements for each combination of checkboxes selected
if(isset ($_REQUEST['submit'])) {
if(isset($_POST['gold']) && isset($_POST['ranktotal']) && isset($_POST['totalathletes'])) {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, c.gold, GROUP_CONCAT(cy.name) AS name, COUNT(cy.ISO_id) AS totalathlete, FIND_IN_SET(total,(SELECT GROUP_CONCAT(total ORDER BY total DESC) FROM Country)) AS rank FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Total Gold Medals Won </th> <th> Name </th> <th> Total Number of Athletes </th> <th> Rank </th>";
while($row = mysqli_fetch_array($result)){ 
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['gold'] . "</td><td>" . $row['name'] . "</td><td>" . $row['totalathlete'] . "</td><td>" . $row['rank'] . "</td></tr>";
	}
echo "</table>";
}
else if (isset($_POST['totalathletes']) && isset($_POST['ranktotal'])) {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, GROUP_CONCAT(cy.name) AS name, COUNT(cy.ISO_id) AS totalathlete, FIND_IN_SET(total,(SELECT GROUP_CONCAT(total ORDER BY total DESC) FROM Country)) AS rank FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Name </th> <th> Total Number of Athletes </th> <th> Rank </th>";
while($row = mysqli_fetch_array($result)){
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['name'] . "</td><td>" . $row['totalathlete'] . "</td><td>" . $row['rank'] . "</td></tr>";
}
echo "</table>";
}
else if(isset($_POST['gold']) && isset($_POST['ranktotal']))
  {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.gold, c.total, GROUP_CONCAT(cy.name) AS name, FIND_IN_SET(total,(SELECT GROUP_CONCAT(total ORDER BY total DESC) FROM Country)) AS rank FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id ORDER BY rank;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Total Gold Medals Won </th> <th> Name </th> <th> Rank </th>";
while($row = mysqli_fetch_array($result)){ 
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['gold'] . "</td><td>" . $row['name'] . "</td><td>" . $row['rank'] . "</td></tr>";
}

echo "</table>";
	   
} 
else if(isset($_POST['gold']) && isset($_POST['totalathletes'])) {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.gold, c.total, GROUP_CONCAT(cy.name) AS name,COUNT(cy.ISO_id) AS totalathlete FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Total Gold Medals Won </th> <th> Name </th> <th> Total Number Of Athletes </th>";
while($row = mysqli_fetch_array($result)){ 
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['gold'] . "</td><td>" . $row['name'] . "</td><td>" . $row['totalathlete'] . "</td></tr>";
}
echo "</table>";
}
else if (isset ($_POST['gold'])) {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, c.gold, GROUP_CONCAT(cy.name) AS name FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Total Gold Medals Won </th> <th> Name </th>";
while ($row = mysqli_fetch_array($result)){
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['gold'] . "</td><td>" . $row['name'] . "</td></tr>";
	}
echo "</table>";	
}
else if (isset($_POST['ranktotal'])) {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, GROUP_CONCAT(cy.name) AS name, FIND_IN_SET(total,(SELECT GROUP_CONCAT(total ORDER BY total DESC) FROM Country)) AS rank FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id ORDER BY rank;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Name </th> <th> Rank </th>";
while ($row = mysqli_fetch_array($result)){
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['name'] . "</td><td>" . $row['rank'] . "</td></tr>";
	}
echo "</table>";	

}
else if (isset($_POST['totalathletes'])) {
include "connect.php";
$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, GROUP_CONCAT(cy.name) AS name, COUNT(cy.ISO_id) AS totalathlete FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id;";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Name </th> <th> Total Number of Athletes </th>";
while ($row = mysqli_fetch_array($result)){
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['name'] . "</td><td>" . $row['totalathlete'] . "</td></tr>";
	}
echo "</table>";
}
else {
include "connect.php";

$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, GROUP_CONCAT(cy.name) AS name FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' GROUP BY cy.ISO_id";

$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<th> ISO_id </th> <th> Total Medals Won </th> <th> Name </th>";
while ($row = mysqli_fetch_array($result)){
	echo "<tr><td>" . $row['ISO_id'] . "</td><td>" . $row['total'] . "</td><td>" . $row['name'] . "</td></tr>";
	}
echo "</table>";	
}
}
?>
</body>
</html>