function posaljiKomentar(novostid) {

    var komentar = {
        novostid: novostid,
        autor: document.getElementsByName("komentarAutor")[0].value,
        mail: document.getElementsByName("komentarMail")[0].value,
        tekst: document.getElementsByName("komentarTekst")[0].value
    }
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var rez = JSON.parse(ajax.responseText);
            if (rez.OK == "OK") { alert("Komentar je dodan"); }
            else alert("Problem kod unosa!");
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }

    }
    ajax.open("POST", "rest/komentar.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("novostid=" + komentar.novostid + "&autor=" + komentar.autor + "&mail=" + komentar.mail + "&tekst=" + komentar.tekst);

}

function dobaviSveKomentare(novostid, admin) {    
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var komentar = JSON.parse(ajax.responseText);
            prikaziSveKomentare(komentar, admin);
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }
    }
    ajax.open("GET", 'rest/komentar.php?sta=dobaviSve&novostid=' + novostid, true);
    ajax.send();
}

function prikaziSveKomentare(komentar, admin) {    
    var element = "";
    for (i = 0; i < komentar.length; i++) {
        
         element += '<div class="novost">';
         element += '<p>' + komentar[i].datum + '</p>';
         element += '<a style="text-align:left;" href="mailto:'+ komentar[i].mail + '">' + komentar[i].autor + '</a>';
         element += '<p id="tekst"> '+ komentar[i].tekst + '</p>';
         if(admin != null) {
         element += '<input type="button" onclick="obrisiKomentar(' + komentar[i].id + ')" value="Obriši">';                      
         }
         element += '</div>';

    }    
    document.getElementById("sredina").innerHTML += element;    
    
}

function obrisiKomentar(id) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var rez = JSON.parse(ajax.responseText);
            if (rez.OK == "OK") { alert("Komentar je obrisan"); }
            else alert("Problem kod brisanja");
        }
        if (ajax.readyState == 4 && ajax.status == 404) {
            document.getElementById('sredina').innerHTML = '<p> Desio se problem </p>';
        }

    }
    ajax.open("DELETE", "rest/komentar.php?id=" + id, true);
    ajax.send();
}