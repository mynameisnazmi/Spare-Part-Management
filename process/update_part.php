<?php
session_start();
header('Content-type', 'application/json');
$status = false;
$msg = "";
if (!empty($_POST['button']) && !empty($_SESSION['nik'])) {
    //post
    $part_codeold = $_POST['parts_code']; //old
    $part_codenew = strtolower($_POST['itemcode']); //new
    $part_sts = strtolower($_POST['part_sts']);
    $partname = str_replace(" ", "_", strtolower($_POST['partname']));
    $spec = strtolower($_POST['spec']);
    $unit = strtolower($_POST['unit']);
    $filepict = $_FILES["fileupload_pict"]["tmp_name"];
    $filepdf = $_FILES["fileupload_pdf"]["tmp_name"];
    $partcode = "";

    if ($part_codenew === $part_codeold) { //still same part code - case 2
        $partcode = $part_codeold;
        $targetFilepdf =  "../pdf/" . $partcode . ".pdf"; //path data lama
        $targetFilepict =  "../pict/" . $partcode . ".png"; //path data lama
        if (!empty($filepict)) { //cek pict 
            if (file_exists($targetFilepict)) { //cek old
                if (unlink($targetFilepict)) { //remove old
                    move_uploaded_file($filepict, $targetFilepict); //add new
                }
            } else {
                move_uploaded_file($filepict, $targetFilepict);
            }
        }
        if (!empty($filepdf)) { //cek pdf 
            if (file_exists($targetFilepdf)) { //cek old
                if (unlink($targetFilepdf)) { //remove old
                    move_uploaded_file($filepdf, $targetFilepdf); //add new
                }
            } else {
                move_uploaded_file($filepdf, $targetFilepdf);
            }
        }
    } else { // not same partcode - case1
        $partcode = $part_codenew;
        $targetFilepictnew =  "../pict/" . $partcode . ".png"; //path data baru
        $targetFilepictold =  "../pict/" . $part_codeold . ".png"; //path data lama
        $targetFilepdfnew =  "../pdf/" . $partcode . ".pdf"; //path data baru
        $targetFilepdfold =  "../pdf/" . $part_codeold . ".pdf"; //path data lama
        if (!empty($filepict)) { //cek pict 
            if (file_exists($targetFilepictold)) { //cek old
                if (unlink($targetFilepictold)) { //remove old
                    move_uploaded_file($filepict, $targetFilepictnew); //add new
                }
            } else {
                move_uploaded_file($filepict, $targetFilepictnew); // up now if no exists
            }
        }

        if (!empty($filepdf)) { //cek pdf 
            if (file_exists($targetFilepdfold)) { //cek old
                if (unlink($targetFilepdfold)) { //remove old
                    move_uploaded_file($filepdf, $targetFilepdfnew); //add new
                }
            } else {
                move_uploaded_file($filepdf, $targetFilepdfnew); // up now if no exists
            }
        }
    }

    include "db.php";

    $query = "UPDATE parts SET 
    parts_code= '$partcode',
    part_name= '$partname',
    part_spec= '$spec',
    part_unit= '$unit',
    part_sts= '$part_sts' WHERE (parts_code = '$part_codeold')";
    $result = mysqli_query($con, $query);
    if (!$result) {
        $msg = "Item Code Tidak Bisa Sama";
    } else {
        $status = true;
        $msg = "Success Updated ";
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
