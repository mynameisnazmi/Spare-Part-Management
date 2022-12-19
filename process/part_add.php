<?php
session_start();
header('Content-type', 'application/json');
$status = false;
$msg = "";
if (!empty($_POST['button']) && !empty($_SESSION['nik'])) {
	//post
	$partname = str_replace(" ", "_", strtolower($_POST['partname']));
	$spec = strtolower($_POST['spec']);
	$itemcode = strtolower($_POST['itemcode']);
	$unit = strtolower($_POST['unit']);
	$filepict = $_FILES["fileupload_pict"]["tmp_name"];
	$filepdf = $_FILES["fileupload_pdf"]["tmp_name"];
	$datenow = date("Ymd");

	include "db.php";
	if (empty($itemcode)) {
		$sts = false;
		do {
			$randnum = mt_rand();
			$cek = mysqli_query($con, "SELECT parts_code FROM parts WHERE (parts_code = '$randnum')");
			if (mysqli_num_rows($cek) > 0) {
				$sts = false;
			} else {
				$sts = true;
			}
			if ($sts) {
				$itemcode = $randnum;
			}
		} while ($sts == false);
	}

	$targetFilepict =  "../pict/" . $itemcode . ".png";
	$targetFilepdf =  "../pdf/" . $itemcode . ".pdf";
	if (!empty($filepict)) {
		if (file_exists($targetFilepict)) {
			$status = true;
			$msg = "File Sudah Terdaftar";
		} else {
			move_uploaded_file($filepict, $targetFilepict);
		}
	}

	if (!empty($filepdf)) {
		if (file_exists($targetFilepdf)) {
			$status = true;
			$msg = "File Sudah Terdaftar";
		} else {
			move_uploaded_file($filepdf, $targetFilepdf);
		}
	}

	$cek1 = mysqli_query($con, "SELECT parts_code FROM parts WHERE (parts_code = '$itemcode')");
	if (mysqli_num_rows($cek1) <= 0) {

		$cek2 = mysqli_query($con, "SELECT parts_code FROM parts WHERE (part_name = '$partname') AND (part_spec LIKE '%$spec%')");
		if (mysqli_num_rows($cek2) <= 0) {

			$result = mysqli_query($con, "INSERT INTO parts (parts_code,part_name,part_spec,part_unit) VALUES ('$itemcode','$partname','$spec','$unit')");
				if (!$result) {
					$msg = ("Error description: " . mysqli_error($con));
				} else {
					$status = true;
					$msg = "Item berhasil di tambahkan";
				}
			}
		else{
			$status = true;
			$msg = "Item Sudah Terdaftar";
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
