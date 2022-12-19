<?php 
header('Content-type', 'application/json');
$status = false;
$msg = "";
$cname = "";
$cdepartment = "";
if(isset($_POST['submit'])){

	$nik = $_POST['nik'];
	$password = $_POST['password'];

		if ( ctype_digit($nik) ){ //nik number
			session_start();
			include "db.php";
			$hash = mysqli_query($con,"SELECT password FROM user WHERE (nik = '$nik')"); //query gethash 
			
			if( mysqli_num_rows($hash) === 1){
				$hdata = mysqli_fetch_row($hash); //get hashpassword
				if (password_verify($password, $hdata[0])) { //verify
					$query = mysqli_query($con,"SELECT nik,name,department FROM user WHERE (nik = '$nik')"); //query data
					$data = mysqli_fetch_row($query);
					$status = true ;
					$msg = "Sukses login";
					$_SESSION['nik'] = $data[0]; //session nik
					$cname = $data[1]; 
					$cdepartment = $data[2]; 
				} else {
					$msg = "Password salah !";
					$status = false ;
				}				
			}
			else{
			$msg = "User belum terdaftar";
			$status = false ;
			}
			mysqli_close($con);
		}
		else{
			$msg = "Gunakan angka pada NIK !";
			$status = false ;
		}
	}
	echo json_encode(
		array(
			'status' => $status,
			'msg' => $msg,
			'cname' => $cname,
			'cdepartment' => $cdepartment
		   )
		);

 ?>