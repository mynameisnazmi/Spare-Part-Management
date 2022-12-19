<?php
session_start();
header('Content-type', 'application/json');
$status = false;
$msg = "";
$machid = "";
$partid = "";
if (!empty($_POST['button']) && !empty($_SESSION['nik'])) {
	//post
	$loc_id = strtolower($_POST['area']);
    $itemcode = strtolower($_POST['itemcode']);
    $partprio = strtolower($_POST['partprio']);
	$partused = $_POST['partused'];
	$note = strtolower($_POST['note']);
	$sprpart = $_POST['sprpart'];
	$datenow = date("Ymd");
	
	include "db.php";
	$q1 = mysqli_query($con, "SELECT loc_id FROM machine WHERE (loc_id = '$loc_id')"); //check data area
    while ($data = mysqli_fetch_row($q1)) {
        $machid= $data[0];
    }

    $q2 = mysqli_query($con, "SELECT parts_code FROM parts WHERE (parts_code = '$itemcode')");//check data part
    while ($data = mysqli_fetch_row($q2)) {
        $partid= $data[0];
    }
    $q3 = mysqli_query($con, "SELECT match_id FROM part_match WHERE (match_area = '$machid' AND match_part = '$partid')");
	if (mysqli_num_rows($q3) == 0 ) {
		$result = mysqli_query($con, 
        "INSERT INTO part_match (match_area,match_part,match_update,match_priority,match_used,match_spare,match_note)
        VALUES ('$machid','$partid','$datenow','$partprio','$partused','$sprpart','$note')");
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
