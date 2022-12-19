//login
function login() {
    let nik = document.getElementById("nik").value;
    let password = document.getElementById("password").value;
    let submit = document.getElementById("login").value;
    let cek = false;
    //console.log(nik);
    if (nik.length >= 5) {
        if (password.length > 0) {
            cek = true;
        } else {
            alert("Password Kosong");
        }
    } else {
        alert("Masukan NIK dengan benar");
    }
    if (cek) {
        let dataString = 'nik=' + nik + '&password=' + password + '&submit=' + submit;

        let xhr = new XMLHttpRequest();

        let url = "./process/login.php";

        xhr.onloadstart = function() {
            // alert("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);

            if (responParse.status) {
                //alert(responParse.msg);
                setCookie("name", responParse.cname, 1);
                setCookie("department", responParse.cdepartment, 1);
                setCookie("page", "pm_view", 1);
                setCookie("paging_number", 1, 1);
                //console.log(getCookie("name"));
                window.location.replace("./index.php");
            } else {
                alert("Masukan Password dengan benar");
            }
        }

        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);



    }
    return false;
}

// Get the input field
let input = document.getElementById("password");

// Execute a function when the user releases a key on the keyboard
input.addEventListener('keyup', (event) => {
    const keyName = event.key;
    if (keyName === 'Enter') {
        login();
    }
}, false);