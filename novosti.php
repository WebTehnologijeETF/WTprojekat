<?php
 
   echo '<h3> Novosti </h3>';
   $brojac = 0;
  foreach (glob("Novosti/*.txt") as $file) {
          $brojac++; 
          $file = test_input($file);
          $handle = fopen($file, "r");
          if ($handle) 
          {
                      $datum = fgets($handle, 1024); $datum = test_input($datum);
                      $autor = fgets($handle, 1024); $autor = test_input($autor);
                      $naslov = fgets($handle, 1024); $naslov = test_input($naslov);
                      $slika = fgets($handle, 1024); $slika = test_input($slika);
                      $tekst = "";
                      $pomocna = fgets($handle, 1024); $pomocna = test_input($pomocna);
                      while($pomocna !== '--'){
                          $tekst .= $pomocna;
                          $pomocna = fgets($handle, 1024); $pomocna = test_input($pomocna);
                      }
                      $pomocna = fgets($handle, 1024); $pomocna = test_input($pomocna);
                      $detaljnije = "";
                      while($pomocna !== '')
                      {
                          $detaljnije .= $pomocna;
                          $pomocna = fgets($handle, 1024); $pomocna = test_input($pomocna);
                      }
                      $objavi = '<div class="novost">';
                      $slika = trim($slika);
                      if($slika != "")
                      {
                          $objavi .= '<img  src="'.$slika.'" alt="slika">';
                      }
                      $objavi .= '<p>'.$datum.'</p>';
                      $objavi .= '<p>'.$autor.'</p>';
                      $objavi .= '<h id = "naslov">'.$naslov.'</h>';
                      if($detaljnije != '')
                      { 
                        $objavi .= '<p id="tekst">'.$tekst.'</p>';                     
                        $objavi .= '<a class="detaljnije">Detaljnije</a>';
                      }  
                      else
                      $objavi .= '<p id="tekst">'.$tekst.'</p>';     
                      $objavi .= '</div>';
                      echo $objavi;
           }
  }
  function test_input($data) {
                       $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                       return $data;
                    }
?>