<?php
session_start();
header('Content-type', 'application/json');
$status = false;
$msg = "";
if (!empty($_POST['button']) && !empty($_SESSION['nik'])) {
	//post
	$partloc = strtolower($_POST['partloc']);
	$partof = strtolower($_POST['partof']);	
	
	include "db.php";
	$cek = mysqli_query($con, "SELECT loc_id FROM machine WHERE (mach_name = '$partof' AND mach_area = '$partloc')");
	if (mysqli_num_rows($cek) <= 0) {
		$result = mysqli_query($con, "INSERT INTO machine (mach_name,mach_area) VALUES ('$partof','$partloc')");
		if (!$result) {
			$msg = ("Error description: " . mysqli_error($con));
		} else {
			$status = true;
			$msg = "Item berhasil di tambahkan";
		}
	} else {
		$status = true;
		$msg = "Item Sudah Terdaftar";
	}

	$status = true;
	mysqli_close($con);
}
//else{header("location:index.php");}

echo json_encode(
	array(
		'status' => $status,
		'msg' => $msg
	)
);
