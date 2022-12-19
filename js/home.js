//auto load
window.addEventListener("load", function () {
    //setname
    if (getCookie("name")) {
        document.getElementById("textname").innerHTML = getCookie("name");
        document.getElementById("textdept").innerHTML = getCookie("department");
        navToContent(getCookie("page"));
    } else {
        window.location.replace('login.php');
    }
    //page autorun
    if (getCookie("page")) {

    } else {
        window.location.replace('login.php');
    }
    //load data filter
    get_datafilter();

    if (getCookie("page") === "pm_view") {
        get_pmalldata(1, "", "", ""); //page dynamic
    }

});

function getthevalue(x, deploy, resetel) {
    if (deploy === "mach_id") {
        document.getElementById("area").value = document.getElementById(x).innerHTML;
    }
    document.getElementById(deploy).value = x;
    document.getElementsByClassName(resetel)[0].innerHTML = "";

}

function clearsearch() {
    document.getElementsByName("sparts")[0].value = "";
    document.getElementsByClassName("resultsearch")[0].innerHTML = "";
}

function clearsearch2() {
    document.getElementsByName("sparts2")[0].value = "";
    document.getElementsByClassName("resultsearch_part")[0].innerHTML = "";
}

//page p n
function pprc(num) {
    let max_p = parseInt(getCookie("pagelimit"));
    let nowdata_p = parseInt(getCookie("paging_number")) + num;
    if (nowdata_p < 1) {
        nowdata_p = 1;
    }
    if (nowdata_p > max_p) {
        nowdata_p = max_p;
    }
    //console.log(nowdata_p);
    setCookie("paging_number", nowdata_p, 1);
    filter_query();

}

//note show
function shownote(x) {
    let notecls = document.getElementById("notecls" + x);
    let note = document.getElementById("note" + x);
    let date = document.getElementById("date" + x);

    let editsec = document.getElementById("editsec" + x);
    let inf = document.getElementById("inf" + x);
    let qty = document.getElementById("qty" + x);
    let p = document.getElementById("p" + x);
    let partdesc = document.getElementById("partdesc" + x);
    let partloc = document.getElementById("partloc" + x);

    if (notecls.style.display == "" || notecls.style.display == "none") {
        notecls.style.display = "flex";
        note.style.display = "flex";
        date.style.display = "flex";

        editsec.style.display = "none";
        inf.style.display = "none";
        qty.style.display = "none";
        p.style.display = "none";
        partdesc.style.display = "none";
        partloc.style.display = "none";

    } else {
        notecls.style.display = "none";
        note.style.display = "none";
        date.style.display = "none";


        editsec.style.display = "flex";
        inf.style.display = "flex";
        qty.style.display = "flex";
        p.style.display = "block";
        partdesc.style.display = "flex";
        partloc.style.display = "flex";
    }
}
//matching to selected el
function matchingopt(optob, dataob) {
    for (let j = 0; j < optob.length; j++) {
        if (dataob === optob[j].value) {
            optob[j].selected = 'selected';
            //console.log(j);
        }
    }
}
//logout
function logout() {
    delCookie("name");
    delCookie("department");
    delCookie("page");
    delCookie("paging_number");
    delCookie("pagelimit");
}
//get filter parameter
function filter_query(reset) {

    let machdata = [];
    let locfill = [];
    let catfill = [];

    let mac = document.querySelectorAll('.Machine:checked');
    let loc = document.querySelectorAll('.Location:checked');
    let cat = document.querySelectorAll('.Category:checked');
    for (let i = 0; i < mac.length; i++) {
        machdata.push(mac[i].value);

    }
    for (let i = 0; i < loc.length; i++) {
        locfill.push(loc[i].value);

    }
    for (let i = 0; i < cat.length; i++) {
        catfill.push(cat[i].value);

    }

    if (reset === 1) { setCookie("paging_number", 1, 1); }
    get_pmalldata(getCookie("paging_number"), machdata, locfill, catfill);
}

//navigation
function navToContent(myurl) {
    let baseurl = "http://localhost:8080/spr_mgmt/";
    let mnav = ["pm_view", "search_part", "pm_add", "part_add", "mach_add"];
    for (let i = 0; i < mnav.length; i++) {
        if(myurl === mnav[i]){
            document.getElementById(myurl).style.backgroundColor="#bbe1fa";
            document.getElementById(myurl).style.color="#0f4c75";
        }
        else{
            document.getElementById(mnav[i]).style.backgroundColor="#0f4c75";
            document.getElementById(mnav[i]).style.color="#bbe1fa";
        }
    }
    //setpage status
    setCookie("page", myurl, 1);
    //filter show
    if (getCookie("page") === "pm_view") {
        //open last state
        get_pmalldata(getCookie("paging_number"), "", "", "");

    } else {
        document.getElementById("insearch").style.display = "none";
        document.getElementById("filtersection").style.display = "none";
        clearsearch();
        document.getElementById("pagesection").style.display = "none";
    }
    if (myurl !== "pm_view") {
        //changepage
        document.getElementById("content").innerHTML = "";
        let xhr = new XMLHttpRequest();
        let url = baseurl + "view/" + myurl + ".php";

        xhr.onloadstart = function () {
            document.getElementById("content").innerHTML = "Loading...";
        }

        xhr.onerror = function () {
            alert("Gagal page");
        };

        xhr.onloadend = function () {
            if (this.responseText !== "") {
                document.getElementById('content').innerHTML = this.responseText;
            }
        };

        xhr.open("GET", url, true);
        xhr.send();

    }
}