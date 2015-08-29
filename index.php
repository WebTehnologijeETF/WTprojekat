<?php
    session_start();
    if(isset($_REQUEST['sta']) && $_REQUEST['sta'] == 'odjava') {
        session_unset();
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> D.o.o. "Dekoram" </title>
        <link rel="stylesheet" type="text/css" href="stilindex.css">
    </head>

    <body>
        <script src="padajuciMeni.js"></script>
        <script src="singlePage.js"></script>
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

                    <?php include 'novosti.php'; ?>
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
