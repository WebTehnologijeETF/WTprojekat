<?php
    function zag() {
        header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
        header('Content-Type: text/html');
        header('Access-Control-Allow-Origin: *');
    }
    
    function rest_get($request, $data) {      
        $veza = new PDO("mysql:dbname=dekordb;host=localhost;charset=utf8","dekor", "1DvaTri!");    
        $veza->exec("set names utf8");       
        if($data["sta"] == "dobaviSve") {                                                    
            $rezultat = $veza->prepare("select * from komentar where novostid = ? order by datum DESC;");
            $rezultat->execute(array($data["novostid"]));
            if (!$rezultat) {
                $greska = $veza->errorInfo();
                print "SQL greška: " . $greska[2];
                //exit();
            }	         
            print json_encode($rezultat->fetchAll());      
        } 
        if($data["sta"] == "brojKomentara") {
            $brojKomentara = $veza->query("select count(*) from komentar where novostid=" . $data['novostid'] . ";");
            if (!$brojKomentara) {
                $greska = $veza->errorInfo();
                print "SQL greška: " . $greska[2];
                exit();
            }
            $broj = $brojKomentara->fetchColumn();
            print json_encode(array("broj"=>$broj));                                      
        }
    }
    
    function rest_post($request, $data) {            
        $veza = new PDO("mysql:dbname=dekordb;host=localhost;charset=utf8","dekor", "1DvaTri!");    
        $veza->exec("set names utf8");                                            
        $rezultat = $veza->prepare("insert into komentar(novostid, autor, mail, tekst) values(?,?,?,?)");
        $rezultat->execute(array($data["novostid"],$data["autor"],$data["mail"], $data["tekst"]));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print json_encode(array("OK"=>"NO"));            
        } else print json_encode(array("OK"=>"OK"));
    }
    
    function rest_delete($request, $data) {
        $veza = new PDO("mysql:dbname=dekordb;host=localhost;charset=utf8","dekor", "1DvaTri!");    
        $veza->exec("set names utf8");                                           
        $rezultat = $veza->prepare("delete from komentar where id = ?");
        $rezultat->execute(array($data["id"]));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print json_encode(array("OK"=>"NO"));            
        } else print json_encode(array("OK"=>"OK")); 
    }
    
    function rest_put($request, $data) { 
        $veza = new PDO("mysql:dbname=dekordb;host=localhost;charset=utf8","dekor", "1DvaTri!");    
        $veza->exec("set names utf8");                                            
        $rezultat = $veza->prepare("update novost set naslov = ?, slika = ?, tekst = ? where id= ?");
        $rezultat->execute(array($data["naslov"], $data["slika"], $data["tekst"], $data["id"]));        
        if (!$rezultat) {
            $greska = $veza->errorInfo();
            print json_encode(array("OK"=>"NO"));            
        } else print json_encode(array("OK"=>"OK")); 
    }
    function rest_error($request) { }
    
    $method  = $_SERVER['REQUEST_METHOD'];
    $request = $_SERVER['REQUEST_URI'];    
    
    switch($method) { 
        case 'PUT':
            parse_str(file_get_contents('php://input'), $put_vars);
            zag(); $data = $put_vars; rest_put($request, $data); break;
        case 'POST':
            zag(); $data = $_POST; rest_post($request, $data); break;
        case 'GET':
            zag(); $data = $_GET; rest_get($request, $data); break;
        case 'DELETE':
            zag(); $data = $_REQUEST; rest_delete($request, $data); break;
        default:
            header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
            rest_error($request); break;
    }
?>