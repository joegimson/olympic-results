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
</style>

</head>
<body>

<form action="" method="post" id = "MyForm">
    <table border="1">
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
        <td>Compare two countries total medals</td>
        <td><input type="submit" name="submit" id="submit" value="Submit"  /></td>
      </tr>
	  <tr>
	  <td> compare gold medals won </td>
	  <td><input type = 'Submit' name = 'submit2' id = 'submit2' value = 'Send Request' /> </td>
    </table>
	</form>

<?php
if(isset ($_REQUEST['submit'])) {
include "connect.php";

$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql = "SELECT cy.ISO_id, c.total, cy.name FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' ORDER BY cy.ISO_id;";

$result = mysqli_query($conn, $sql);

//$emparray = array();
//while($row =mysqli_fetch_assoc($result)){
	//$emparray[] = $row;
	//}
	//echo json_encode($emparray);
if (mysqli_num_rows($result) > 0){
	echo "ISO ID" . str_repeat('&nbsp;', 4) . "TOTAL MEDALS WON" . str_repeat('&nbsp;', 5) . "ATHLETE NAME <br>";
	while ($row = mysqli_fetch_array($result)){
		echo $row['ISO_id'] . str_repeat('&nbsp;', 20) . $row['total'] . str_repeat('&nbsp;', 32) . $row['name'] . "<br>";
	}
}

}
if(isset ($_REQUEST['submit2'])) {
include "connect.php";

$iso_1 = $_POST['iso_1'];
$iso_2 = $_POST['iso_2'];

$sql2 = "SELECT cy.ISO_id, c.gold, cy.name FROM Country AS c LEFT JOIN Cyclist AS cy ON cy.ISO_id = c.ISO_id WHERE cy.ISO_id = '$iso_1' OR cy.ISO_id = '$iso_2' ORDER BY cy.ISO_id;";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0){
	echo "ISO ID" . str_repeat('&nbsp;', 4)  . "TOTAL GOLD MEDALS" . str_repeat('&nbsp;', 5). "ATHLETE NAME <br>";
	while ($row = mysqli_fetch_array($result2)){
		echo $row['ISO_id'] . str_repeat('&nbsp;', 20) . $row['gold']. str_repeat('&nbsp;', 32) . $row['name'] . "<br>";
	}
}
}
?>
</body>
</html>