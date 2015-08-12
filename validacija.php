 <?php                  $ispravno = FALSE;    
                        $imeErr = $emailErr = $maticniErr = "";
                        $potvrdaErr = "greska";
                        $ime = $email = $naslov = $maticni = $poruka = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                           if (empty($_POST["ime"])) {
                             $imeErr = "Unesite ime!";
                           } else {
                             $ime = test_input($_POST["ime"]);
                             if (!preg_match("/^[a-zA-Z ]*$/",$ime)) {
                               $imeErr = "Ime smije da sadrzi samo slova i razmake!"; 
                             }
                        }
                       if (empty($_POST["email"])) {
                         $emailErr = "Unesite email!";   
                       } else {
                         $ime = test_input($_POST["ime"]);
                         $email = test_input($_POST["email"]);
                         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                           $emailErr = "Neispravan email format!";                       
                         }
                         else {
                             $a = strpos($email, "@");
                             $b = substr($email, 0, $a);
                             if(strpos($b, $ime) === FALSE){
                             $emailErr = "Ime mora biti sadrzano u emailu!";
                             }
                         }
                       }
     
                       if (empty($_POST["maticni"])) {
                         $maticniErr = "Unesite maticni broj!";

                       } else {
                         $maticni = test_input($_POST["maticni"]);
                         if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])(0[1-9]|1[012])[0-9]{9}$/",$maticni)) {
                           $maticniErr = "Maticni nije validan!"; 
                         }
                       }

                       if (empty($_POST["naslov"])) {
                         $naslov = "";
                       } else {
                         $naslov = test_input($_POST["naslov"]);
                       }
                        if (empty($_POST["mjesto"])) {
                         $mjesto = "";
                       } else {
                         $mjesto = test_input($_POST["mjesto"]);
                       }
                        if (empty($_POST["opcina"])) {
                         $opcina = "";
                       } else {
                         $opcina = test_input($_POST["opcina"]);
                       }
                       if (empty($_POST["poruka"])) {
                          $poruka = "";
                       } else {
                          $poruka = test_input($_POST["poruka"]);
                       }
                   }
                    if(!empty($_POST["ime"]) && !empty($_POST["maticni"]) && !empty($_POST["email"]) && !empty($_POST["mjesto"]) && !empty($_POST["opcina"])) $potvrdaErr = "";
                      if($imeErr == "" && $emailErr == "" && $maticniErr == "" && $potvrdaErr == "") $ispravno=TRUE;
                    function test_input($data) {
                       $data = trim($data);
                       $data = stripslashes($data);
                       $data = htmlspecialchars($data);
                       return $data;
                    }
    ?>