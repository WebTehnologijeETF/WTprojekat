<?php
     $veza = new PDO("mysql:dbname=dekordb;host=127.6.44.2;charset=utf8", "adminiXNWnnq", "t5Izi-S7gLII");   
     $veza->exec("set names utf8");   
     $rezultat = $veza->query("select * from novost where id = ".$_REQUEST['novost']);
     
     if (!$rezultat) {
          $greska = $veza->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     }    
     $novost = NULL;
     foreach ($rezultat as $vijest) { $novost = $vijest; }
    
?>

<?php
    if(isset($_POST['btnUrediNovost'])) {        
         $veza = new PDO("mysql:dbname=dekordb;host=127.6.44.2;charset=utf8", "adminiXNWnnq", "t5Izi-S7gLII");    
         $veza->exec("set names utf8");   
         $rezultat = $veza->prepare("update novost set naslov = ?, tekst = ?, slika = ? where id =".$_REQUEST['novost']);
         $rezultat->execute(array($_POST["naslov"],$_POST["tekst"], $_POST["slika"]));               
           if (!$rezultat) {
                $greska = $veza->errorInfo();
                print "SQL greška: " . $greska[2];
                exit();
            }              
        header("Location: index.php"); 
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link rel="stylesheet" type="text/css" href="stilindex.css">
    </head>
    <body>
        <h3>Uredi novost</h3>
        <div id="objavaNovost">
            <form action="uredinovost.php?novost=<?php print $_REQUEST['novost']?>" method="post">
                <table>
                    <tr>
                        <td><p>Naslov:</p></td>
                        <td><input name="naslov" value="<?php print $novost['naslov']?>"></td>
                    </tr>
                    <tr>
                        <td><p>Slika:</p></td>
                        <td><input name="slika" value="<?php print $novost['slika']?>"></td>
                    </tr>
                </table>
                <p>Tekst</p> <textarea name="tekst"><?php print $novost['tekst']?></textarea>
                <input type="submit" name="btnUrediNovost" value="Uredi">
            </form>
        </div>
    </body>
</html>
