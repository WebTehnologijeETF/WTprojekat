<?php
    
    session_start();    
    
    $veza = new PDO("mysql:dbname=dekordb;host=127.6.44.2;charset=utf8", "adminiXNWnnq", "t5Izi-S7gLII");
    $veza->exec("set names utf8");     
    
?>

<div>
    <script src="skripte/novost.js"></script>
</div>



<div>
    <script>       
      dajSveNovosti("<?php print $_SESSION['username']; ?>");      
    </script>
</div>