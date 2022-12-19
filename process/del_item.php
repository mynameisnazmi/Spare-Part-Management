<?php
session_start();
header('Content-type', 'application/json');
$status = false;
$msg = "";
$stsfile = false;
if (!empty($_POST['id']) && !empty($_SESSION['nik'])) {
    //post
    $id = $_POST['id'];
    $dbname = $_POST['db'];
    $clause = $_POST['cl'];

    include "db.php";

    if ($clause == "parts_code") {
        if (!empty($id)) { //cek id 
            $targetFilepdf =  "../pdf/" . $id . ".pdf"; //path data lama
            $targetFilepict =  "../pict/" . $id . ".png"; //path data lama
            if (file_exists($targetFilepict)) { //cek old
                if (unlink($targetFilepict)) {
                    if (file_exists($targetFilepdf)) {//cek old
                        unlink($targetFilepdf);
                    } 
                }
            }
        }
    }
        $query = "DELETE FROM $dbname WHERE $clause = '$id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            $status = true;
            $msg = "Success Deleted ";
        } else {
            $msg = ("Error description: " . mysqli_error($con));
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
