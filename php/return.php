<?php 
require_once '../Transbank/vendor/autoload.php';
include_once '../Entities/Venta.php';
//include_once '../api/productos/productos.php';

use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;


$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                -> getNormalTransaction();

             
$tokenWs = filter_input(INPUT_POST,'token_ws');
$result = $transaction -> getTransactionResult($tokenWs);
$output = $result -> detailOutput; 


$fecha_actual=date("Y-m-d H:i:s");
$codigoAutorizacion=$output -> authorizationCode;
$montoTotal=$output -> amount;
$codigoRespuesta=$output -> responseCode;
$token=$tokenWs;
$buyOrder= $output -> buyOrder;



///VENTA O TRANSACCION
$venta=new Venta();
$datos_detalle=$venta->getDetalleVenta($buyOrder);
foreach($datos_detalle as $clave=>$elementos){

  if ($clave=="cantidad") {
  $cantidad=$elementos;
  }
    if ($clave=="monto_tarjeta") {
      $monto_tarjeta=$elementos;
      }
        if ($clave=="id_user") {
          $id_usuario=$elementos;
          }
            if ($clave=="orden_compra") {
              $buyOrderBD=$elementos;
              }

}


              if ($output -> responseCode == 0) {// si es Igual a 0 las Transaccion fue aprobada
                // MARCAR ORDEN EN BASE DATOS COMO APROBADA
                $estado_transaccion=1;
                // GUARDAR EN BASE DE DATOS RESULTADO
                $venta ->insertVenta($buyOrderBD,$fecha_actual,$montoTotal,$cantidad,	$monto_tarjeta,
                $id_usuario, $codigoAutorizacion,$codigoRespuesta,$token,$estado_transaccion);
                
              }else{
                // MARCAR ORDEN EN BASE DATOS COMO RECHAZADA
                $estado_transaccion=0;
                // GUARDAR EN BASE DE DATOS RESULTADO
                $venta ->insertVenta($buyOrderBD,$fecha_actual,$montoTotal,$cantidad, $monto_tarjeta,
                $id_usuario, $codigoAutorizacion,$codigoRespuesta,$token,$estado_transaccion);
              }
      
 
// GUARDAR EN BASE DE DATOS RESULTADO

?>

       <form action="<?php  echo $result -> urlRedirection ?>" method="post" id="returForm2">
                <input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
            </form>

            <script>
             document.getElementById('returForm2').submit();
            </script>   




