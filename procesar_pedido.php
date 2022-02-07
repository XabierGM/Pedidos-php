<?php
require 'correo.php';
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
    <?php
    require 'cabecera.php';
    $resul = insertar_pedido($_SESSION['carrito'],
        $_SESSION['usuario']['codRes']);
    if($resul === FALSE){
        echo "No se ha podido realizar el pedido<br>";
    }else{
        $correo = $_SESSION['usuario']['correo'];
        echo "Pedido realizado con éxito. Se enviará un correo de confirmación a: $correo ";
        $conf = enviar_correos($_SESSION['carrito'], $resul, $correo);
        if($conf!==TRUE){
            echo "Error al enviar: $conf <br>";
        };
        //vaciar carrito
        $_SESSION['carrito'] = [];

        }
    ?>
</body>
</html>