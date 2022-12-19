<?php
header('Content-type', 'application/json');
$status = "";
$msg = "";
if (!empty($_POST['submit'])) {

	$nik = $_POST['nik'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // encrypt password
	$name = ucwords($_POST['name']);
	$department = $_POST['department'];

	include "db.php";
	$cek = mysqli_query($con, "SELECT nik FROM user WHERE (nik = '$nik')");

	if (mysqli_num_rows($cek) <= 0) { //verify user
		$result = mysqli_query($con, "INSERT INTO user (nik,name,department,password) VALUES ('$nik','$name','$department','$password')"); //input data user
		if (!$result) {
			echo ("Error description: " . mysqli_error($con));
		} else {
			$status = true;
			$msg = "Sukses daftar !";
		}
	} else {
		$status = false;
		$msg = "User Sudah Terdaftar";
	}
	mysqli_close($con);
}
echo json_encode(
	array('status' => $status, 'msg' => $msg)
);
