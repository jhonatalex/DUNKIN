<?php

include_once 'productos.php';

if(isset($_GET['monto'])){
    $monto= $_GET['monto'];

        if($monto == ''){
            echo json_encode(['statuscode' => 400, 'response' => 'No existe GiftCard de ese Monto']);
        }else{
            $productos = new Productos();
            $items = $productos->getItemsByMonto($monto);

            echo json_encode(['statuscode' => 200, 'items' => $items]);
        }



}else if(isset($_GET['get-item'])){
        $id = $_GET['get-item'];

        if($id == ''){
            echo json_encode(['statuscode' => 400, 'response' => 'no hay valor para id']);
        }else{
            $productos = new Productos();
            $item = $productos->get($id);
            echo json_encode(['statuscode' => 200, 'item' => $item]);
        }


}else  if(isset($_GET['monto']) && isset($_GET['estado']) && isset( $_GET['cantidad']) ){
    $monto= $_GET['monto'];
    $estado= $_GET['estado'];
    $cantidad= $_GET['cantidad'];

        if($monto == ''){
            echo json_encode(['statuscode' => 400, 'response' => 'No existe GiftCard Disponibles de ese Monto']);
        }else{
            $productos = new Productos();
            $items = $productos->getCardByMontoCantidad($monto,$estado,$cantidad);

            echo json_encode(['statuscode' => 200, 'items' => $items]);
        }


}else  { 
    echo json_encode(['statuscode' => 400, 'response' => 'No hay accion']);
}

?>