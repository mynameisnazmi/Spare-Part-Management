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
    pm.match_id,m.mach_name,m.mach_area,p.part_spec 
    FROM part_match pm, parts p, machine m
    WHERE (p.part_spec LIKE '%$key%' OR p.parts_code LIKE '$key%') AND (pm.match_part = p.parts_code ) AND (pm.match_area = m.loc_id) ORDER BY p.part_spec ASC "); //query  filter

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
