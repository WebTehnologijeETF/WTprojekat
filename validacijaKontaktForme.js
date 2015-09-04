
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
