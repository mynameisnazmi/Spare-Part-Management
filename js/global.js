function setCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else {
        var expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie); //decode symmbol $ etc
    let ca = decodedCookie.split(';'); // splitt into array
    for (let i = 0; i < ca.length; i++) { //check each index of string
        let c = ca[i]; //assign each index
        while (c.charAt(0) == ' ') {
            c = c.substring(1); //remove white space
        }
        if (c.indexOf(name) == 0) { //macthing data
            return c.substring(name.length, c.length); //extract data
        }
    }
    return "";
}

function delCookie(cname) {
    document.cookie = cname + "=; path=/";
    return true;
}