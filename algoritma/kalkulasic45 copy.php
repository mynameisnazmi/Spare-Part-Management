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

//variabel lifetime 
$lifetime_dataunique = 0;
$lifetime_datafilter = array();
$lifetime_datanew = array();
$lifetime_data = array();


$query = "SELECT lifetime
             FROM part_history";
$q1 = mysqli_query($con, $query); //query  data all data lifetime
if (mysqli_num_rows($q1) > 0) {
    $lifetime_dataunique = mysqli_num_rows($q1);
    // output data of each row
    while ($data = mysqli_fetch_row($q1)) {
        $lifetime_data[] = $data;
    }
} else {
    $lifetime_data[] = "Data Not Found !";
}
for ($i = 0; $i < $lifetime_dataunique; $i++) {
    $lifetime_data[$i] = round($lifetime_data[$i][0], -6); //convert from 2D to 1D and round
}
$lifetime_datafilter = array_unique($lifetime_data); //filter
sort($lifetime_datafilter); //sorting

$lf_count_fil = count($lifetime_datafilter);

for ($i = 0; $i < $lf_count_fil; $i++) {
    $lifetime_datanew[$i][0] = $lifetime_datafilter[$i];
    $lifetime_datanew[$i][1] = jmlcase_num("lifetime", $lifetime_datafilter[$i], 1); //jumlah case <=
    $lifetime_datanew[$i][2] = jmlcase_num("lifetime", $lifetime_datafilter[$i], 0); //jumlah case >
    $lifetime_datanew[$i][3] = jmlcaseno_num("lifetime", $lifetime_datafilter[$i], 1); //jumlah case No <=
    $lifetime_datanew[$i][4] = jmlcaseno_num("lifetime", $lifetime_datafilter[$i], 0); //jumlah case No >
    $lifetime_datanew[$i][5] = jmlcaseyes_num("lifetime", $lifetime_datafilter[$i], 1); //jumlah case yes <=
    $lifetime_datanew[$i][6] = jmlcaseyes_num("lifetime", $lifetime_datafilter[$i], 0); //jumlah case yes >
}
for ($i = 0; $i < $lf_count_fil; $i++) { //delete data if zero case
    if (($lifetime_datanew[$i][1] == 0) || ($lifetime_datanew[$i][2] == 0)) {
        unset($lifetime_datanew[$i]);
    }
}
$lifetime_datanew = array_values($lifetime_datanew); // rearrange index 
$lf_count_fil = count($lifetime_datanew);
for ($i = 0; $i < $lf_count_fil; $i++) {
    $lifetime_datanew[$i][7] = entropy_calc($lifetime_datanew[$i][1], $lifetime_datanew[$i][3], $lifetime_datanew[$i][5]); //entropy <=
    $lifetime_datanew[$i][8] = entropy_calc($lifetime_datanew[$i][2], $lifetime_datanew[$i][4], $lifetime_datanew[$i][6]); //entropy >
    $lifetime_datanew[$i][9] = $allcase_entropy - (gaininf_calc_poly($allcase, $lifetime_datanew[$i][1], $lifetime_datanew[$i][7]) + gaininf_calc_poly($allcase, $lifetime_datanew[$i][2], $lifetime_datanew[$i][8])); //gain inf
    $lifetime_datanew[$i][10] = splitfinf_calc_poly($allcase, $lifetime_datanew[$i][1]) + splitfinf_calc_poly($allcase, $lifetime_datanew[$i][2]); //spplitt info
    $lifetime_datanew[$i][11] = gainratio_calc($lifetime_datanew[$i][9], $lifetime_datanew[$i][10]); // gain ratio
    $lifetime_datanew[$i][12] = "lifetime";
}

///-----------------------------------------------------------------------------------------------//

//variabel load capicity 
$loadcap_dataunique = 0;
$loadcap_datafilter = array();
$loadcap_datanew = array();
$loadcap_data = array();

$query = "SELECT load_cap
             FROM part_history";
$q1 = mysqli_query($con, $query); //query  data all data load_cap
if (mysqli_num_rows($q1) > 0) {
    $loadcap_dataunique = mysqli_num_rows($q1);
    // output data of each row
    while ($data = mysqli_fetch_row($q1)) {
        $loadcap_data[] = $data;
    }
} else {
    $loadcap_data[] = "Data Not Found !";
}
for ($i = 0; $i < $loadcap_dataunique; $i++) {
    $loadcap_data[$i] = round($loadcap_data[$i][0], -1); //convert from 2D to 1D and round
}
$loadcap_datafilter = array_unique($loadcap_data); //filter
sort($loadcap_datafilter); //sorting

$lf_count_fil = count($loadcap_datafilter);

for ($i = 0; $i < $lf_count_fil; $i++) {
    $loadcap_datanew[$i][0] = $loadcap_datafilter[$i];
    $loadcap_datanew[$i][1] = jmlcase_num("load_cap", $loadcap_datafilter[$i], 1); //jumlah case <=
    $loadcap_datanew[$i][2] = jmlcase_num("load_cap", $loadcap_datafilter[$i], 0); //jumlah case >
    $loadcap_datanew[$i][3] = jmlcaseno_num("load_cap", $loadcap_datafilter[$i], 1); //jumlah case No <=
    $loadcap_datanew[$i][4] = jmlcaseno_num("load_cap", $loadcap_datafilter[$i], 0); //jumlah case No >
    $loadcap_datanew[$i][5] = jmlcaseyes_num("load_cap", $loadcap_datafilter[$i], 1); //jumlah case yes <=
    $loadcap_datanew[$i][6] = jmlcaseyes_num("load_cap", $loadcap_datafilter[$i], 0); //jumlah case yes >
}
for ($i = 0; $i < $lf_count_fil; $i++) { //delete data if zero case
    if (($loadcap_datanew[$i][1] == 0) || ($loadcap_datanew[$i][2] == 0)) {
        unset($loadcap_datanew[$i]);
    }
}
$loadcap_datanew = array_values($loadcap_datanew); // rearrange index 
$lf_count_fil = count($loadcap_datanew);
for ($i = 0; $i < $lf_count_fil; $i++) {
    $loadcap_datanew[$i][7] = entropy_calc($loadcap_datanew[$i][1], $loadcap_datanew[$i][3], $loadcap_datanew[$i][5]); //entropy <=
    $loadcap_datanew[$i][8] = entropy_calc($loadcap_datanew[$i][2], $loadcap_datanew[$i][4], $loadcap_datanew[$i][6]); //entropy >
    $loadcap_datanew[$i][9] = $allcase_entropy - (gaininf_calc_poly($allcase, $loadcap_datanew[$i][1], $loadcap_datanew[$i][7]) + gaininf_calc_poly($allcase, $loadcap_datanew[$i][2], $loadcap_datanew[$i][8])); //gain inf
    $loadcap_datanew[$i][10] = splitfinf_calc_poly($allcase, $loadcap_datanew[$i][1]) + splitfinf_calc_poly($allcase, $loadcap_datanew[$i][2]); //spplitt info
    $loadcap_datanew[$i][11] = gainratio_calc($loadcap_datanew[$i][9], $loadcap_datanew[$i][10]); // gain ratio
    $loadcap_datanew[$i][12] = "load_cap";
}

///-----------------------------------------------------------------------------------------------//

//variabel load actual 
$loadact_dataunique = 0;
$loadact_datafilter = array();
$loadact_datanew = array();
$loadact_data = array();


$query = "SELECT load_act
             FROM part_history";
$q1 = mysqli_query($con, $query); //query  data all data load_act
if (mysqli_num_rows($q1) > 0) {
    $loadact_dataunique = mysqli_num_rows($q1);
    // output data of each row
    while ($data = mysqli_fetch_row($q1)) {
        $loadact_data[] = $data;
    }
} else {
    $loadact_data[] = "Data Not Found !";
}
for ($i = 0; $i < $loadact_dataunique; $i++) {
    $loadact_data[$i] = round($loadact_data[$i][0], -1); //convert from 2D to 1D and round
}
$loadact_datafilter = array_unique($loadact_data); //filter
sort($loadact_datafilter); //sorting

$lf_count_fil = count($loadact_datafilter);

for ($i = 0; $i < $lf_count_fil; $i++) {
    $loadact_datanew[$i][0] = $loadact_datafilter[$i];
    $loadact_datanew[$i][1] = jmlcase_num("load_act", $loadact_datafilter[$i], 1); //jumlah case <=
    $loadact_datanew[$i][2] = jmlcase_num("load_act", $loadact_datafilter[$i], 0); //jumlah case >
    $loadact_datanew[$i][3] = jmlcaseno_num("load_act", $loadact_datafilter[$i], 1); //jumlah case No <=
    $loadact_datanew[$i][4] = jmlcaseno_num("load_act", $loadact_datafilter[$i], 0); //jumlah case No >
    $loadact_datanew[$i][5] = jmlcaseyes_num("load_act", $loadact_datafilter[$i], 1); //jumlah case yes <=
    $loadact_datanew[$i][6] = jmlcaseyes_num("load_act", $loadact_datafilter[$i], 0); //jumlah case yes >
}
for ($i = 0; $i < $lf_count_fil; $i++) { //delete data if zero case
    if (($loadact_datanew[$i][1] == 0) || ($loadact_datanew[$i][2] == 0)) {
        unset($loadact_datanew[$i]);
    }
}
$loadact_datanew = array_values($loadact_datanew); // rearrange index 
$lf_count_fil = count($loadact_datanew);
for ($i = 0; $i < $lf_count_fil; $i++) {
    $loadact_datanew[$i][7] = entropy_calc($loadact_datanew[$i][1], $loadact_datanew[$i][3], $loadact_datanew[$i][5]); //entropy <=
    $loadact_datanew[$i][8] = entropy_calc($loadact_datanew[$i][2], $loadact_datanew[$i][4], $loadact_datanew[$i][6]); //entropy >
    $loadact_datanew[$i][9] = $allcase_entropy - (gaininf_calc_poly($allcase, $loadact_datanew[$i][1], $loadact_datanew[$i][7]) + gaininf_calc_poly($allcase, $loadact_datanew[$i][2], $loadact_datanew[$i][8])); //gain inf
    $loadact_datanew[$i][10] = splitfinf_calc_poly($allcase, $loadact_datanew[$i][1]) + splitfinf_calc_poly($allcase, $loadact_datanew[$i][2]); //spplitt info
    $loadact_datanew[$i][11] = gainratio_calc($loadact_datanew[$i][9], $loadact_datanew[$i][10]); // gain ratio
    $loadact_datanew[$i][12] = "load_act";
}


///-----------------------------------------------------------------------------------------------//

//variabel temperature actual 
$tempact_dataunique = 0;
$tempact_datafilter = array();
$tempact_datanew = array();
$tempact_data = array();

$query = "SELECT temp_act
             FROM part_history";
$q1 = mysqli_query($con, $query); //query  data all data temp_act
if (mysqli_num_rows($q1) > 0) {
    $tempact_dataunique = mysqli_num_rows($q1);
    // output data of each row
    while ($data = mysqli_fetch_row($q1)) {
        $tempact_data[] = $data;
    }
} else {
    $tempact_data[] = "Data Not Found !";
}
for ($i = 0; $i < $tempact_dataunique; $i++) {
    $tempact_data[$i] = round($tempact_data[$i][0], -1); //convert from 2D to 1D and round
}
$tempact_datafilter = array_unique($tempact_data); //filter
sort($tempact_datafilter); //sorting

$lf_count_fil = count($tempact_datafilter);

for ($i = 0; $i < $lf_count_fil; $i++) {
    $tempact_datanew[$i][0] = $tempact_datafilter[$i];
    $tempact_datanew[$i][1] = jmlcase_num("temp_act", $tempact_datafilter[$i], 1); //jumlah case <=
    $tempact_datanew[$i][2] = jmlcase_num("temp_act", $tempact_datafilter[$i], 0); //jumlah case >
    $tempact_datanew[$i][3] = jmlcaseno_num("temp_act", $tempact_datafilter[$i], 1); //jumlah case No <=
    $tempact_datanew[$i][4] = jmlcaseno_num("temp_act", $tempact_datafilter[$i], 0); //jumlah case No >
    $tempact_datanew[$i][5] = jmlcaseyes_num("temp_act", $tempact_datafilter[$i], 1); //jumlah case yes <=
    $tempact_datanew[$i][6] = jmlcaseyes_num("temp_act", $tempact_datafilter[$i], 0); //jumlah case yes >
}
for ($i = 0; $i < $lf_count_fil; $i++) { //delete data if zero case
    if (($tempact_datanew[$i][1] == 0) || ($tempact_datanew[$i][2] == 0)) {
        unset($tempact_datanew[$i]);
    }
}
$tempact_datanew = array_values($tempact_datanew); // rearrange index 
$lf_count_fil = count($tempact_datanew);
for ($i = 0; $i < $lf_count_fil; $i++) {
    $tempact_datanew[$i][7] = entropy_calc($tempact_datanew[$i][1], $tempact_datanew[$i][3], $tempact_datanew[$i][5]); //entropy <=
    $tempact_datanew[$i][8] = entropy_calc($tempact_datanew[$i][2], $tempact_datanew[$i][4], $tempact_datanew[$i][6]); //entropy >
    $tempact_datanew[$i][9] = $allcase_entropy - (gaininf_calc_poly($allcase, $tempact_datanew[$i][1], $tempact_datanew[$i][7]) + gaininf_calc_poly($allcase, $tempact_datanew[$i][2], $tempact_datanew[$i][8])); //gain inf
    $tempact_datanew[$i][10] = splitfinf_calc_poly($allcase, $tempact_datanew[$i][1]) + splitfinf_calc_poly($allcase, $tempact_datanew[$i][2]); //spplitt info
    $tempact_datanew[$i][11] = gainratio_calc($tempact_datanew[$i][9], $tempact_datanew[$i][10]); // gain ratio
    $tempact_datanew[$i][12] = "temp_act";
}

///////////////////////////////----------------------//////////////////////

$nodearr[] =   $lifetime_datanew[getmaxgaindata($lifetime_datanew, 9)]; //DATA MAXX GAIN INF NOMINAL
$nodearr[] =  $loadcap_datanew[getmaxgaindata($loadcap_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[] =   $loadact_datanew[getmaxgaindata($loadact_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[] =   $tempact_datanew[getmaxgaindata($tempact_datanew, 9)]; //DATA MAXX GAIN INF  NOMINAL
$nodearr[4][11] = $partname_gainratio;
$nodearr[4][12] = "part_names";
$node = $nodearr[getmaxgaindata($nodearr, 11)]; //get node 


// $partname_gainratio; //gain ratio

//root node
echo '<pre>';
exit(print_r($nodearr));

mysqli_close($con);
