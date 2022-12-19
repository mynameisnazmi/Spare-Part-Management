<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/navbar.css">
        <link rel="stylesheet" type="text/css" href="./css/footer.css">
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/register.css">
      
     
        
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
        <div id="navbar_kanan">
            <a href="./login.php">Sign-in</a>
        </div>
    </div>

    <!-- bagian isi  -->
    <div id="body">
        <div id="bodyartikel">
            <div id="title"> Create your account </div>

            <div id="register">
                <div id="row">
                    <div id="col-25">
                        <label for="nik"> NIK </label>
                    </div>
                    <div id="col-75">
                        <input type="number" id="nik" name="nik" placeholder="14256" >
                    </div>
                </div>

                <div id="row">
                    <div id="col-25">
                        <label for="name"> Name </label>
                    </div>
                    <div id="col-75">
                        <input type="text" id="name" name="name" placeholder="Thomas Cruise " >
                    </div>
                </div>
                
                <div id="row">
                    <div id="col-25">
                        <label for="department"> Department </label>
                    </div>
                    <div id="col-75">
                        <select name="department">
                            <option value="Electrical Big Slitter">Electrical Big Slitter</option>
                            <option value="Electrical Small Slitter">Electrical Small Slitter</option>
                        </select>
                    </div>
                </div>
                
                <div id="row">
                    <div id="col-25">
                        <label for="password"> Password </label>
                    </div>
                    <div id="col-75">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                
                <div id="row">
                    <div id="col-25r">
                        <input type="button" id="Register" onClick="register()" name="submit" value="Register">
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- bagian footer  -->

    <div id="infofooter600">
    </div>
    <div id="footer">
        <p>Copyright © 2021 </p>
    </div>
    </div>

    <script type="text/javascript" src="./js/register.js"></script>
    
</body>
</html>
