<?php
    session_start();
    if(!isset($_SESSION['username']) || $_SESSION['tip'] != 'Admin') { //ako nije admin, odmah redirect
    header("Location: index.php"); 
        exit();
    }
?>

<?php
    $veza = new PDO("mysql:dbname=dekordb;host=127.6.44.2;charset=utf8", "adminiXNWnnq", "t5Izi-S7gLII");
    $veza->exec("set names utf8");    
?>

<?php
    if(isset($_REQUEST['sta']) && $_REQUEST['sta'] == 'obrisi') { //brisanje korisnika
        $rezultat = $veza->prepare("delete from korisnik where id = ?");
        $rezultat->execute(array($_REQUEST["korisnik"]));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška kod dobavljanja novosti: " . $greska[2];
            exit();            
        } 
    }
    
    if(isset($_POST['btnDodajKorisnika'])) {  // dodavanje korisnika                       
        $rezultat = $veza->prepare("insert into korisnik(username, password, mail, tip) values(?,?,?, ?)");
        $rezultat->execute(array($_POST["user"],md5($_POST["pass"]),$_POST["mail"], $_POST['tip']));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška kod dobavljanja novosti: " . $greska[2];
            exit();   
        }    
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin panel</title>
        <link rel="stylesheet" type="text/css" href="stilindex.css">
    </head>
    <body>
         <div id="zaglavlje">
                <a href="#" onclick="return Otvori('index.php')"><img src="logo2.jpg" alt="logo"></a>
                <h1>d.o.o. "Dekoram"</h1>
                <p>-Prodaja i ugradnja laminata i parketa-</p>   
            </div>
            <div id="meni">
                <ul>
                    <li> <a href="#" onclick="return Otvori('Pocetna.php')"> Pocetna </a> </li>
                    <li  onclick ="prikaziMeni()" id="tipka"> Laminati <img id="strelica" src="strelica.jpg" alt="strelica"> <div id="padajuciMeni"> </div> </li>
                    <li> <a href="#" onclick="return Otvori('Parket.html')"> Parketi </a> </li>
                    <li> <a href="#" onclick="return Otvori('Cjenovnik.html')"> Cjenovnik </a> </li>
                    <li> <a href="#" onclick="return Otvori('Fotogalerija.html')"> Fotogalerija </a> </li>
                    <li> <a href="Kontakt.php"> Kontakt </a> </li>
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
                    <div id="adminPanel">
             <div id="unosKorisnika">
                 <h3>Unos korisnika</h3>
                <form method="post" action="adminpanel.php">
                    <table>
                        <tr><td colspan="2">Unos korisnika</td></tr>
                        <tr>
                            <td><p>Username</p></td>
                            <td><input name="user"></td>
                        </tr>
                        <tr>
                            <td><p>Password</p></td>
                            <td><input type="password" name="pass"></td>
                        </tr>
                        <tr>
                            <td><p>E-Mail</p></td>
                            <td><input type="email" name="mail"></td>
                        </tr>
                        <tr>
                            <td>Tip korisnika</td>
                            <td>
                                <select name="tip">
                                   <option value="Admin">Admin</option>
                                   <option value="Korisnik">Korisnik</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="btnDodajKorisnika" value="Dodaj"></td>
                        </tr>
                    </table>
                </form>

            </div>

            <?php
                $rezultat = $veza->query("select * from korisnik order by username asc");
                if (!$rezultat) {
                    $greska = $veza->errorInfo();
                    print "SQL greška kod dobavljanja novosti: " . $greska[2];
                    exit();
                }
                //prikaz korisnika            "
                print "<div id='tabelaKorisnika'><table> <tr><td colspan='3'> Prikaz korisnika</td> <tr> <tr> <td>Username</td> <td>Mail</td> <td>Tip korisnika</td> </tr>";
                foreach ($rezultat as $korisnik) {
                    print "<tr> <td>".$korisnik['username']."</td><td>".$korisnik['mail']."</td><td>".$korisnik['tip']."</td><td><a href='adminpanel.php?sta=obrisi&korisnik=".$korisnik["id"]."'>Obriši</a></td></tr>";
                }
                print "</table> </div>";            
                //kraj prikaza korisnika
            ?>
           
        </div>
                </div>
                <div id="desno">
                    <h3>Zanimljivo:</h3>
                    <a href= "https://www.youtube.com/watch?v=MvTSfm7HfuI"><p>Kako se proizvodi laminat?</p></a>
                    <a href="http://en.wikipedia.org/wiki/Underlay"><p>Sta je filc podloga?</p></a>
                </div>
            </div>
        
    </body>
</html>
