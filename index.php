<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "testmysql";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$mysqli) {
	die("Connection failed: " . mysqli_connect_error());
}

$stmt = $mysqli->prepare("SELECT * FROM `locations`");
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
	echo '<br />';
	echo $row['id'];
	echo '<br />';
	echo $row['district'];
	echo '<br />';
	echo $row['sector'];
	echo '<br />';
	echo $row['street'];
	echo '<br />';

	// District
	$sql = "SELECT * FROM districts WHERE ar_name=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $row['district']);
	$stmt->execute();
	$district = $stmt->get_result()->fetch_assoc();
	var_dump($district);
	if($district){
		$district_id = $district['id'];
	}
	if(!$district) {
		$sql = "INSERT INTO districts (ar_name) VALUES (?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s', $row['district']);
		$stmt->execute();
		$district_id = $stmt->insert_id;
		echo ' insert id -----  ' . $stmt->insert_id;
	}

	// Sectors
	$sql = "SELECT * FROM sectors WHERE ar_name=? and district_id=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("si", $row['sector'], $district_id);
	$stmt->execute();
	$sector = $stmt->get_result()->fetch_assoc();
	var_dump($sector);
	if($sector){
		$sector_id = $sector['id'];
	}
	if(!$sector) {
		$sql = "INSERT INTO sectors (ar_name, district_id) VALUES (?,?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('si', $row['sector'], $district_id);
		$stmt->execute();
		$sector_id = $stmt->insert_id;
		echo ' insert id -----  ' . $stmt->insert_id;
	}

	// Streets
	$sql = "SELECT * FROM streets WHERE ar_name=? and sector_id=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("si", $row['street'], $sector_id);
	$stmt->execute();
	$sector = $stmt->get_result()->fetch_assoc();
	var_dump($sector);
	if(!$sector) {

		$sql = "INSERT INTO streets (ar_name, sector_id) VALUES (?,?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('si', $row['street'], $sector_id);
		$stmt->execute();
		$insert_id = $stmt->insert_id;
		echo ' insert id -----  ' . $stmt->insert_id;
	}

	 // fetch a row

}
