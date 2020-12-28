<?php 

include_once '../Entities/Usuario.php';
include_once '../Entities/Destinatario.php';
include_once '../Entities/Venta.php';

include_once '../api/productos/productos.php';


//TRANSKBANK***********************************//


require_once '../Transbank/vendor/autoload.php';
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;



		if (!empty($_POST['email']) && !empty($_POST['nombre']) && /*!empty($_POST['email_destino']) && */
			!empty($_POST['count']) && !empty($_POST['monto_tarjeta']) && !empty($_POST["valor"])){

			$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
			-> getNormalTransaction();

			$amount = $_POST['valor'];
			$sessionId=$_POST['email'];
			$buyOrder=strval(rand(10000,9999999));
			$returnUrl='http://localhost/DUNKIN/php/return.php';
			$finalUrl='http://localhost/DUNKIN/php/final.php';
				
			$initResult = $transaction -> initTransaction($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
		   
			//ASOCIAR EL TOKEN CON LA TRANSACCION
			$tokenWs = $initResult -> token;


			$user=new Usuario();
			$destino=new Destinatario();
			$venta=new Venta();
			$producto=new Productos();



			//USUARIO Y CONPROBAR SI YA EXISTE EN LA BASE DE DATOS
			if (!$user->duplicacion($_POST['email'], $_POST['nombre'])){
				$user ->insertUser($_POST['email'],$_POST['nombre'],$_POST['celular']);

			}

			///DESTINATARIO
			$destinos=[];
			for ($i=1; $i <=$_POST['count']; $i++) { 


				$item =[
					'email_destino'      => $_POST['email_destino_'.$i] ,
					'nombre_destino'   	 => $_POST['nombre_destino_'.$i],
					'mensaje_destino'    => $_POST['mensaje_'.$i],
					'email_origen'       => $_POST['email'],
					
				];

				array_push($destinos, $item );

			}

			var_dump($destinos);

			foreach($destinos as $elemento){
				$destino ->insertDestinatario($elemento['email_destino'], $elemento['nombre_destino'],$elemento['mensaje_destino'],$elemento['email_origen']);
			}





			
		
			



			///VENTA O TRANSACCION Detalle
			$valor=  $venta->insertDetalleVenta($_POST['count'],$_POST['monto_tarjeta'],$_POST['email'],$buyOrder);


			///VERIFICAR LA DISPONIVILIDAD DE LAS TARJETAS
			$items=$producto->getCardByMontoCantidad($_POST['monto_tarjeta'],'disponible',$_POST['count']);
			
						if (sizeof($items)<$_POST['count'] || sizeof($items)<=0){
							
							echo "NO HAY TARJETAS DE ESE MONTO DISPONIBLES";
							header("Location: ../layout/fracaso.php");
							header("Location: final.php");

						}else{

						$codigos=[];
						foreach($items as $item){
							array_push($codigos, $item['cod_promocion']);
						}
					

					}


	?>

			<form action="<?php echo $initResult -> url?>" method="post" id="returForm">
			<input type="hidden" name="token_ws"  value="<?php echo $tokenWs?>">
			</form>

			<script>
			//document.getElementById('returForm').submit();
			</script>   



<?php 


		}else {
			echo "<script> alert('Favor rellene todos los campos Obligatorios y  seleccione una Tarjeta');
			window.location='../index.php';
			</script>";

		}





?>











