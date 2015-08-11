function Otvori(stranica) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById('stranica').innerHTML = ajax.responseText;
        }
        if (ajax.readyState == 4 && ajax.status == 404)
            document.innerHTML = stranica.toString();
    }
    ajax.open("GET", stranica.toString(), true);
    ajax.send();
    return false;
}