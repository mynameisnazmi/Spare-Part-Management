<?php
// /*
// Error reporting helps you understand what's wrong with your code, remove in production.
// // */
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$var1 = "single_motor_module";
$var2 =  20453455;
$var3 = 60;
$var4 = 50;
$var5 = 78;

$read = shell_exec("C:/Users/NAZMI/AppData/Local/Programs/Python/Python39/python.exe C:/xampp/htdocs/spr_mgmt/phpcon.py $var1 $var2 $var3 $var4 $var5 ");
print_r($read);
