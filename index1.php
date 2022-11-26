<html>

<head>
    <title>Conexion por Telent</title>
</head>

<body>
    <?php
    set_time_limit(10);
    $direccion = "172.16.28.2";
    $puerto = "23";
    $tiempo_colapsa = 120;
    $password_telnet = "mundo16--";
    $comandos = "enable";
    $comandos2 = "config";
    $comando3 = "interface gpon 0/3";
    $comando5 = "display ont info 0 all";
    $comando4 = "quit";
    $usuario = "edmundom";

    
    $salida = "$usuario\n";
    $salida .= "$password_telnet\n";
    $salida .= "enable\n";
    $salida .= "config\n";
    $salida .= "interface gpon 0/3\n";
    $salida .= "display ont autofind 5\n";
    $salida .= "quit\n";
    $salida .= "quit\n";
    $salida .= "quit\n";
    $salida .= "y\n";


    /*$direccion = "192.168.70.254";
    $puerto = "23";
    $tiempo_colapsa = 1200;
    $password_telnet = "mnet2020";
    $comandos = "queue";
    $usuario = "mnet";
    $salida = "$usuario \r\n";
    $salida .= "$password_telnet \r\n";*/

    $conecta_telnet = fsockopen($direccion, $puerto, $errno, $errstr, $tiempo_colapsa);
    if (!$conecta_telnet) {
        echo "$errstr ($errno)";
        echo "<br>";
    } else {
        echo "&iexcl;Conectado satisfactoriamente!<br>";
        
        while (!feof($conecta_telnet)) {
            fwrite($conecta_telnet, $salida);
            echo fgets($conecta_telnet, 128).'<br>';
        } 
        fclose($conecta_telnet);
    }
    ?>
</body>

</html>