<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Lihat undangan temanmu di sini!</title>	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">	
<link rel="stylesheet" type="text/css" href="include/style.css" />
<script src="../trayekonomis/include/js/jquery.min.js" type="text/javascript"></script>
<script>
var currentLayer = 'page1';
function showLayer(lyr) {
   hideLayer(currentLayer);
   $("#"+lyr).show();
   currentLayer = lyr;
}	
function hideLayer(lyr) {
   $("#"+lyr).hide();
}
</script>
    <style type="text/css">
	a.back {
		display: block; width: 67px; height: 32px;
		background: url(../trayekonomis/images/all_icon.png) -744px -10px no-repeat;
		text-decoration:none; text-align:center;
		FONT-FAMILY: Arial Black, Gadget, sans-serif; FONT-SIZE: 14px; COLOR: white;
	}
	a.back:hover { background-position: -744px -42px;}
     </style>
<body style="">
	<div style="WIDTH: 585px; background: url('background/star.jpg') repeat;">
		<div id="page1" style="WIDTH: 565px; MARGIN: 10px auto;">
			<img src="theme/online_invitation.png" />
			<div style="Z-INDEX: 9999; POSITION: absolute; LEFT: 300px; TOP: 575px; FONT-SIZE: 12px; FONT-FAMILY: Arial Black, Gadget, sans-serif;">
				Lihat <a href="javascript:void(0);" onClick="showLayer('page3')">angkot</a> atau <a href="javascript:void(0);" onClick="showLayer('page2')">rute kendaraan pribadi</a>
			</div>
		</div>
		<div id="page2" style="WIDTH: 565px; MARGIN: 0 auto; DISPLAY: none; BACKGROUND-COLOR: #1CB34B; PADDING: 15px;">
			<p>
				<b>Pencarian rute untuk kendaraan pribadi</b><br><br>
				1. Pilih jenis kendaraan<br>
				2. Scroll mouse untuk zoom in atau zoom out<br>
				3. Double click untuk menetapkan daerah asal Anda<br><br>
				Secara otomatis sistem akan membuatkan jalur terdekat ke tempat tujuan.<br>
				Icon A adalah asal dan icon T adalah tujuan.
			</p>
			<label for="kendaraan" style="COLOR: #FFFFFF;">Jenis kendaraan:</label> 
			<select name="kendaraan" id="kendaraan">
				<option value="motor" selected="selected">Non Tol / Motor</option>
				<option value="mobil">Lewat Tol / Mobil</option>
			</select><br>			
			<iframe src="../trayekonomis/viewmap.php?lat=-6.233139&lon=107.032469&type=C" width="550px" height="405px" scrolling="no"></iframe>
			<div style="Z-INDEX: 9999; POSITION: absolute; LEFT: 500px; TOP: 15px; FONT-SIZE: 12px; FONT-FAMILY: Arial Black, Gadget, sans-serif;">
				<a class="back" href="javascript:void(0);" onClick="showLayer('page1');">BACK</a>
			</div>
		</div>
		<div id="page3" style="WIDTH: 565px; HEIGHT: 600px; MARGIN: 0 auto; DISPLAY: none; BACKGROUND-COLOR: #1CB34B; PADDING: 15px;">
			<div id="angkot">
				<p>
					<b>Daftar Angkutan Umum Menuju Lokasi</b><br><br>
					1. Naik ojek dari Bulak Kapal.<br>
					<a href="javascript:void(0);" onClick="window.parent.cariAngkot('Bulak Kapal - ');window.parent.myLytebox.end();">Lihat angkutan umum ke bulak kapal.</a><br>
					<br>
					2. Naik angkot K12A dari Terminal Bekasi.<br>
					<a href="javascript:void(0);" onClick="window.parent.cariAngkot('Term. Bekasi - ');window.parent.myLytebox.end();">Lihat angkutan umum ke Terminal Bekasi.</a>
				</p>
			</div>
			<div style="Z-INDEX: 9999; POSITION: absolute; LEFT: 500px; TOP: 15px; FONT-SIZE: 12px; FONT-FAMILY: Arial Black, Gadget, sans-serif;">
				<a class="back" href="javascript:void(0);" onClick="showLayer('page1');">BACK</a>
			</div>
		</div>
	</div>
</body>
</html>