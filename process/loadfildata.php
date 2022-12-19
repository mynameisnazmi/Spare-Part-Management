<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();
$msgloc = array();
$msgcat = array();

session_start();
if (isset($_SESSION['nik'])) {
    include "db.php";
    $q1 = mysqli_query($con, "SELECT DISTINCT m.mach_name,m.mach_area,p.part_name
    FROM part_match pm, parts p , machine m WHERE (pm.match_part = p.parts_code) AND (pm.match_area = m.loc_id)"); //query  filter

    if (mysqli_num_rows($q1) > 0) {
        // output data of each row
        while ($data = mysqli_fetch_row($q1)) {
            $msg[] = $data;
        }
        $status = true;
    } else {
        $msg = "Data Not Found !";
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
        // 'msgmach' => $msgmach ,
        // 'msgloc' => $msgloc,
        'msg' => $msg
    )
);
