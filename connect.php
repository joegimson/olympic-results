<?php
//connects to server for sql statements
$servername = 'localhost';
$username = 'coa123cycle';
$password = 'bgt87awx';
$dbname = 'coa123cdb';

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>