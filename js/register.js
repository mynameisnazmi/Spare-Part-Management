function register() {
    let nik = document.getElementById("nik").value.trim();
    let password = document.getElementById("password").value;
    let name = document.getElementById("name").value.trim();
    let department = document.getElementsByName("department")[0].options[document.getElementsByName("department")[0].selectedIndex].value;
    let submit = document.getElementById("Register").value;
    let cek = false;
    if (nik.length >= 5) {
        if (name.length > 0) {
            if (department.length > 0) {
                if (password.length > 0) {
                    cek = true;
                } else {
                    alert("Emmm, You dont have password ?");
                }
            } else {
                alert("Please Fill department ");
            }
        } else {
            alert("Please Fill name ?");
        }
    } else {
        alert("Please Fill NIK");
    }
    if (cek) {
        let dataString = 'nik=' + nik + '&password=' + password + '&name=' + name + '&department=' + department + '&submit=' + submit;
        let xhr = new XMLHttpRequest();

        let url = "./process/register.php";



        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);

            if (responParse.status) {
                alert(responParse.msg);
                window.location.replace("./login.php");
            } else {
                alert(responParse.msg);
                window.location.replace("./register.php");
            }
        }

        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
    return false;
}