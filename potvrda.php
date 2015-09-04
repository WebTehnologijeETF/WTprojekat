   <?php
                  
                        if($ispravno === TRUE){
                            $potvrdi = '<div id="potvrda">';
                            $potvrdi .= '<h>Provjerite da li ste ispravno popunili kontakt formu!!!</h>';
                            $potvrdi .= '<table><tr><td>Ime i prezime: </td><td>'.$ime.'</td></tr>';
                            $potvrdi .= '<tr><td>E-mail adresa:</td><td>'.$email.'</td></tr>';
                            $potvrdi .= '<tr><td>Maticni broj:</td><td>'.$maticni.'</td></tr>';
                            $potvrdi .= '<tr><td>Mjesto:</td><td>'.$mjesto.'</td></tr>';
                            $potvrdi .= '<tr><td>Opcina:</td><td>'.$opcina.'</td></tr>';
                            $potvrdi .= '<tr><td>Naslov:</td><td>'.$naslov.'</td></tr>';
                            $potvrdi .= '<tr><td>Poruka:</td><td rowspan="3">'.$poruka.'</td></tr></table>';
                            $potvrdi .= '<h> Da li ste sigurni da zelite poslati ove podatke? </h>';
                            $potvrdi .= '<input id="siguran" type="submit" name="siguran" value="Siguran sam!" ';
                            $potvrdi .= '<h> Ako ste pogresno popunili formu, mozete ispod prepraviti unesene podatke!</h>';
                            $potvrdi .= '</div>';
                            echo $potvrdi;        
                        }    
                        
                        if(isset($_REQUEST["siguran"])) {
                                echo "<h2>Zahvaljujemo se što ste nas kontaktirali !</h2>";
                                $to = "edautbegov1@etf.unsa.ba";
                                $subject = $naslov;
                                $message = $ime."\n".$email."\n".$maticni."\n".$mjesto."\n".$opcina."\n"."\n \n \n".$poruka;
                                mail($to, $subject, $message); 
                        }    
                    ?>