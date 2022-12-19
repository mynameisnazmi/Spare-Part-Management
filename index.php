<?php
session_start();
if (isset($_SESSION['nik']) && !empty($_SESSION['nik'])) {
	$msg = array();
	$msg[] = ["part_names", "lifetime", "load_cap", "load_act", "temp_act", "Decision"];
	include "./process/db.php";
	$query = "SELECT part_names, lifetime, load_cap, load_act, temp_act, changes FROM part_history";
	$q1 = mysqli_query($con, $query); //query  filter
	if (mysqli_num_rows($q1) > 0) {
		// output data of each row
		while ($data = mysqli_fetch_assoc($q1)) {
			$msg[] = $data;
		}
	}
	$filename = './data_history.csv';

	// open csv file for writing
	$f = fopen($filename, 'w');

	if ($f === false) {
		die('Error opening the file ' . $filename);
	}

	// write each row at a time to a file
	foreach ($msg as $row) {
		fputcsv($f, $row);
	}
	fclose($f);
	mysqli_close($con);
	include "./view/home.php";
} else {
	header("Location:./login.php");
	die();
}
