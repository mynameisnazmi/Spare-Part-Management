// //render editpm form
function render_editdetail_pm(ob) {
    let baseurl = "http://localhost:8080/spr_mgmt/";
    //changepage
    document.getElementById("content").innerHTML = "";
    let xhr = new XMLHttpRequest();
    let url = baseurl + "view/pm_update.php";

    xhr.onloadstart = function() {
        document.getElementById("content").innerHTML = "Loading...";
    }

    xhr.onerror = function() {
        alert("Gagal page");
    };

    xhr.onloadend = function() {
        if (this.responseText !== "") {
            document.getElementById('content').innerHTML = this.responseText;
        }
        setdatapm(ob);
        document.getElementById("upd_pm").addEventListener('click', function() { update_pm(ob[0]["match_id"]) }); //update btn
        document.getElementById("del_pm").addEventListener('click', function() { del_item(ob[0]["match_id"], "part_match", "match_id") }); // delete btn
    };
    xhr.open("GET", url, true);
    xhr.send();


}
// //render editpart form
function render_editdetail_part(ob) {
    let baseurl = "http://localhost:8080/spr_mgmt/";
    //changepage
    document.getElementById("content").innerHTML = "";
    let xhr = new XMLHttpRequest();
    let url = baseurl + "view/part_update.php";

    xhr.onloadstart = function() {
        document.getElementById("content").innerHTML = "Loading...";
    }

    xhr.onerror = function() {
        alert("Gagal page");
    };

    xhr.onloadend = function() {
        if (this.responseText !== "") {
            document.getElementById('content').innerHTML = this.responseText;
        }
        setdatapart(ob);
        document.getElementById("upd").addEventListener('click', function() { update_part(ob[0]["parts_code"]) });
        document.getElementById("del_part").addEventListener('click', function() { del_item(ob[0]["parts_code"], "parts", "parts_code") }); // delete btn
    };
    xhr.open("GET", url, true);
    xhr.send();


}

//render spc data
function render_ressearchpart(ob) {
    let eltar = document.getElementById("cntsearch_part");

    let elres = document.getElementsByClassName("search_part2")[0]; //check element
    if (elres) {
        elres.remove();
    }

    for (let i = 0; i < ob.length; i++) {
        let elementdiv = document.createElement("DIV"); //main element
        elementdiv.classList.add("search_part2");
        eltar.appendChild(elementdiv);

        let elpdiv1 = document.createElement("DIV"); //sub
        elpdiv1.classList.add("part_desc1");
        elementdiv.appendChild(elpdiv1);

        let eldiv1p1 = document.createElement("p");
        eldiv1p1.innerText = ob[i]["part_name"].replace(/_/g, ' ');
        elpdiv1.appendChild(eldiv1p1);

        let eldiv1p2 = document.createElement("p");
        eldiv1p2.innerHTML = "&nbsp;&#9472;&nbsp;";
        elpdiv1.appendChild(eldiv1p2);

        let eldiv1p3 = document.createElement("p");
        eldiv1p3.innerText = ob[i]["parts_code"];
        elpdiv1.appendChild(eldiv1p3);

        let eldiv1a1 = document.createElement("a");
        eldiv1a1.setAttribute("id", "pdf");
        eldiv1a1.setAttribute("target", "_blank");
        eldiv1a1.href = "./pdf/" + ob[i]["parts_code"] + ".pdf";
        eldiv1a1.innerHTML = "&#128196;";
        elpdiv1.appendChild(eldiv1a1);

        let eldiv1a2 = document.createElement("a");
        eldiv1a2.setAttribute("id", "imageview");
        eldiv1a2.setAttribute("target", "_blank");
        eldiv1a2.href = "./pict/" + ob[i]["parts_code"] + ".png";
        eldiv1a2.innerHTML = "&#128065;";
        elpdiv1.appendChild(eldiv1a2);

        let elpdiv1b1 = document.createElement("button");
        elpdiv1b1.classList.add("editsec");
        elpdiv1b1.setAttribute("type", "button");
        elpdiv1b1.addEventListener('click', function() { get_partdetail(ob[i]["parts_code"]) });
        elpdiv1.appendChild(elpdiv1b1);

        let elpdiv1b1s1 = document.createElement("span");
        elpdiv1b1s1.classList.add("edit-icon");
        elpdiv1b1s1.innerHTML = "&#9998;";
        elpdiv1b1.appendChild(elpdiv1b1s1);

        let elpdiv2 = document.createElement("DIV"); //sub
        elpdiv2.classList.add("part_desc2");
        elementdiv.appendChild(elpdiv2);

        let eldiv2p1 = document.createElement("p");
        eldiv2p1.innerText = ob[i]["part_spec"];
        elpdiv2.appendChild(eldiv2p1);
    }
}

//render data
function renderpm_data(ob) {
    let eltar = document.getElementById("content");
    eltar.innerHTML = "";
    let eltitle = document.createElement("DIV"); //title
    eltitle.setAttribute("id", "title");
    eltitle.innerText = "List of Part on Machine";
    eltar.appendChild(eltitle);

    for (let i = 0; i < ob.length; i++) {
        let spr = "";
        let used = "";
        let predict = "";
        if (ob[i]["predict"] !== null) { //check data
            predict = ob[i]["predict"].slice(0, -1);
        }

        let prestr = "";
        if (ob[i]["part_unit"] === "pcs") {
            used = parseFloat(ob[i]["match_used"]).toFixed(0) + "&nbsp;" + ob[i]["part_unit"];
            spr = parseFloat(ob[i]["match_spare"]).toFixed(0) + "&nbsp;" + ob[i]["part_unit"];
        } else {
            used = ob[i]["match_used"] + "&nbsp;" + ob[i]["part_unit"];
            spr = ob[i]["match_spare"] + "&nbsp;" + ob[i]["part_unit"];
        }
        if (predict === "Yes") {
            prestr = "*Classified for replacement";
        } else {
            prestr = "";
        }
        let elementdiv = document.createElement("DIV"); //main
        elementdiv.classList.add("cnt");
        eltar.appendChild(elementdiv);

        let eldiv1 = document.createElement("DIV");
        eldiv1.classList.add("partloc");
        eldiv1.setAttribute("id", "partloc" + ob[i]["match_id"]);
        elementdiv.appendChild(eldiv1);

        let eldiv1p1 = document.createElement("p");
        eldiv1p1.innerText = ob[i]["mach_name"];
        eldiv1.appendChild(eldiv1p1);

        let eldiv1p2 = document.createElement("p");
        eldiv1p2.innerText = ob[i]["mach_area"].replace(/_/g, ' ');
        eldiv1.appendChild(eldiv1p2);

        let eldiv2 = document.createElement("DIV");
        eldiv2.classList.add("partdesc");
        eldiv2.setAttribute("id", "partdesc" + ob[i]["match_id"]);
        elementdiv.appendChild(eldiv2);

        let eldiv2disc = document.createElement("DIV");
        eldiv2disc.classList.add("partdesc");
        eldiv2disc.setAttribute("id", "disc");
        eldiv2.appendChild(eldiv2disc);

        let eldiv2p1 = document.createElement("p");
        eldiv2p1.innerText = ob[i]["parts_code"];
        eldiv2disc.appendChild(eldiv2p1);

        if (ob[i]["part_sts"] == 1) {
            let eldiv2p2 = document.createElement("p");
            eldiv2p2.setAttribute("id", "obso");
            eldiv2p2.innerText = "OBSOLATE";
            eldiv2disc.appendChild(eldiv2p2);
        }

        let eldiv2p3 = document.createElement("p");
        eldiv2p3.innerText = ob[i]["part_name"].replace(/_/g, ' ');
        eldiv2disc.appendChild(eldiv2p3);

        let eldiv2p4 = document.createElement("p");
        eldiv2p4.setAttribute("id", "p" + ob[i]["match_id"]);
        eldiv2p4.innerText = ob[i]["part_spec"];
        eldiv2.appendChild(eldiv2p4);

        let eldiv3 = document.createElement("DIV");
        eldiv3.classList.add("qty");
        eldiv3.setAttribute("id", "qty" + ob[i]["match_id"]);
        elementdiv.appendChild(eldiv3);

        let eldiv3p1 = document.createElement("p");
        eldiv3p1.innerText = ob[i]["match_priority"];
        eldiv3.appendChild(eldiv3p1);

        let eldiv3p2 = document.createElement("p");
        eldiv3p2.innerHTML = "Used&nbsp;:&nbsp;" + used.toString();
        eldiv3.appendChild(eldiv3p2);

        let eldiv3p3 = document.createElement("p");
        eldiv3p3.innerHTML = "Spare&nbsp;:&nbsp;" + spr.toString();
        eldiv3.appendChild(eldiv3p3);

        let eldiv3p4 = document.createElement("p"); // for predict
        eldiv3p4.innerHTML = prestr;
        eldiv3.appendChild(eldiv3p4);

        let eldiv4 = document.createElement("DIV");
        eldiv4.classList.add("inf");
        eldiv4.setAttribute("id", "inf" + ob[i]["match_id"]);
        elementdiv.appendChild(eldiv4);

        let eldiv4but1 = document.createElement("button");
        eldiv4but1.setAttribute("onClick", "shownote(" + ob[i]["match_id"] + ")");
        eldiv4but1.setAttribute("type", "button");
        eldiv4but1.innerHTML = "&#9432;";
        eldiv4.appendChild(eldiv4but1);

        let eldiv4a1 = document.createElement("a");
        eldiv4a1.setAttribute("id", "imageview");
        eldiv4a1.href = "./pict/" + ob[i]["parts_code"] + ".png";
        eldiv4a1.setAttribute("target", "_blank");
        eldiv4a1.innerHTML = "&#128065;";
        eldiv4.appendChild(eldiv4a1);

        let elbut1 = document.createElement("button");
        elbut1.classList.add("editsec");
        elbut1.setAttribute("type", "button");
        elbut1.setAttribute("id", "editsec" + ob[i]["match_id"]);
        elbut1.setAttribute("onClick", "get_pmdetail(" + ob[i]["match_id"] + ")");
        elementdiv.appendChild(elbut1);

        let elbut1s1 = document.createElement("p");
        elbut1s1.innerHTML = "&#9998;";
        elbut1s1.classList.add("edit-icon");
        elbut1.appendChild(elbut1s1);

        let elp1 = document.createElement("p");
        elp1.classList.add("note");
        elp1.setAttribute("id", "note" + ob[i]["match_id"]);
        elp1.innerHTML = "Note&nbsp;:" + ob[i]["match_note"];
        elementdiv.appendChild(elp1);

        let elp2 = document.createElement("p");
        elp2.classList.add("date");
        elp2.setAttribute("id", "date" + ob[i]["match_id"]);
        elp2.innerHTML = "Latest Update&nbsp;<br>" + ob[i]["match_update"];
        elementdiv.appendChild(elp2);

        let eldiv5 = document.createElement("div");
        eldiv5.classList.add("notecls");
        eldiv5.setAttribute("id", "notecls" + ob[i]["match_id"]);
        elementdiv.appendChild(eldiv5);

        let eldiv5b1 = document.createElement("button");
        eldiv5b1.setAttribute("onClick", "shownote(" + ob[i]["match_id"] + ")");
        eldiv5b1.setAttribute("type", "button");
        eldiv5b1.innerHTML = "&#9432;";
        eldiv5.appendChild(eldiv5b1);
    }
    if (getCookie("page") === "pm_view") {
        document.getElementById("filtersection").style.display = "flex";
        document.getElementById("insearch").style.display = "flex";
        document.getElementById("pagesection").style.display = "flex";
        document.getElementsByClassName("resultsearch")[0].style.display = "flex";
    }
}

//rendersearch data
function renderpm_searchdata(ob) {

    let tarel = document.getElementsByClassName("resultsearch")[0];
    tarel.innerHTML = ""; //result
    for (let i = 0; i < ob.length; i++) {
        let elbutton = document.createElement("button"); //main
        elbutton.classList.add("items");
        elbutton.setAttribute("onClick", `getspcitems(` + ob[i]["match_id"] + `)`);
        tarel.appendChild(elbutton);

        let elp1 = document.createElement("p");
        elp1.setAttribute("id", "spec");
        elp1.innerText = ob[i]["part_spec"];

        let elp2 = document.createElement("p");
        elp2.setAttribute("id", "loc");
        elp2.innerText = ob[i]["mach_area"];

        let elp3 = document.createElement("p");
        elp3.setAttribute("id", "pnc");
        elp3.innerHTML = "&nbsp;&#9472;&nbsp;";

        let elp4 = document.createElement("p");
        elp4.setAttribute("id", "mach");
        elp4.innerText = ob[i]["mach_name"];

        elbutton.appendChild(elp1);
        elbutton.appendChild(elp2);
        elbutton.appendChild(elp3);
        elbutton.appendChild(elp4);
    }
    //console.log(parsedoc);

}


//render result spc items
function render_searchpart(ob) {
    let tarel = document.getElementsByClassName("resultsearch_part")[0];
    tarel.innerHTML = ""; //result
    lengtharr = ob.length;
    for (let i = 0; i < lengtharr; i++) {
        let elbutton = document.createElement("button"); //main
        elbutton.classList.add("items_spc");
        elbutton.setAttribute("type", "button");
        elbutton.setAttribute("onClick", `result_searchpart("` + ob[i]["parts_code"] + `")`);
        tarel.appendChild(elbutton);

        let elp1 = document.createElement("p");
        elp1.setAttribute("id", "spec");
        elp1.innerText = ob[i]["parts_code"];

        let elp2 = document.createElement("p");
        elp2.setAttribute("id", "loc");
        elp2.innerText = ob[i]["part_name"].replace(/_/g, ' ');

        elbutton.appendChild(elp1);
        elbutton.appendChild(elp2);
    }
}

//rendersearch data area
function renderpm_searcharea(ob) {
    let tarel = document.getElementsByClassName("resultsearch_area")[0];
    tarel.innerHTML = ""; //result
    lengtharr = ob.length;
    for (let i = 0; i < lengtharr; i++) {
        let elbutton = document.createElement("button"); //main
        elbutton.classList.add("items_area");
        elbutton.setAttribute("type", "button");
        elbutton.setAttribute("onclick", `getthevalue("` + ob[i]["loc_id"] + `","mach_id","resultsearch_area")`);
        tarel.appendChild(elbutton);

        let elp1 = document.createElement("p");
        elp1.setAttribute("id", ob[i]["loc_id"]);
        elp1.innerHTML = ob[i]["mach_name"] + ' &#9472; ' + ob[i]["mach_area"];
        elbutton.appendChild(elp1);
    }
}
//render part category data
function renderpart_cat(ob) {
    let tarel = document.getElementsByClassName("resultsearch_cat")[0];
    tarel.innerHTML = ""; //result
    lengtharr = ob.length;
    for (let i = 0; i < lengtharr; i++) {
        let elbutton = document.createElement("button"); //main
        elbutton.classList.add("items_cat");
        elbutton.setAttribute("type", "button");
        elbutton.setAttribute("onClick", `getthevalue("` + ob[i]["part_name"].replace(/_/g, ' ') + `","partname","resultsearch_cat")`);
        tarel.appendChild(elbutton);

        let elp1 = document.createElement("p");
        elp1.setAttribute("id", ob[i]["part_name"]);
        elp1.innerHTML = ob[i]["part_name"].replace(/_/g, ' ');
        elbutton.appendChild(elp1);
    }
}

//render itemcode data
function renderpm_searchicode(ob) {
    let tarel = document.getElementsByClassName("resultsearch_icode")[0];
    tarel.innerHTML = ""; //result
    lengtharr = ob.length;
    for (let i = 0; i < lengtharr; i++) {
        let elbutton = document.createElement("button"); //main
        elbutton.classList.add("items_icode");
        elbutton.setAttribute("type", "button");
        elbutton.setAttribute("onClick", `getthevalue("` + ob[i]["parts_code"] + `","itemcode","resultsearch_icode")`);
        tarel.appendChild(elbutton);

        let elp1 = document.createElement("p");
        elp1.setAttribute("id", ob[i]["parts_code"]);
        elp1.innerHTML = ob[i]["parts_code"] + ' &#9472; ' + ob[i]["part_name"].replace(/_/g, ' ');
        elbutton.appendChild(elp1);
    }
}

//generete filter data
function gntfilterdata(data, datanum, deploy) {
    let nowdata = "";
    let newob = [];
    //console.log(data);
    for (let i = 0; i < data.length; i++) {
        newob.push(data[i][datanum]);
    }
    newob.sort();
    //console.log(newob);

    for (let i = 0; i < newob.length; i++) {
        if (nowdata !== newob[i]) {
            nowdata = newob[i];
            //console.log(nowdata);
            let fragment = document.createDocumentFragment();

            let elementlabel = document.createElement("LABEL");
            elementlabel.classList.add('container');
            elementlabel.setAttribute("id", deploy + i);
            elementlabel.innerHTML = newob[i].replace(/_/g, ' ');
            document.getElementById(deploy).appendChild(elementlabel);

            let elementinput = document.createElement("INPUT");
            elementinput.setAttribute("type", "checkbox");
            elementinput.setAttribute("value", newob[i]);
            elementinput.classList.add(deploy);
            elementinput.setAttribute("onclick", "filter_query(1)");

            let elementspan = document.createElement("SPAN");
            elementspan.classList.add("checkmark");

            fragment.appendChild(elementinput);
            fragment.appendChild(elementspan);

            document.getElementById(deploy + i).appendChild(fragment);
        }
    }

}