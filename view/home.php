<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="public">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" type="text/css" href="./css/navbar.css"> -->
	<title>Argha - Spare Parts Management</title>
	<link rel="shortcut icon" href="./pict/favicon.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="./css/footer.css">
	<link rel="stylesheet" type="text/css" href="./css/global.css">
	<link rel="stylesheet" type="text/css" href="./css/home.css">
	<link rel="stylesheet" type="text/css" href="./css/spr_form.css">
	<link rel="stylesheet" type="text/css" href="./css/pm_view.css">
	<link rel="stylesheet" type="text/css" href="./css/search_part.css">
</head>

<body>
	<!-- bagian navbar  -->
	<div id="top">

		<a id="appsname" href="javascript:void(0);">Parts&nbsp;Management</a>

		<div id="search">
			<div id="insearch">
				<input type="text" onKeyup="pm_search(this.value)" name="sparts" autocomplete="off" placeholder="Search Part On Machine">
				<button onClick="clearsearch();">&#10005;</button>
			</div>
			<div class="resultsearch">
			</div>
		</div>
		<!-- bagian head  -->
		<div id="headermenu">
			<button class="navbut" id="pm_view" onClick="navToContent('pm_view');" ;>Part<br>Machine</button>
			<button class="navbut" id="search_part" onClick="navToContent('search_part');" ;>Search<br>Part</button>
			<button class="navbut" id="pm_add" onClick="navToContent('pm_add');" ;>Match<br>Part</button>
			<button class="navbut" id="part_add" onClick="navToContent('part_add');" ;>New<br>Part</button>
			<button class="navbut" id="mach_add" onClick="navToContent('mach_add');" ;>New<br>Machine</button>
		</div>
		<div id="identity">
			<div id="textname">Name</div>
			<div id="textdept">Department</div>
		</div>
		<a id="logout" onClick="logout();" href="./logout.php">Logout</a>
	</div>

	<!-- bagian filter  -->
	<div id="filtersection">
		<div id="filtername">
			<div class="filterpart" id="but1">Machine
				<div id="Machine"></div>
			</div>
			<div class="filterpart" id="but2">Location
				<div id="Location"></div>
			</div>
			<div class="filterpart" id="but3">Category
				<div id="Category"></div>
			</div>
		</div>

	</div>

	<!-- bagian body  -->

	<!-- bagian Content  -->
	<div id="bordercontent">
		<!-- bagian paging  -->
		<div id="pagesection">
			<a href="./miner.py" title="Refresh Classification" target="_blank">&#8635; </a>
			<button onClick="pprc(-1);">&laquo; </button>
			<button onClick="pprc(1);"> &raquo;</button>
		</div>
		<div id=content> content</div>
	</div>
	<!-- bagian footer  -->
	<div id="footer">
		<p>Copyright © 2021 </p>
	</div>


	<script type="text/javascript" src="./js/global.js"></script>
	<script type="text/javascript" src="./js/home.js"></script>
	<script type="text/javascript" src="./js/query.js"></script>
	<script type="text/javascript" src="./js/render.js"></script>

</body>

</html>