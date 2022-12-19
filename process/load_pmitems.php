<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();
session_start();
$text = "";
$patrn = "";
if (isset($_SESSION['nik'])) {
    function prediction_data($partnamespre, $matchid)
    {
        $datapredict = array();
        $query_datahist = mysqli_query($GLOBALS['con'], "SELECT history_date,load_cap,load_act,temp_act FROM `part_history` WHERE `match_ids` = '$matchid' AND `part_names` = '$partnamespre' AND `changes` = 'Yes' ORDER BY `part_history`.`history_date`  DESC LIMIT 0,1"); //must be change in implementasion DESC
        if (mysqli_num_rows($query_datahist) > 0) {
            $datenow = date("Y-m-d H:i:s");
            while ($date = mysqli_fetch_row($query_datahist)) {
                $datapredict = $date;
            }
            $dt1 = strtotime($datapredict[0]);
            $dt2 = strtotime($datenow);
            $datapredict[0] = $dt2 - $dt1; //now - last change

            $var1 = $partnamespre;
            $var2 = $datapredict[0];
            $var3 = $datapredict[1];
            $var4 = $datapredict[2];
            $var5 = $datapredict[3];
            $result_predict = shell_exec("C:/Users/NAZMI/AppData/Local/Programs/Python/Python39/python.exe C:/xampp/htdocs/spr_mgmt/phpcon.py $var1 $var2 $var3 $var4 $var5 ");
            return $result_predict;
        }
    }
    $id = $_POST['id'];
    //$patrn = $_POST['pattern']; get data kolom pencarian

    $query = "SELECT *
             FROM part_match pm,parts p,machine m
             WHERE (match_id = '$id') AND (pm.match_part = p.parts_code ) AND (pm.match_area = m.loc_id)";

    include "db.php";
    $q1 = mysqli_query($con, $query); //query  filter
    if (mysqli_num_rows($q1) > 0) {
        // output data of each row
        while ($data = mysqli_fetch_assoc($q1)) {
            $msg[] = $data; // mengambil data spesifik partname dan itemcode lalu dikomparasi dengan data kolom pencarian lalu algoritma KMP
        }
        $msg[0]["predict"] = prediction_data($msg[0]["part_name"], $msg[0]["match_id"]); //proses predict
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
