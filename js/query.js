//get filter parameter checklist(reset if == 1)
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

    if ((machdata.length > 0 || locfill.length > 0) && (catfill.length < 1)) {
        get_spcdatafilter(machdata, locfill);
        document.getElementById("Category").innerHTML = "";
    } else if ((machdata.length < 1) && (locfill.length < 1) && (catfill.length < 1)) {
        document.getElementById("Machine").innerHTML = "";
        document.getElementById("Location").innerHTML = "";
        document.getElementById("Category").innerHTML = "";
        get_datafilter();
    }
    if (reset === 1) { setCookie("paging_number", 1, 1); }
    get_pmalldata(getCookie("paging_number"), machdata, locfill, catfill);
}
// delete item (id part, database name, colom )
function del_item(id, db, cl) {
    let c = confirm("Apakah anda yakin ingin menghapusnya ?");
    if (c) {
        if (getCookie("page")) {
            let dataString = "";
            dataString = 'id=' + id +
                '&db=' + db +
                '&cl=' + cl;
            let xhr = new XMLHttpRequest();

            let url = "./process/del_item.php";

            xhr.onloadstart = function() {
                //alert("loading...");
                //console.log("loading...");
            }

            xhr.onerror = function() {
                alert("Gagal");
            };
            xhr.onloadend = function() {
                let responParse = JSON.parse(xhr.responseText);
                if (responParse.status) {
                    //console.log(responParse.msg);
                    //alert("asd");
                    alert(responParse.msg);
                    location.reload();
                } else {
                    alert(responParse.msg);
                }
            }
            xhr.open("POST", url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(dataString);
        }
    }
}


//getalldata on part machine for dashbord (page now, machine flter, location filter, categort filter)
function get_pmalldata(page, mach, loc, cat) {
    if (getCookie("page")) {
        // console.log(mach);
        let dataString = "";
        dataString =
            'paging=' + page +
            '&mach=' + JSON.stringify(mach) + //keeping data as array before send
            '&loc=' + JSON.stringify(loc) +
            '&cat=' + JSON.stringify(cat);
        let xhr = new XMLHttpRequest();

        let url = "./process/load_pmalldata.php";

        xhr.onloadstart = function() {
            document.getElementById("content").innerHTML = "<center><h1>Loading...</h1></center>";
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);

            if (responParse.status) {
                //console.log(responParse.limitpages);
                renderpm_data(responParse.msg);
                setCookie("pagelimit", responParse.limitpages, 1);
            } else {
                alert(responParse.msg);
            }
        }

        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
}

//set data part machine at form update spare part machine pm (array data)
function setdatapm(ob) {
    document.getElementById("area").value = ob[0]["mach_name"] + ' - ' + ob[0]["mach_area"];
    document.getElementsByName("area")[0].value = ob[0]["loc_id"];
    document.getElementsByName("itemcode")[0].value = ob[0]["match_part"];
    document.getElementsByName("partused")[0].value = ob[0]["match_used"];
    document.getElementById("sprpart").value = ob[0]["match_spare"];
    document.getElementsByName("note")[0].innerText = ob[0]["match_note"];
    let opt = document.getElementsByTagName("option");
    matchingopt(opt, ob[0]["match_priority"]);
}
//set data part at form update spare part(array)
function setdatapart(ob) {
    document.getElementsByName("itemcode")[0].value = ob[0]["parts_code"];
    document.getElementsByName("partname")[0].value = ob[0]["part_name"].replace(/_/g, ' ');
    document.getElementsByName("spec")[0].value = ob[0]["part_spec"];
    let opt = document.getElementsByTagName("option");
    matchingopt(opt, ob[0]["part_sts"]);
    matchingopt(opt, ob[0]["part_unit"]);
}
//load data filter specified pm(machine filter, location filter)
function get_spcdatafilter(datamach, dataloc) {
    if (getCookie("page")) {
        dataString =
            'datamach=' + JSON.stringify(datamach) +
            '&dataloc=' + JSON.stringify(dataloc);
        let xhr = new XMLHttpRequest();

        let url = "./process/loadspcfildata.php";

        xhr.onloadstart = function() {
            //alert("loading...");
            //console.log("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                gntfilterdata(responParse.msg, 0, "Category");
                //alert(responParse.msgcat[0]);
                //console.log(responParse.msg[1][0]);
            } else {
                alert(responParse.msg);
                location.reload();
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
}
//load data without filter data pm
function get_datafilter() {
    let xhr = new XMLHttpRequest();
    let url = "./process/loadfildata.php";

    xhr.onloadstart = function() {
        document.getElementById("content").innerHTML = "Loading...";
    }

    xhr.onerror = function() {
        alert("Gagal page");
    };

    xhr.onloadend = function() {
        let responParse = JSON.parse(xhr.responseText);

        if (responParse.status) {
            gntfilterdata(responParse.msg, 0, "Machine");
            gntfilterdata(responParse.msg, 1, "Location");
            gntfilterdata(responParse.msg, 2, "Category");
            //alert(responParse.msgcat[0]);
            //console.log(responParse.msg.length);
        } else {
            alert(responParse.status); //if no data
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}
//search bar specific spare parts(character)
function search_parts(search) {
    if (search.length <= 0) {
        document.getElementsByClassName("resultsearch_part")[0].innerHTML = "";
    } else {
        let dataString = 'data=' + search;

        let xhr = new XMLHttpRequest();

        let url = "./process/loadspcpart.php";

        xhr.onloadstart = function() {
            //alert("loading...");
        }
        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                render_searchpart(responParse.msg);
            } else {
                let nodata = [{ 'parts_code': "Data Not Found", 'part_name': "404" }];
                render_searchpart(nodata);
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);

    }
}
//search bar category for form register part (character)
function part_searchcat(search) {
    // console.log(search);
    if (search.length <= 0) {
        document.getElementsByClassName("resultsearch_cat")[0].innerHTML = "";
    } else {
        let dataString = 'data=' + search;

        let xhr = new XMLHttpRequest();

        let url = "./process/load_searchcat.php";

        xhr.onloadstart = function() {
            //alert("loading...");
        }
        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                renderpart_cat(responParse.msg);
            } else {
                document.getElementsByClassName("resultsearch_cat")[0].innerHTML = "";
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);

    }
}

//search bar itemcode register part machine for form(character)
function pm_searchicode(search) {
    // console.log(search);
    if (search.length <= 0) {
        document.getElementsByClassName("resultsearch_icode")[0].innerHTML = "";
    } else {
        let dataString = 'data=' + search;

        let xhr = new XMLHttpRequest();

        let url = "./process/loadspcpart.php";

        xhr.onloadstart = function() {
            //alert("loading...");
        }
        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                renderpm_searchicode(responParse.msg);
            } else {
                let nodata = [{ 'parts_code': "Data Not Found", 'part_name': "404" }];
                renderpm_searchicode(nodata);
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);

    }
}
//search bar area machine for register part machine (character)
function pm_searcharea(search) {
    // console.log(search);
    if (search.length <= 0) {
        document.getElementsByClassName("resultsearch_area")[0].innerHTML = "";
    } else {
        let dataString = 'data=' + search;

        let xhr = new XMLHttpRequest();

        let url = "./process/loadmach.php";

        xhr.onloadstart = function() {
            //alert("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);

            if (responParse.status) {
                //console.log(responParse.msg[0]["part_of"]);
                renderpm_searcharea(responParse.msg);
            } else {
                let nodata = [{ 'loc_id': "#", 'mach_name': "Data Not Found", 'mach_area': "404" }];
                renderpm_searcharea(nodata);
            }
        }

        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);

    }
}
//search bar partmachine (character)
function pm_search(search) {
    // console.log(search);
    if (search.length <= 0) {
        document.getElementsByClassName("resultsearch")[0].innerHTML = "";
    } else {
        let dataString = 'data=' + search;

        let xhr = new XMLHttpRequest();

        let url = "./process/pm_search.php";

        xhr.onloadstart = function() {
            //alert("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            //console.log(this.responseText);
            let responParse = JSON.parse(xhr.responseText);

            if (responParse.status) {
                //console.log(responParse.msg[0]["part_of"]);
                renderpm_searchdata(responParse.msg, 0);
            } else {
                let nodata = [{ 'match_id': "#", 'mach_name': "404", 'mach_area': "Eror", 'part_spec': "Data Not Found !" }];
                renderpm_searchdata(nodata, 0);
            }
        }

        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);

    }
}

//button result from pm_search to render data(id part)
function result_searchpart(id) {
    if (getCookie("page")) {
        let dataString = "";
        dataString = 'id=' + id;
        let xhr = new XMLHttpRequest();
        let url = "./process/load_searchpart.php";

        xhr.onloadstart = function() {
            //alert("loading...");
            //console.log("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                //console.log(responParse.msg);
                //alert("asd");
                render_ressearchpart(responParse.msg);
                document.getElementsByClassName("resultsearch_part")[0].innerHTML = ""; //clean
                document.getElementsByName("sparts2")[0].value = ""; //clean
            } else {
                alert(responParse.msg);
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
}

//button result from search_parts to render data(id part)
function getspcitems(id) {
    //let pat = document.getElementsByName("sparts")[0].value;
    if (getCookie("page")) {
        let dataString = "";
        dataString = 'id=' + id;
        //+ '&pattern=' + pat ; //tambah data untuk dikirim yaitu kolom pencarrian 
        let xhr = new XMLHttpRequest();

        let url = "./process/load_pmitems.php";

        xhr.onloadstart = function() {
            //alert("loading...");
            //console.log("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                //console.log(responParse.msg);
                renderpm_data(responParse.msg);
                document.getElementsByClassName("resultsearch")[0].innerHTML = ""; //clean
                document.getElementsByName("sparts")[0].value = ""; //clean
            } else {
                alert(responParse.msg);
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
}
//edit button act for form update part machine (id match)
function get_pmdetail(id) {
    if (getCookie("page")) {
        let dataString = "";
        dataString = 'id=' + id;
        let xhr = new XMLHttpRequest();

        let url = "./process/load_pmupdate.php";

        xhr.onloadstart = function() {}

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                render_editdetail_pm(responParse.msg);
                document.getElementById("filtersection").style.display = "none";
                document.getElementById("pagesection").style.display = "none";
            } else {
                alert(responParse.msg);
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
}
//edit button act for form update part (id part)
function get_partdetail(id) {
    if (getCookie("page")) {
        let dataString = "";
        dataString = 'id=' + id;
        let xhr = new XMLHttpRequest();

        let url = "./process/load_partupdate.php";

        xhr.onloadstart = function() {
            //alert("loading...");
            //console.log("loading...");
        }

        xhr.onerror = function() {
            alert("Gagal");
        };
        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                //console.log(responParse.msg);
                //alert("asd");
                render_editdetail_part(responParse.msg);
                //setdatapart(responParse.msg);
            } else {
                alert(responParse.msg);
            }
        }
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(dataString);
    }
}
//register machine
function register_mach() {
    let area = document.getElementById("partof").value.trim();
    let loc = document.getElementById("partloc").value.trim();
    if (area.length !== 0 && loc.length !== 0) {
        //let myform = document.getElementsByTagName("form")[0];
        let fd = new FormData();
        fd.append("partof", area);
        fd.append("partloc", loc);
        fd.append("button", this.value);

        let xhr = new XMLHttpRequest();
        let url = "./process/mach_add.php";

        xhr.onloadstart = function() {
            document.getElementById("content").innerHTML = "Loading...";
        }

        xhr.onerror = function() {
            alert("Gagal page");
        };

        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                alert(responParse.msg);
                location.reload();
            } else {
                alert(responParse.msg);
                location.reload();
            }
        };

        xhr.open("POST", url, true);
        xhr.send(fd);
    } else {
        alert("Fill Area and Location Correctly !")
    }
}
//register part to machine
function register_pm() {
    if (document.getElementById("area").value.length !== 0 && document.getElementById("itemcode").value.length !== 0) {
        let myform = document.getElementsByTagName("form")[0];
        let fd = new FormData(myform);
        fd.append("button", this.value);

        let xhr = new XMLHttpRequest();
        let url = "./process/pm_add.php";

        xhr.onloadstart = function() {
            document.getElementById("content").innerHTML = "Loading...";
        }

        xhr.onerror = function() {
            alert("Gagal page");
        };

        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                alert(responParse.msg);
                location.reload();
            } else {
                alert(responParse.msg);
                location.reload();
            }
        };

        xhr.open("POST", url, true);
        xhr.send(fd);
    } else {
        alert("Fill Area, Location, and Item Code Correctly !")
    }
}
//register spare  part
function register_part() {
    let itemcode = document.getElementById("itemcode").value.trim();
    let cat = document.getElementById("partname").value.trim();
    let spec = document.getElementById("spec").value.trim();
    if (cat.length !== 0 || spec.length !== 0) {
        let myform = document.getElementsByTagName("form")[0];
        let fd = new FormData(myform);
        fd.set("itemcode", itemcode);
        fd.set("partname", cat);
        fd.set("spec", spec);
        fd.append("button", this.value);

        let xhr = new XMLHttpRequest();
        let url = "./process/part_add.php";

        xhr.onloadstart = function() {
            document.getElementById("content").innerHTML = "Loading...";
        }

        xhr.onerror = function() {
            alert("Gagal page");
        };

        xhr.onloadend = function() {
            let responParse = JSON.parse(xhr.responseText);
            if (responParse.status) {
                alert(responParse.msg);
                location.reload();
            } else {
                alert(responParse.msg);
                location.reload();
            }
        };

        xhr.open("POST", url, true);
        xhr.send(fd);
    } else {
        alert("Isi Kategori dan Spesifikasi dengan benar !")
    }
}


//button update data part machine(id part)
function update_pm(id) {
    let myform = document.getElementsByTagName("form")[0];
    let fd = new FormData(myform);
    fd.append("button", this.value);
    fd.append("match_id", id);

    let xhr = new XMLHttpRequest();
    let url = "./process/update_pm.php";

    xhr.onloadstart = function() {
        document.getElementById("content").innerHTML = "Loading...";
    }

    xhr.onerror = function() {
        alert("Gagal page");
    };

    xhr.onloadend = function() {
        let responParse = JSON.parse(xhr.responseText);
        if (responParse.status) {
            // console.log(responParse.msg);
            location.reload();
        } else {
            alert(responParse.msg);
            location.reload();
        }
    };

    xhr.open("POST", url, true);
    xhr.send(fd);

}

//button update data spare part(id part)
function update_part(id) {
    let itemcode = document.getElementById("itemcode").value.trim();
    let cat = document.getElementById("partname").value.trim();
    let spec = document.getElementById("spec").value.trim();
    let myform = document.getElementsByTagName("form")[0];
    let fd = new FormData(myform);
    fd.set("itemcode", itemcode);
    fd.set("partname", cat);
    fd.set("spec", spec);
    fd.append("parts_code", id);
    fd.append("button", this.value);


    let xhr = new XMLHttpRequest();
    let url = "./process/update_part.php";

    xhr.onloadstart = function() {
        document.getElementById("content").innerHTML = "Loading...";
    }

    xhr.onerror = function() {
        alert("Gagal page");
    };

    xhr.onloadend = function() {
        let responParse = JSON.parse(xhr.responseText);
        if (responParse.status) {
            alert(responParse.msg);
            location.reload();
        } else {
            alert(responParse.msg);
            location.reload();
        }
    };

    xhr.open("POST", url, true);
    xhr.send(fd);

}