<?php 
require_once '../Transbank/vendor/autoload.php';
include_once '../Entities/Venta.php';


use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;


$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                -> getNormalTransaction();

             
$tokenWs = filter_input(INPUT_POST,'token_ws');
$result = $transaction -> getTransactionResult($tokenWs);
$output = $result -> detailOutput; 

///VENTA O TRANSACCION

$venta=new Venta();
$datos_detalle=$venta->getDetalleVenta();
foreach($datos_detalle as $clave=>$elementos){

  if ($clave=="cantidad") {
  $cantidad=$elementos;
  }
    if ($clave=="id_producto") {
      $id_producto=$elementos;
      }
        if ($clave=="id_user") {
          $id_usuario=$elementos;
          }

}


$buyOrder=strval(rand(10000,999999));
$fecha_actual=date("Y-m-d H:i:s");
$codigoAutorizacion=$output -> authorizationCode;
$montoTotal=$output -> amount;
$codigoRespuesta=$output -> responseCode;
$token=$tokenWs;



              if ($output -> responseCode == 0) {// si es Igual a 0 las Transaccion fue aprobada
                // MARCAR ORDEN EN BASE DATOS COMO RECHAZADA
                $estado_transaccion=1;
                // GUARDAR EN BASE DE DATOS RESULTADO
                $venta ->insertVenta($buyOrder,$fecha_actual,$montoTotal,$cantidad,	$id_producto,
                $id_usuario, $codigoAutorizacion,$codigoRespuesta,$token,$estado_transaccion);
              }else{
                // MARCAR ORDEN EN BASE DATOS COMO RECHAZADA
                $estado_transaccion=0;
                // GUARDAR EN BASE DE DATOS RESULTADO
                $venta ->insertVenta($buyOrder,$fecha_actual,$montoTotal,$cantidad, $id_producto,
                $id_usuario, $codigoAutorizacion,$codigoRespuesta,$token,$estado_transaccion);
              }




?>
 

            <form action="<?php  echo $result -> urlRedirection ?>" method="post" id="returForm2">
                <input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
            </form>

            <script>
              document.getElementById('returForm2').submit();
            </script>   




