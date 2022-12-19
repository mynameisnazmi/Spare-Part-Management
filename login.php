<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argha - Spare Parts Management</title>
    <link rel="shortcut icon" href="./pict/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./css/navbar.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">

</head>

<body>
    <div id="wrapper">
        <div id="topr">
        </div>
        <!-- bagian navbar  -->
        <div id="top">
            <div id="navbar_kiri">
                <a href="">Spare Part Management</a>
            </div>
        </div>
        <!-- bagian isi  -->
        <div id="body">
            <div id="bodyartikel">
                <div id="title"> Sign-in </div>

                <div id="register">
                    <div id="row">
                        <input type="number" id="nik" name="nik" placeholder="NIK" required>
                    </div>

                    <div id="space"></div>

                    <div id="row">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div id="loginsubmit">
                        <div id="left">
                            <input type="button" id="login" onclick="login()" name="submit" value="Sign In">
                        </div>
                        <div id="col-75">
                            <p> Belum punya akun? <a href="./register.php"> Click&nbsp;Here </a>
                        </div>
                    </div>
                    <div id="confail">
                        <div id="alerts">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- bagian footer  -->
        <div id="footer">
            <p>Copyright © 2021 </p>
        </div>
    </div>
    <script type="text/javascript" src="./js/global.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
    
</body>

</html>