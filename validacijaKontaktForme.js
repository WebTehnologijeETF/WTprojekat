function validForme() {
    var textboxIme = document.getElementById("ime");
    var slikaGreska = document.getElementById("greska");
    var porukaGreska = document.getElementById("greskaImena");
    var textBoxMail = document.getElementById("email");
    var slikaGreska2 = document.getElementById("grMail");
    var porukaGreska2 = document.getElementById("greskaMaila");
    var mail = document.getElementById("email").value;
    var maticni = document.getElementById("maticni");
    var slikaGreska3 = document.getElementById("grMaticni");
    var porukaGreska3 = document.getElementById("greskaJMBG");
    var r = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var q = /^(0[1-9]|[12][0-9]|3[01])(0[1-9]|1[012])[0-9]{9}$/;

    if (textboxIme.value.length == 0) {
        slikaGreska.style.visibility = "visible";
        porukaGreska.style.visibility = "visible";
    }
    else {
        slikaGreska.style.visibility = "hidden";
        porukaGreska.style.visibility = "hidden";
    }

    if (!r.test(textBoxMail.value)) {
        slikaGreska2.style.visibility = "visible";
        porukaGreska2.style.visibility = "visible";
    }
    else {
        slikaGreska2.style.visibility = "hidden";
        porukaGreska2.style.visibility = "hidden";
    }

     if (!q.test(maticni.value)) {
        slikaGreska3.style.visibility = "visible";
        porukaGreska3.style.visibility = "visible";
    }
    else {
        slikaGreska3.style.visibility = "hidden";
        porukaGreska3.style.visibility = "hidden";
    }
    var res = mail.match(textboxIme.value);
    if (res == null)
        window.alert("ime mora biti sadrzano u e-mailu");

    provjeraMjestaIOpcine();
}

function provjeraMjestaIOpcine() {
    var mjesto = document.getElementById('mjesto').value;
    var opcina = document.getElementById('opcina').value;
    var servis = "http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=" + opcina + "&mjesto=" + mjesto;
    if (mjesto.length === 0) {
        alert("Niste unijeli mjesto!");
        return false;
    }
    if (opcina.length === 0) {
        alert("Niste unijeli opcinu!");   
        return false;
    }    
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var odgovor = JSON.parse(ajax.responseText);
            if (odgovor.hasOwnProperty('greska')) {                
                alert(odgovor.greska);
            }
        }
        if (ajax.readyState == 4 && ajax.status == 404)
            document.innerHTML = stranica.toString();
    }
    ajax.open("GET", servis, true);
    ajax.send();    
}
