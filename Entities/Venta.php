<?php



include_once '../lib/db.php';

class Venta extends DB{   

    function __construct(){
        parent::__construct();
    }


    public function  insertVenta($ordenCompra,$fecha,$monto, $cantidad, $id_producto, $usuario_email, $codigo_autorizacion,
                                $codigo_respuesta, $token,$estado_transaccion){
        $query = $this->connect()->prepare("INSERT INTO  venta (orden_de_compra, fecha, monto, cantidad, producto_id, usuario_email,codigo_autorizacion,codigo_respuesta,token,estado_transaccion) 
                                            VALUES (:orden_de_compra, :fecha, :monto, :cantidad, :producto_id,:usuario_email, :codigo_autorizacion, :codigo_respuesta, :token,:estado)");
        $query->execute(['orden_de_compra' => $ordenCompra,
                         'fecha' => $fecha,
                         'monto' => $monto,
                         'cantidad' => $cantidad,
                         'producto_id' => $id_producto,
                         'usuario_email' => $usuario_email,
                         'codigo_autorizacion' => $codigo_autorizacion,
                         'codigo_respuesta' =>  $codigo_respuesta,
                         'token' =>  $token,
                         'estado' =>  $estado_transaccion]);  

    }



    public function  insertDetalleVenta($cantidad,$id_producto,$id_user){
    $query = $this->connect()->prepare("INSERT INTO  transaccion (cantidad, id_producto, id_user ) VALUES (:cantidad, :id_producto, :id_user)");
    $query->execute(['cantidad' => $cantidad,
                        'id_producto' => $id_producto,
                        'id_user' =>$id_user]);  

    }




    public function getDetalleVenta(){
        $query = $this->connect()->prepare('SELECT * FROM transaccion');
        $query->execute();


        while($row = $query->fetch(PDO::FETCH_ASSOC)){

            $item =[
                'cantidad'     => $row['cantidad'],
                'id_producto'  => $row['id_producto'],
                'id_user'      => $row['id_user'],
            ];

            
        } 
        return $item;
    }






}

?>