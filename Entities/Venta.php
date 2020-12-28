<?php



include_once '../lib/db.php';

class Venta extends DB{   

    function __construct(){
        parent::__construct();
    }


    public function  insertVenta($buyOrder,$fecha,$monto, $cantidad, $monto_tarjeta, $usuario_email, $codigo_autorizacion,
                                $codigo_respuesta, $token,$estado_transaccion){
        $query = $this->connect()->prepare("INSERT INTO  venta (orden_compra, fecha, monto, cantidad, monto_tarjeta, usuario_email,codigo_autorizacion,codigo_respuesta,token,estado_transaccion) 
                                            VALUES (:orden_compra, :fecha, :monto, :cantidad, :monto_tarjeta,:usuario_email, :codigo_autorizacion, :codigo_respuesta, :token,:estado)");
        $query->execute(['orden_compra' => $buyOrder,
                         'fecha' => $fecha,
                         'monto' => $monto,
                         'cantidad' => $cantidad,
                         'monto_tarjeta' => $monto_tarjeta,
                         'usuario_email' => $usuario_email,
                         'codigo_autorizacion' => $codigo_autorizacion,
                         'codigo_respuesta' =>  $codigo_respuesta,
                         'token' =>  $token,
                         'estado' =>  $estado_transaccion]);  

    }



    public function getventa($orden_compra){
        $query = $this->connect()->prepare('SELECT * FROM venta WHERE orden_compra = :orden_compra');
        $query->execute(['orden_compra' => $orden_compra]);

        $items = [];

        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'orden_compra' =>$row['orden_compra'],
                'fecha' => $row['fecha'],
                'monto' => $row['monto'],
                'cantidad' => $row['cantidad'],
                'monto_tarjeta' => $row['monto_tarjeta'],
                'usuario_email' => $row['usuario_email'],
                'codigo_autorizacion' => $row['codigo_autorizacion'],
                'codigo_respuesta' =>  $row['codigo_respuesta'],
                'token' =>  $row['token'],
                'estado' =>  $row['estado_transaccion'], 

            ];

            array_push($items, $item);
        } 
        return $item;
    }





    public function  insertDetalleVenta($cantidad,$monto_tarjeta,$id_user,$orden_compra){
    $query = $this->connect()->prepare("INSERT INTO  transaccion (cantidad, monto_tarjeta, id_user, orden_compra) VALUES (:cantidad, :monto_tarjeta, :id_user, :orden_compra)");
    $query->execute(['cantidad' => $cantidad,
                        'monto_tarjeta' => $monto_tarjeta,
                        'id_user' =>$id_user,
                        'orden_compra' =>$orden_compra]);  
     
     return $this->connect()->lastInsertId();
    }



    public function getDetalleVenta($orden_compra){
        $query = $this->connect()->prepare('SELECT * FROM transaccion WHERE orden_compra = :orden_compra');
        $query->execute(['orden_compra' => $orden_compra]);

        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'cantidad'     => $row['cantidad'],
                'monto_tarjeta'  => $row['monto_tarjeta'],
                'id_user'      => $row['id_user'],
                'orden_compra' => $row['orden_compra'],
            ];
 
        } 
        return $item;
    }





    public function getLastVenta(){
        $query = $this->connect()->prepare('SELECT * FROM transaccion ORDER BY id DESC LIMIT 1');
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'cantidad'     => $row['cantidad'],
                'monto_tarjeta'  => $row['monto_tarjeta'],
                'id_user'      => $row['id_user'],
                'orden_compra' => $row['orden_compra'],
            ];
 
        } 
        return $item;
    }




















}

?>