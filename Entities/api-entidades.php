<?php

include_once 'Venta.php';

if(isset($_GET['get-venta'])){
    $idUser= $_GET['get-venta'];

        if($idUser== ''){
            echo json_encode(['statuscode' => 400, 'response' => 'No existe GiftCard de ese Monto']);
        }else{
            $venta = new venta();
            $item = $venta->getventa($idUser);

            echo json_encode(['statuscode' => 200, 'item' => $item]);
        }
        
}else { 
    echo json_encode(['statuscode' => 400, 'response' => 'No hay accion']);
}

?>