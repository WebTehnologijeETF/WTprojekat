<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> D.o.o. "Dekoram" </title>
        <link rel="stylesheet" type="text/css" href="stilindex.css">
    </head>
    <body>
        <script src="validacijaKontaktForme.js"></script>
        <script src="padajuciMeni.js"></script>
        <script src="singlePage.js"></script>
        <div id="stranica">
            <div id="zaglavlje">
                <a href="#" onclick="return Otvori('index.php')"><img src="logo2.jpg" alt="logo"></a>
                <h1>d.o.o. "Dekoram"</h1>
                <p>-Prodaja i ugradnja laminata i parketa-</p>   
            </div>
            <div id="meni">
                <ul>
                    <li> <a href="#" onclick="return Otvori('index.php')"> Pocetna </a> </li>
                    <li  onclick ="prikaziMeni()"   id="tipka"> Laminati <img id="strelica" src="strelica.jpg" alt="strelica"> <div id="padajuciMeni"> </div> </li>
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
                    <?php
                      include 'Validacija.php';
                    ?>
                  
                   <?php 
                      include 'potvrda.php'
                   ?>
                   
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <table id="kontaktforma">
                            <tr>
                                <td>Ime i prezime:</td>
                                <td><input type="text" name="ime" value="<?php echo $ime;?>"></td>
                                <td><span class="error">* <?php echo $imeErr;?></span></td>
                            </tr>
                            <tr>
                                <td>E mail:</td>
                                <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                                <td><span class="error">* <?php echo $emailErr;?></span></td>    
                            </tr>
                            <tr>
                                <td>Maticni broj:</td>
                                <td><input type="text" name="maticni" value="<?php echo $maticni;?>"></td>
                                <td><span class="error">* <?php echo $maticniErr;?></span></td>             
                            </tr>
                             <tr>
                                <td>Mjesto:</td>
                                 <td><input type="text" id="mjesto" name="mjesto" value="<?php echo $mjesto;?>"></td>
                            </tr>
                             <tr>
                                <td>Opcina:</td>
                                 <td><input type="text" id="opcina" name="opcina" value="<?php echo $opcina;?>"></td>
                                
                            </tr>
                            <tr>
                                <td>Naslov:</td>
                                <td><input type="text" name="naslov" value="<?php echo $naslov;?>"></td>
                            </tr>
                            <tr>
                                <td id="por">Poruka:</td>
                                <td><input type="text" name="poruka" value="<?php echo $poruka;?>"></td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td id="posalji">
                                    <input type="reset" name="reset" value="Ponisti">
                                    <input type="submit" name="submit" value="Posalji" onclick="provjeraMjestaIOpcine()">
                                    
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="desno">
                </div>
            </div>
        </div>      
    </body>
</html> 
