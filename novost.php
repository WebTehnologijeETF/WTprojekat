<?php
    session_start();
    $veza = new PDO("mysql:dbname=dekordb;host=127.6.44.2;charset=utf8", "adminiXNWnnq", "t5Izi-S7gLII");
    $veza->exec("set names utf8");    
?>

<?php
    
    if(isset($_POST["btnSubmitKomentar"])) { //ako je kliknuto na dodavanje komentara                                                   
        $rezultat = $veza->prepare("insert into komentar(novostid, autor, mail, tekst) values(?,?,?,?)");
        $rezultat->execute(array($_REQUEST["novost"],$_POST["komentarAutor"], $_POST["komentarMail"], $_POST["komentarTekst"]));               
       if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška: " . $greska[2];
            exit();
        }
    }  
        
     //brisanje komentara    
     if(isset($_REQUEST['sta']) && $_REQUEST['sta'] == 'obrisi' && isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {                                                    
        $rezultat = $veza->prepare("delete from komentar where id = ?");
        $rezultat->execute(array($_REQUEST["komentar"]));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška kod brisanja komentara: " . $greska[2];
            exit();
        } 
    }      

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> D.o.o. "Dekoram" </title>
        <link rel="stylesheet" type="text/css" href="stilindex.css">
        <script src="padajuciMeni.js"></script>
        <script src="singlePage.js"></script>
    </head>

    <body>
        <?php
                
                if(isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {
                print "<a href='adminpanel.php'>Admin panel</a>";
                }
            ?>
        <div id="stranica">
            <div id="zaglavlje">
                <a href="#" onclick="return Otvori('Pocetna.php')"><img src="logo2.jpg" alt="logo"></a>
                <h1>d.o.o. "Dekoram"</h1>
                <p>-Prodaja i ugradnja laminata i parketa-</p>
            </div>
            <div id="meni">
                <ul>
                    <li> <a href="#" onclick="return Otvori('Pocetna.php')"> Pocetna </a> </li>
                    <li onclick="prikaziMeni()" id="tipka"> Laminati <img id="strelica" src="strelica.jpg" alt="strelica"> <div id="padajuciMeni">
                        </div> </li>
                    <li> <a href="#" onclick="return Otvori('Parket.html')"> Parketi </a> </li>
                    <li> <a href="#" onclick="return Otvori('Cjenovnik.html')"> Cjenovnik </a> </li>
                    <li> <a href="#" onclick="return Otvori('Fotogalerija.html')"> Fotogalerija </a> </li>
                    <li> <a href="Kontakt.php"> Kontakt </a> </li>
                     <?php
                        
                          if(isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {
                          print "<li> <a href='index.php?sta=odjava'>Odjava</a> </li>";
                          print "<li> <a href='adminpanel.php'>Admin Panel</a>";
                          }
                        else { print "<li> <a href='login.php'>Prijava</a> </li>"; }
                    ?>
                </ul>
            </div>
            <div id="sadrzaj">
                <div id="lijevo">
                    <h3>Partneri:</h3>
                    <a href="http://www.promo.ba/"> <img src="slika3.jpg" alt="promo"> </a>
                    <a href="http://www.egger.com/OEU_en/index.htm"> <img src="egger.jpg" alt="egger"> </a>
                    <a href="http://www.admonter.eu/"> <img src="admonter.jpg" alt="admonter"> </a>
                    <a href="http://www.kaindl.com/en/"> <img src="kaindl.jpg" alt="kaindl"> </a>
                    <a href="http://www.bug.ba/"> <img src="bug.jpg" alt="bug"> </a>
                    <a href="http://www.klix.ba/"> <img src="klix.jpg" alt="klix"> </a>
                </div>
                <div id="sredina">

                    <?php

$rezultat = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme, autor, slika from novost where id=". $_REQUEST["novost"]." order by vrijeme desc");

if (!$rezultat) {
    $greska = $veza->errorInfo();
    print "SQL greška kod dobavljanja novosti: " . $greska[2];
    exit();
}
foreach ($rezultat as $vijest) { //prikaz vijesti
    
    print '<div class="novost">';
    print '<img src="' . $vijest['slika'] . '" alt="Slika">';
    print '<p>' . date("d.m.Y. (h:i)", $vijest['vrijeme']) . '</p>';
    print '<p>' . $vijest['autor'] . '</p>';
    print '<h1 id="naslov">' . $vijest['naslov'] . '</h1>';
    print '<p id="tekst"> ' . $vijest['tekst'] . '  </p>';
    print '</div>';
?>
                    <div id="komentarPost">
                        <h3>Ostavi komentar</h3>                        
                        <form action="novost.php?novost=<?php print $_REQUEST["novost"]; ?>" method="post">
                            <table>
                                <tr>
                                    <td>Autor:</td>
                                    <td><input name="komentarAutor"></td>
                                </tr>
                                <tr>
                                    <td>Mail:</td>
                                    <td><input name="komentarMail"></td>
                                </tr>
                                <tr>
                                    <td>Komentar:</td>
                                </tr>
                            </table>
                            <textarea name="komentarTekst"></textarea><br>                            
                            <input type="submit" name="btnSubmitKomentar" value="Ostavi komentar">
                        </form>
                    </div>
                    <?php
    if (isset($_REQUEST["sta"]) && $_REQUEST["sta"] = 'komentari') { //ako je link za priakaz komentara uz vijest                                
        $rezultat = $veza->query("select id, autor, tekst, UNIX_TIMESTAMP(datum) datum, mail, tekst from komentar where novostid = " . $_REQUEST["novost"] . " order by datum desc");
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška kod dobavljanja komentara: " . $greska[2];
            exit();
        }
        print "<h3>Svi komentari</h3>";
        foreach ($rezultat as $komentar) {
            print '<div class="novost">';
            print '<p>' . date("d.m.Y. (h:i)", $komentar['datum']) . '</p>';
            print '<a style="text-align:left;" href="mailto:'.$komentar["mail"].'">'.$komentar['autor']. '</a>';
            print '<p id="tekst"> ' . $komentar['tekst'] . '  </p>';
            if(isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {
                print '<a href="novost.php?sta=obrisi&komentar='.$komentar["id"].'&novost='.$_REQUEST["novost"].'">Obriši</a>';
            }
            print '</div>';
        }
        
    } else {
        $brojKomentara = $veza->query("select count(*) from komentar where novostid=" . $vijest['id'] . ";");
        if (!$brojKomentara) {
            $greska = $veza->errorInfo();
            print "SQL greška: " . $greska[2];
            exit();
        }
        $broj = $brojKomentara->fetchColumn();
        
        if ($broj == 0)
            print "<small>Nema komentara</small>";
        else {
            if ($broj == 1)
                print "<a href=novost.php?sta=komentari&novost=" . $vijest['id'] . ">" . count($brojKomentara) . " komentar </a>";
            else
                print "<a href=novost.php?sta=komentari&novost=" . $vijest['id'] . ">" . $broj . " komentara </a>";
        }
    }
    
}
?>
                </div>
                <div id="desno">
                    <h3>Zanimljivo:</h3>
                    <a href="https://www.youtube.com/watch?v=MvTSfm7HfuI"><p>Kako se proizvodi laminat?</p></a>
                    <a href="http://en.wikipedia.org/wiki/Underlay"><p>Sta je filc podloga?</p></a>
                </div>
            </div>
        </div>
    </body>
</html> 