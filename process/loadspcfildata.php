<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();
session_start();

//generete clause
function generetestr($arr, $clausetbl)
{
    $result = "";
    if (!isset($arr) || empty($arr)) {
        return $result = "";
    } else {
        $datalen = count($arr) - 1;
        $result .= '(';
        for ($i = 0; $i <= $datalen; $i++) {
            $result .=  $clausetbl . " = '" . $arr[$i] . "'";
            if ($i !== $datalen) {
                $result .= " OR ";
            }
        }
        $result .= ") AND ";
    }
    return $result;
}

if (isset($_SESSION['nik'])) {

    $datamach = generetestr(json_decode($_POST['datamach']), "m.mach_name");
    $dataloc = generetestr(json_decode($_POST['dataloc']), "m.mach_area");
    $join = "(pm.match_part = p.parts_code ) AND (pm.match_area = m.loc_id)";
    //merge cluase
    $merge = "WHERE" . $datamach . $dataloc . $join;
    $query = "SELECT p.part_name
             FROM parts p, part_match pm, machine m
             $merge
             ORDER BY p.part_name ASC";

    include "db.php";
    $q1 = mysqli_query($con, $query); //query  filter
    if (mysqli_num_rows($q1) > 0) {
        // output data of each row
        while ($data = mysqli_fetch_row($q1)) {
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
