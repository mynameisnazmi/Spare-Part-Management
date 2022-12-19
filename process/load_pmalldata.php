<?php
header('Content-type', 'application/json');
$status = false;
$msg = array();
$limitpages = 0;
$mach = "";
$loc = "";
$cat = "";

$j1 = array("p.parts_code ");
$j2 = array("m.loc_id");

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

session_start();
if (isset($_SESSION['nik'])) {
    $dataperpage = 6;
    $page = isset($_POST['paging']) ? (int)$_POST['paging'] : 1;
    $offset = ($page > 1) ? ($page * $dataperpage) - $dataperpage : 0;

    //receive data
    $tes = json_decode($_POST['mach']);
    $merge = "";
    $mac = generetestr(json_decode($_POST['mach']), "m.mach_name");
    $loc = generetestr(json_decode($_POST['loc']), "m.mach_area");
    $cat = generetestr(json_decode($_POST['cat']), "p.part_name");
    $join = "(pm.match_part = p.parts_code ) AND (pm.match_area = m.loc_id)";
    include "db.php";
    //merge cluase
    $merge = "WHERE" . $mac . $loc . $cat . $join;
    // $charpos = strripos($merge,")"); 
    // // $strposlen =strlen($merge);
    // // $charpos = $strposlen - $charpos;

    $query = "SELECT * FROM part_match pm,parts p,machine m
             $merge
             ORDER BY p.part_name 
             ASC LIMIT $offset, $dataperpage";
    //print_r($query);
    //page calc
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
    // echo '<pre>';
    // exit(print_r($result_predict));

    $q1 = mysqli_query($con, $query); //query  filter
    $q2 = mysqli_query($con, "SELECT match_id FROM part_match");
    $limitpages = ceil(mysqli_num_rows($q2) / $dataperpage); //pagesnumber
    //print_r($limitpages);
    //$msg = ("Error description: " . mysqli_error($con));
    if (mysqli_num_rows($q1) > 0) {
        // output data of each row
        while ($data = mysqli_fetch_assoc($q1)) {
            $msg[] = $data;
        }
        $artt = count($msg);
        for ($pd = 0; $pd < $artt; $pd++) {
            $msg[$pd]["predict"] = prediction_data($msg[$pd]["part_name"], $msg[$pd]["match_id"]); //proses predict with tree
        }
        $status = true;
    } else {
        $msg[] = "Data Tidak Ditemukan !";
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
        'limitpages' => $limitpages,
        'msg' => $msg,
        'test' => $tes
    )
);
