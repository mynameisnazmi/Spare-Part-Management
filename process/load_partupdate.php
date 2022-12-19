<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();
session_start();
if (isset($_SESSION['nik'])) {
    $id = $_POST['id'];

    $query ="SELECT parts_code,part_spec,part_name,part_unit,part_sts
             FROM parts
             WHERE (parts_code ='$id') ";

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
