var autor = null;

function dajSveNovosti(admin) { //dobavljanje svih novosti, atribut admin je samo indikator da li je neko logovan
    autor = admin;
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {

            var novosti = JSON.parse(ajax.responseText);
            prikaziNovosti(novosti, admin);
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }
    }
    ajax.open("GET", 'rest/novost.php?sta=dobaviSve', true);
    ajax.send();
}


function prikaziNovosti(novosti, admin) {    //prikaz svih novosti
    var element = "";    
    if (admin != "") { 
        element += '<div id="objavaNovost">' + document.getElementById("objavaNovost").innerHTML + '</div>';     
    }

    for (i = 0; i < novosti.length; i++) {
        element += '<div class = "novost">' +
        '<img src="' + novosti[i].slika + '" alt="Slika">' +
        '<p>' + novosti[i].vrijeme + '</p>' +
        '<p>' + novosti[i].autor + '</p>' +
        '<h1 id="naslov">' + novosti[i].naslov + '</h1>' +
        '<p id="tekst"> ' + novosti[i].tekst.substr(1,50) + "..." + '  </p>';

        if (admin != null) {
            element += "<a href='#'>Uredi </a>" +
            "<a href='#' onclick='obrisiNovost(" + String(novosti[i].id) + ")'>Obriši </a>";
        }
        element += '<a href="novost.php?novost=' + novosti[i].id + '">Detaljnije</a> </div>';
    }
    document.getElementById("sredina").innerHTML = "";
    document.getElementById("sredina").innerHTML += element;
}


function dajJednuNovost(id, admin) {    
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {

            var novosti = JSON.parse(ajax.responseText);
            prikaziJednuNovost(novosti, admin);
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }
    }
    ajax.open("GET", 'rest/novost.php?sta=dobaviNovost&id=' + id, true);
    ajax.send();
}

function prikaziJednuNovost(novost, admin) {
    var element = "";
    for (var i = 0; i < novost.length; i++) {
        element += '<div class="novost">';
        element += '<img src="' + novost[i].slika + '" alt="Slika">';
        element += '<p>' + novost[i].vrijeme + '</p>';
        element += '<p>' + novost[i].autor + '</p>';
        element += '<h1 id="naslov">' + novost[i].naslov + '</h1>';
        element += '<p id="tekst"> ' + novost[i].tekst + '</p>';
        element += '</div>';
    }
    document.getElementById("sredina").innerHTML = element;
    var komentar = "";
    komentar += '<div id="komentarPost">';
    komentar += '<h3>Ostavi komentar</h3>';
    komentar += '<table>';
    komentar += '<tr><td>Autor:</td><td><input name="komentarAutor"></td> </tr>';
    komentar += '<tr><td>Mail:</td><td><input name="komentarMail"></td></tr>';
    komentar += '<tr><td>Komentar:</td></tr></table>';
    komentar += '<textarea name="komentarTekst"></textarea><br>';
    komentar += '<input type="button" onclick="posaljiKomentar(' + novost[0].id + ')" value="Ostavi komentar"> </div>';
    document.getElementById("sredina").innerHTML += komentar;
    prikaziBrojKomentara(novost[0].id, admin);
}

function prikaziBrojKomentara(novostid, admin) {
    var sredina = document.getElementById("sredina");
    autor = admin;
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var komentar = JSON.parse(ajax.responseText);   
            if (komentar.broj == 0) 
                sredina.innerHTML += "<small>Nema komentara</small>";
            else {
                if (komentar.broj == 1)
                    sredina.innerHTML += '<input type="button" onclick="dobaviSveKomentare('+String(novostid)+', null)" value="1 komentar">';
                 else
                    sredina.innerHTML += '<input type="button" onclick="dobaviSveKomentare('+String(novostid)+', null)" value="' + komentar.broj + ' komentara">';
                    
            }
                             
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }
    }
    ajax.open("GET", 'rest/komentar.php?sta=brojKomentara&novostid=' + novostid, true);
    ajax.send();
}

function dodajNovost(user) {  //user je administrator koji je logovan    
    var novost = {
        naslov: document.getElementsByName("naslov")[1].value,
        tekst: document.getElementsByName("tekst")[1].value,
        slika: document.getElementsByName("slika")[1].value,
        autor: user
    }
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var rez = JSON.parse(ajax.responseText);
            if (rez.OK == "OK") { alert("Novost je dodana"); dajSveNovosti(novost.user); }
            else alert("Problem kod unosa, problem sa servisom!");
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('objavaNovost').innerHTML = '<p> Desio se problem </p>';
        }

    }
    ajax.open("POST", "rest/novost.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("naslov=" + novost.naslov + "&tekst=" + novost.tekst + "&slika=" + novost.slika + "&autor=" + novost.autor);
}


function obrisiNovost(id) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var rez = JSON.parse(ajax.responseText);
            if (rez.OK == "OK") { alert("Novost je obrisana"); dajSveNovosti(autor); }
            else alert("Problem kod brisanja");
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }

    }
    ajax.open("DELETE", "rest/novost.php?id=" + id, true);
    ajax.send();
}