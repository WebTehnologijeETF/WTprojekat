function promijeniBoju(a) {
    a.style.backgroundColor = "#f57d24";
}
function vratiBoju(a) {
    a.style.backgroundColor = "red";
}

function prikaziMeni() {
    var meni = document.getElementById("padajuciMeni");
    var lam = document.getElementById("tipka");
    var strelica = document.getElementById("strelica");
    if (meni.innerHTML == "") {
        meni.innerHTML = '<ul id="padajuci"><li class="stavke" onmouseout="vratiBoju(this)" onmouseover = "promijeniBoju(this)"><a href="Laminat.html"> Super ponuda </a> </li> <li class="stavke" onmouseout="vratiBoju(this)" onmouseover = "promijeniBoju(this)"><a href="http://www.tarkett.com/">Tarkett</a></li><li class="stavke" onmouseout="vratiBoju(this)" onmouseover = "promijeniBoju(this)"><a href = "https://www.kaindl.com/en/"> Kaindl</a></li></ul>'
        var i;
        strelica.src = "strelica2.jpg";
        for (i = 0; i < 3; i++) {
            document.getElementsByClassName("stavke")[i].style.backgroundColor = "red";
            document.getElementsByClassName("stavke")[i].style.display = "inherit";
            document.getElementsByClassName("stavke")[i].style.width = "60px";
            document.getElementsByClassName("stavke")[i].style.marginLeft = "309px";
        }
        lam.style.backgroundColor = "red";
        meni.style.width = "50px";
    }
    else {
         meni.innerHTML = "";
         lam = document.getElementById("tipka").style.backgroundColor = "#f57d24";
         strelica.src = "strelica.jpg";
    }
}

