<?php 
	include("trayekonomis/mobiledetect.php");
	$mobtype = MobileType();
      	if (IsMobile($mobtype) && empty($_GET['desktop'])) header('Location: http://m.trayekonomis.com/');
      	session_start();
      	$_SESSION['mobtp'] = $mobtype;
      	$_SESSION['sessionidtra'] = session_id();
      	if(!isset($_SESSION['f_name'])) $trayekonomers = "Guest";
      	else $trayekonomers = $_SESSION['f_name'];
      	include_once "trayekonomis/include/db.php";
      	if ($_GET['lan'] == "en") {
      		$_SESSION['lang'] = "en";
      		$result = mysql_query("SELECT ing FROM lang_tr WHERE 1");
      	}
      	else {
      		$_SESSION['lang'] = "id";
      		$result = mysql_query("SELECT ind FROM lang_tr WHERE 1");
      	}
      	$n_lan = 1;
      	while ($rows = mysql_fetch_array($result)) {
      		$lan[$n_lan] = $rows[0];
		$n_lan++;
	}
	$evshlink = "";
	//if (!(empty($_GET['evid']))) $evshlink = "/design/showevsh.php?desktop=true&evid=".$_GET['evid'];
	if ($_GET['evid']=='A2') $evshlink = "/design/showevsh.php";
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<title>Trayekonomis - Kemanapun, BISA!</title>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
<!--CSS-->
<link media=screen href="trayekonomis/css/v3main_page.css" type=text/css rel=stylesheet>
<!--[if lte IE 7]><link href="/stylesheets/ie7_fixes.css" type=text/css rel=stylesheet><![endif]-->
<link rel="stylesheet" type="text/css" href="trayekonomis/include/autocomplete/autocomp.css" />
<link rel="stylesheet" href="trayekonomis/include/lytebox/lytebox.css" type="text/css" media="screen" />

<!--JS-->
<script type="text/javascript" src="trayekonomis/include/js/jquery.min.js"></script>
<script type="text/javascript" src="trayekonomis/include/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="trayekonomis/include/slimscroll/slimScroll.min.js"></script>
<script type="text/javascript" src="trayekonomis/include/autocomplete/autocomp.js"></script>
<script type="text/javascript" src="trayekonomis/include/lytebox/lytebox.js"></script>
<script type="text/javascript" src="allTrayeko.js"></script>
<script type="text/javascript">
</script>
</head>
<body onload="MyOpenLytebox('<?php echo $evshlink; ?>');">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "https://connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div id="outer_container"> <!-- backgound -->
		<div id="inner_container"> <!-- fixed width -->
			<div id="pesan" class="sembunyi"><div id="isiPesan" class="bold"><img src="trayekonomis/images/ajax-loader.gif"><br>'.$lan[8].'</div></div>
			<?php include("inc_header.php");?>
			<?php include("inc_login.php");?>
			<div id="papan_trayek"> <!-- papan trayek -->
				<div id="judul_papan" class="bold"><?php echo $lan[10]; ?></div>
				<?php include("inc_cover.php");?>
				<?php include("inc_search.php");?>
			</div> <!-- #papan_trayek -->
			<?php include("inc_shoutbox.php");?>
		</div> <!-- #inner_container -->
	</div> <!-- #outer_container -->
</body>
</html>