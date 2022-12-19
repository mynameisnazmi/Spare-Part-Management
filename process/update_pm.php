<?php
session_start();
header('Content-type', 'application/json');
$status = false;
$msg = "";
$dataarr = array();
if (!empty($_POST['button']) && !empty($_SESSION['nik'])) {
	$y = "No";
	//post
	$match_id = $_POST['match_id'];
	$area = strtolower($_POST['area']);
	$itemcode = strtolower($_POST['itemcode']);
	$partprio = strtolower($_POST['partprio']);
	$tempact = $_POST['tempact'];
	$lodcap = $_POST['lodcap'];
	$lodact = $_POST['lodact'];
	$partused = $_POST['partused'];
	$sprpart = $_POST['sprpart'];
	$note = strtolower($_POST['note']);
	$datenow = date("Y-m-d H:i:s");

	include "db.php";

	function defValier(string $thecol, $thepart)
	{ //function query thelatest data
		include "db.php";
		$query = "SELECT `$thecol` FROM `part_history` WHERE `part_names` = '$thepart' ORDER BY `history_date` DESC LIMIT 0,1";
		$res = mysqli_query($con, $query);
		while ($data = mysqli_fetch_row($res)) {
			return $data[0];
		}
	}

	$q1 = mysqli_query($con, "SELECT match_id, match_area, match_part, match_used, match_spare, match_update FROM part_match WHERE (match_id = '$match_id') ");
	if (mysqli_num_rows($q1) == 1) {
		while ($data = mysqli_fetch_row($q1)) {
			$dataarr = $data;
		}
		$query = "UPDATE part_match SET 
			match_priority= '$partprio',
			match_note= '$note' WHERE (match_id = '$dataarr[0]')"; //hanya priority dan keterangan 

		$result = mysqli_query($con, $query);
		if (!$result) {
			$status = false;
			$msg = ("Error description: " . mysqli_error($con));
		} else {
			$status = true;
			$msg = "Sukses Update Data";
		}
		if (($area == $dataarr[1] && $itemcode == $dataarr[2]) && ($partused == $dataarr[3] && $sprpart == $dataarr[4])) { //jika semua sama
			$status = true;
			$msg = "Part yang sama sudah terdaftar";
		} else if (($area == $dataarr[1] && $itemcode == $dataarr[2]) && ($partused != $dataarr[3] || $sprpart != $dataarr[4])) { //jika hanya spare atau used
			if ($sprpart < $dataarr[4]) {
				$y = "Yes";
			}
			$query = "UPDATE part_match SET 
			match_update= '$datenow',
			match_priority= '$partprio',
			match_used= '$partused',
			match_spare= '$sprpart',
			match_note= '$note' WHERE (match_id = '$dataarr[0]')";
			$result = mysqli_query($con, $query);
			if (!$result) {
				$status = false;
				$msg = ("Error description: " . mysqli_error($con));
			} else {
				$status = true;
				$msg = "Sukses Update Data";
			}
		} else { // jika semua berbeda
			if ($sprpart < $dataarr[4]) {
				$y = "Yes";
			}
			$query = "UPDATE part_match SET 
			match_area= '$area',
			match_part= '$itemcode',
			match_update= '$datenow',
			match_priority= '$partprio',
			match_used= '$partused',
			match_spare= '$sprpart',
			match_note= '$note' WHERE (match_id = '$dataarr[0]')";
			$result = mysqli_query($con, $query);
			if (!$result) {
				$status = false;
				$msg = ("Error description: " . mysqli_error($con));
			} else {
				$status = true;
				$msg = "Sukses Update Data ";
			}
		}

		//record to part_history
		$part_category = ""; //jenis part
		$dt1 = strtotime($dataarr[5]);
		$dt2 = strtotime($datenow);
		$secs = $dt2 - $dt1; //lifetime / s
		//$days = $secs / 86400;
		$q2 = mysqli_query($con, "SELECT part_name FROM parts WHERE (parts_code = '$itemcode') ");
		if (mysqli_num_rows($q2) == 1) {
			while ($data = mysqli_fetch_row($q2)) {
				$part_category = $data[0];
			}
			//check data for zero value
			if (empty($_POST['tempact'])) {
				$tempact = defValier("temp_act", $part_category);
			}
			if (empty($_POST['lodact'])) {
				$lodact = defValier("load_act", $part_category);
			}
			if (empty($_POST['lodcap'])) {
				$lodcap = defValier("load_cap", $part_category);
			}


			$result = mysqli_query(
				$con,
				"INSERT INTO part_history (match_ids,part_names,history_date, lifetime, load_cap, load_act, temp_act, changes) VALUES ('$dataarr[0]','$part_category','$datenow','$secs','$lodcap','$lodact','$tempact','$y')"
			);
			if (!$result) {
				echo ("Error description: " . mysqli_error($con));
			} else {
				$status = true;
				$msg = "Sukses Update Data ";
			}
		}
	} else {
		$status = false;
		$msg = "Tidak dapat mengambil data";
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
