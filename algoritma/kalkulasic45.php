<?php
include "../process/db.php";


function jmlcase(string $theEntity, $theClause)
{ // jml case
    //include "../process/db.php";
    $query = "SELECT `$theEntity` FROM `part_history` WHERE `part_names` = '$theClause'";
    $result = mysqli_query($GLOBALS['con'], $query);
    return mysqli_num_rows($result);
}
function jmlcase_no(string $theEntity, $theClause)
{ // jml case yes
    //include "../process/db.php";
    $query = "SELECT `$theEntity` FROM `part_history` WHERE `part_names` = '$theClause' AND `changes` = 'No'";
    $result = mysqli_query($GLOBALS['con'], $query);
    return mysqli_num_rows($result);
}
function jmlcase_yes(string $theEntity, $theClause)
{ // jml case yes
    //include "../process/db.php";
    $query = "SELECT `$theEntity` FROM `part_history` WHERE `part_names` = '$theClause' AND `changes` = 'Yes'";
    $result = mysqli_query($GLOBALS['con'], $query);
    return mysqli_num_rows($result);
}
function entropy_calc(float $jmlcase, $nocase, $yescase)
{ // entropi kalkulasi
    $result = (-$nocase / $jmlcase * log($nocase / $jmlcase, 2)) + (-$yescase / $jmlcase * log($yescase / $jmlcase, 2));
    return $result;
}
function gaininf_calc_poly(float $allcase, $entitycase, $entropycase)
{ //gain Inf Polynominal
    $result = $entitycase / $allcase * $entropycase;
    return $result;
}
function splitfinf_calc_poly(float $allcase, $entitycase)
{
    $result = (-$entitycase / $allcase * log($entitycase / $allcase, 2));
    return $result;
}
function gainratio_calc(float $gaininf, $splitinf)
{
    $result = $gaininf / $splitinf;
    return $result;
}

/////////////////--------------------//////////////////////

function jmlcase_num(string $theEntity, $theClause, bool $mode)
{ // jml case
    //include "../process/db.php";
    if ($mode) {
        $query = "SELECT `$theEntity` FROM `part_history` WHERE `$theEntity` <= '$theClause'";
        $result = mysqli_query($GLOBALS['con'], $query);
        return mysqli_num_rows($result);
    } else {
        $query = "SELECT `$theEntity` FROM `part_history` WHERE `$theEntity` > '$theClause'";
        $result = mysqli_query($GLOBALS['con'], $query);
        return mysqli_num_rows($result);
    }
}
function jmlcaseno_num(string $theEntity, $theClause, bool $mode)
{ // jml case
    //include "../process/db.php";
    if ($mode) {
        $query = "SELECT `$theEntity` FROM `part_history` WHERE `$theEntity` <= '$theClause' AND `changes` = 'No'";
        $result = mysqli_query($GLOBALS['con'], $query);
        return mysqli_num_rows($result);
    } else {
        $query = "SELECT `$theEntity` FROM `part_history` WHERE `$theEntity` > '$theClause' AND `changes` = 'No'";
        $result = mysqli_query($GLOBALS['con'], $query);
        return mysqli_num_rows($result);
    }
}
function jmlcaseyes_num(string $theEntity, $theClause, bool $mode)
{ // jml case
    //include "../process/db.php";
    if ($mode) {
        $query = "SELECT `$theEntity` FROM `part_history` WHERE `$theEntity` <= '$theClause' AND `changes` = 'Yes'";
        $result = mysqli_query($GLOBALS['con'], $query);
        return mysqli_num_rows($result);
    } else {
        $query = "SELECT `$theEntity` FROM `part_history` WHERE `$theEntity` > '$theClause' AND `changes` = 'Yes'";
        $result = mysqli_query($GLOBALS['con'], $query);
        return mysqli_num_rows($result);
    }
}
function getmaxgaindata(array $arrdata, int $idx)
{
    $maxdata = max(array_column($arrdata, $idx)); //get maxx value;
    $getdata = array_search($maxdata, array_column($arrdata, $idx)); //getindex maxx data
    return $getdata;
}

//variabel all case
session_start();
$alldata = array();
$allcase = 0;
$allcase_no = 0;
$allcase_yes = 0;
$allcase_entropy = 0;

$nodearr = array();
$node = array();

/////////////////////////////////////

$query = "SELECT part_names FROM `part_history`";
$result = mysqli_query($GLOBALS['con'], $query);
$allcase = mysqli_num_rows($result); //count all case

$query = "SELECT part_names FROM `part_history` WHERE `changes` = 'No'";
$result = mysqli_query($GLOBALS['con'], $query);
$allcase_no = mysqli_num_rows($result); //count all case NO

$query = "SELECT part_names FROM `part_history` WHERE `changes` = 'Yes'";
$result = mysqli_query($GLOBALS['con'], $query);
$allcase_yes = mysqli_num_rows($result); //count all case YES

$allcase_entropy = entropy_calc($allcase, $allcase_no, $allcase_yes);
///-----------------------------------------------------------------------------------------------//

//variabel partname
$partname_data = array();
$partname_gaininf = 0;
$partname_splitinf = 0;
$partname_gainsum = 0;
$partname_gainratio = 0;
$partname_dataunique = 0;

$query = "SELECT DISTINCT part_names
             FROM part_history";
$q1 = mysqli_query($con, $query); //query  data unique
if (mysqli_num_rows($q1) > 0) {
    $partname_dataunique = mysqli_num_rows($q1);
    // output data of each row
    while ($data = mysqli_fetch_row($q1)) {
        $partname_data[] = $data;
    }
} else {
    $partname_data[] = "Data Not Found !";
}
for ($i = 0; $i < $partname_dataunique; $i++) {
    $partname_data[$i][1] = jmlcase("part_names", $partname_data[$i][0]); //jumlah case
    $partname_data[$i][2] = jmlcase_no("part_names", $partname_data[$i][0]); //jumlah case no
    $partname_data[$i][3] = jmlcase_yes("part_names", $partname_data[$i][0]); //jumlah case yes
    $partname_data[$i][4] = entropy_calc($partname_data[$i][1], $partname_data[$i][2], $partname_data[$i][3]); //entropy
    $partname_data[$i][5] = gaininf_calc_poly($allcase, $partname_data[$i][1], $partname_data[$i][4]); //gain inf
    $partname_data[$i][6] = splitfinf_calc_poly($allcase, $partname_data[$i][1]); //spplitt info
}
for ($i = 0; $i < $partname_dataunique; $i++) {
    $partname_gainsum += $partname_data[$i][5]; //gain jumalh
}
$partname_gaininf = $allcase_entropy - $partname_gainsum; //gain inf entity 
for ($i = 0; $i < $partname_dataunique; $i++) {
    $partname_splitinf += $partname_data[$i][6]; //split info entity
}
$partname_gainratio = gainratio_calc($partname_gaininf, $partname_splitinf); // gain ratio


///-----------------------------------------------------------------------------------------------//
function calcnominal_data(string $selcom, $query, int $round)
{
    //variabel lifetime 
    $dataunique = 0;
    $datafilter = array();
    $datanew = array();
    $data = array();



    $q1 = mysqli_query($GLOBALS['con'], $query); //query  data all data lifetime
    if (mysqli_num_rows($q1) > 0) {
        $dataunique = mysqli_num_rows($q1);
        // output data of each row
        while ($dataq = mysqli_fetch_row($q1)) {
            $data[] = $dataq;
        }
    } else {
        $data[] = "Data Not Found !";
    }
    for ($i = 0; $i < $dataunique; $i++) {
        $data[$i] = round($data[$i][0], $round); //convert from 2D to 1D and round
    }
    $datafilter = array_unique($data); //filter
    sort($datafilter); //sorting

    $lf_count_fil = count($datafilter);

    for ($i = 0; $i < $lf_count_fil; $i++) {
        $datanew[$i][0] = $datafilter[$i];
        $datanew[$i][1] = jmlcase_num($selcom, $datafilter[$i], 1); //jumlah case <=
        $datanew[$i][2] = jmlcase_num($selcom, $datafilter[$i], 0); //jumlah case >
        $datanew[$i][3] = jmlcaseno_num($selcom, $datafilter[$i], 1); //jumlah case No <=
        $datanew[$i][4] = jmlcaseno_num($selcom, $datafilter[$i], 0); //jumlah case No >
        $datanew[$i][5] = jmlcaseyes_num($selcom, $datafilter[$i], 1); //jumlah case yes <=
        $datanew[$i][6] = jmlcaseyes_num($selcom, $datafilter[$i], 0); //jumlah case yes >
    }
    for ($i = 0; $i < $lf_count_fil; $i++) { //delete data if zero case
        if (($datanew[$i][1] == 0) || ($datanew[$i][2] == 0)) {
            unset($datanew[$i]);
        }
    }
    $datanew = array_values($datanew); // rearrange index 
    $lf_count_fil = count($datanew);
    for ($i = 0; $i < $lf_count_fil; $i++) {
        $datanew[$i][7] = entropy_calc($datanew[$i][1], $datanew[$i][3], $datanew[$i][5]); //entropy <=
        $datanew[$i][8] = entropy_calc($datanew[$i][2], $datanew[$i][4], $datanew[$i][6]); //entropy >
        $datanew[$i][9] = $GLOBALS['allcase_entropy'] - (gaininf_calc_poly($GLOBALS['allcase'], $datanew[$i][1], $datanew[$i][7]) + gaininf_calc_poly($GLOBALS['allcase'], $datanew[$i][2], $datanew[$i][8])); //gain inf
        $datanew[$i][10] = splitfinf_calc_poly($GLOBALS['allcase'], $datanew[$i][1]) + splitfinf_calc_poly($GLOBALS['allcase'], $datanew[$i][2]); //spplitt info
        $datanew[$i][11] = gainratio_calc($datanew[$i][9], $datanew[$i][10]); // gain ratio
        $datanew[$i][12] = $selcom;
    }
    return $datanew;
}

///////////////////////////////----------------------//////////////////////
//generete clause
function generetestr($arr)
{
    $result = "";
    if (!isset($arr) || empty($arr)) {
        return $result = "";
    } else {
        $result .= '(';
        $result .=  $arr[12] . " = '" . $arr[0] . "'";
        $result .= ")";
    }
    return $result;
}

$q = "SELECT lifetime FROM part_history";
$lifetime_datanew = calcnominal_data("lifetime", $q, -6);
$q = "SELECT load_cap FROM part_history";
$loadcap_datanew = calcnominal_data("load_cap", $q, -1);
$q = "SELECT load_act FROM part_history";
$loadact_datanew = calcnominal_data("load_act", $q, -1);
$q = "SELECT temp_act FROM part_history";
$tempact_datanew = calcnominal_data("temp_act", $q, -1);
$nodearr[] =   $lifetime_datanew[getmaxgaindata($lifetime_datanew, 9)]; //DATA MAXX GAIN INF NOMINAL
$nodearr[] =  $loadcap_datanew[getmaxgaindata($loadcap_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[] =   $loadact_datanew[getmaxgaindata($loadact_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[] =   $tempact_datanew[getmaxgaindata($tempact_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[4][11] = $partname_gainratio;
$nodearr[4][12] = "part_names";
$node = $nodearr[getmaxgaindata($nodearr, 11)]; //get node 

$q = "SELECT lifetime FROM part_history";
$lifetime_datanew = calcnominal_data("lifetime", $q, -6);
$q = "SELECT load_act FROM part_history";
$loadact_datanew = calcnominal_data("load_act", $q, -1);
$q = "SELECT temp_act FROM part_history";
$tempact_datanew = calcnominal_data("temp_act", $q, -1);
$nodearr[] =   $lifetime_datanew[getmaxgaindata($lifetime_datanew, 9)]; //DATA MAXX GAIN INF NOMINAL
$nodearr[] =   $loadact_datanew[getmaxgaindata($loadact_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[] =   $tempact_datanew[getmaxgaindata($tempact_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[4][11] = $partname_gainratio;
$nodearr[4][12] = "part_names";


$node = $nodearr[getmaxgaindata($nodearr, 11)]; //get node 

$strq = "";
$strq .= generetestr($node);

//root node
echo '<pre>';
exit(print_r($strq));

mysqli_close($con);
