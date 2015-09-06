<?php    
    session_start();    

    $veza = new PDO("mysql:dbname=dekordb;host=127.6.44.2;charset=utf8", "adminiXNWnnq", "t5Izi-S7gLII");   
    $veza->exec("set names utf8");     
    
?>

<?php
    //objavljivajne novosti (unošene u bazu)
    if(isset($_POST['btnObjaviNovost'])) {                                                    
        $rezultat = $veza->prepare("insert into novost(naslov, tekst, autor, slika) values(?,?,?,?)");
        $rezultat->execute(array($_POST["naslov"],$_POST["tekst"], $_SESSION['username'], $_POST["slika"]));               
       if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška: " . $greska[2];
            exit();
        }
        header("Location: index.php"); /* Redirect browser */
        exit();    
    }    
    
    //brisanje novosti iz baze 
    if(isset($_REQUEST['sta']) && $_REQUEST['sta'] == 'obrisi' && isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {                                                    
        $rezultat = $veza->prepare("delete from novost where id = ?");
        $rezultat->execute(array($_REQUEST["novost"]));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print "SQL greška: " . $greska[2];
            exit();
        }
        header("Location: index.php"); 
        exit();  
    }    

?>

<?php
     if(isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {
?>
<h3>Objavi novost</h3>
<div id="objavaNovost">
    <form action="novosti.php" method="post">
        <table>
            <tr><td><p>Naslov:</p></td><td><input name="naslov"></td></tr>
            <tr><td><p>Slika:</p></td> <td><input name="slika"></td></tr>
        </table>
        <p>Tekst</p> <textarea name="tekst"></textarea>
        <input type="submit" name="btnObjaviNovost" value="Objavi">
    </form>
</div>

<?php   
     }          
    $rezultat = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme, autor, slika from novost order by vrijeme desc");
     
     if (!$rezultat) {
          $greska = $veza->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     }    
     foreach ($rezultat as $vijest) {   
        $tekst = substr($vijest['tekst'],0,100);
        $tekst .= "...";
        print '<div class="novost">';
        print '<img src="'.$vijest['slika'].'" alt="Slika">';
        print '<p>'.date("d.m.Y. (h:i)",$vijest['vrijeme']).'</p>';
        print '<p>'.$vijest['autor'].'</p>';
        print '<h1 id="naslov">'.$vijest['naslov'].'</h1>';
        print '<p id="tekst"> '.$tekst.'  </p>';
        
        if(isset($_SESSION['username']) && $_SESSION['tip'] == 'Admin') {
            print "<a href='uredinovost.php?novost=".$vijest['id']."'>Uredi </a>";
            print "<a href='novosti.php?sta=obrisi&novost=".$vijest['id']."'>Obriši </a>";
        }

        print '<a href="novost.php?novost='.$vijest['id'].'">Detaljnije</a>'; 
        print '</div>';       
     }
    
?>