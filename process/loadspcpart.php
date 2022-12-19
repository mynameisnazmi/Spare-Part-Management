<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();

session_start();
if (isset($_SESSION['nik'])) {
    include "db.php";
    $key = $_POST['data'];
    $q1 = mysqli_query($con, 
    "SELECT DISTINCT 
    parts_code,part_name
    FROM parts
    WHERE (parts_code LIKE '%$key%' OR part_spec LIKE '%$key%' )"); //query  filter

    if (mysqli_num_rows($q1) > 0) {
        // output data of each row
        while ($data = mysqli_fetch_assoc($q1)) {
            $msg[] = $data;
            $status = true;
        }
    } else {
        //$msg = "Eror query" . mysqli_error($con);
        $status = false;
    }
	mysqli_close($con);
} else {
    $msg = "User belum terdaftar";
    $status = false;
}

echo json_encode(
    array(
        'status' => $status,
        'msg' => $msg
    )
);
