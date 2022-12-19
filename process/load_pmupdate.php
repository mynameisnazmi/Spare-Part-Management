<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();
session_start();
if (isset($_SESSION['nik'])) {
    $id = $_POST['id'];

    $query ="SELECT  m.loc_id, m.mach_name,m.mach_area,pm.match_id,pm.match_part,pm.match_priority,pm.match_used,pm.match_spare,pm.match_note
             FROM part_match pm, machine m
             WHERE (match_id = '$id') AND (pm.match_area = m.loc_id)";

    include "db.php";
    $q1 = mysqli_query($con, $query); //query  filter
    if (mysqli_num_rows($q1) > 0) {
        // output data of each row
        while ($data = mysqli_fetch_assoc($q1)) {
            $msg[] = $data;
        }
        $status = true;
    } else {
        $msg[] = "Data Not Found !";
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
