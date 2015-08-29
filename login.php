<?php
    if(isset($_POST["btnLogin"])) {
        $veza = new PDO("mysql:dbname=dekordb;host=localhost;charset=utf8", "dekor", "1DvaTri!");
        $veza->exec("set names utf8");   
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $pass = md5($pass);
    
        $upit = $veza->prepare("select * from korisnik where username=? and password=?");           
        $upit->execute(array($user, $pass));           
        if (!$upit) {
            $greska = $veza->errorInfo();
            print "SQL greška kod dobavljanja korisnika: ". $greska[2];
            exit();
        }
         $rezultat = NULL;
            foreach($upit as $value) {
                $rezultat = $value;
                break;
            }
        if($rezultat == NULL) echo "Administrator sa tim imenom ili lozinkom ne postoji !";
        else{          
            session_start();            
            $_SESSION['username'] = $rezultat['username'];
            $_SESSION['id'] = $rezultat['id'];
            $_SESSION['mail'] = $rezultat['mail'];
            $_SESSION['tip'] = $rezultat['tip'];  
            $_SESSION['korisnikid'] = $rezultat['id'];
            header("Location: index.php"); /* Redirect browser */
            exit();    
    
        }    
    }          
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="stilindex.css">
    </head>
    <body>
        <div id="login">
            <h3>Prijava</h3>
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input name="user"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="pass"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Prijava" name="btnLogin"></td> 
                        <td><a href="#">Zaboravili ste lozinku?</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
