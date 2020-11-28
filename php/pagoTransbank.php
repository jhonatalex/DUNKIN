<?php 

include_once '../Entities/Usuario.php';
include_once '../Entities/Destinatario.php';
include_once '../Entities/Venta.php';



session_start();


$_SESSION ['cantidad']=$_POST['count'];
$_SESSION ['id_producto']=$_POST['product'];
$_SESSION ['id_email'] =$_POST['email'];



//TRANSKBANK***********************************//


require_once '../Transbank/vendor/autoload.php';
use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
 			-> getNormalTransaction();


	
	$amount = $_POST['valor'];
	$sessionId='sessionId';
	$buyOrder=strval(rand(10000,9999999));
	$returnUrl='http://localhost/DUNKIN/php/return.php';
	$finalUrl='http://localhost/DUNKIN/php/final.php';
		

	$initResult = $transaction -> initTransaction($amount, $sessionId, $buyOrder, $returnUrl, $finalUrl);
   
	//ASOCIAR EL TOKEN CON LA TRANSACCION
	$tokenWs = $initResult -> token;
	echo $amount;



   ///USUARIO
		$user=new Usuario();
		if (isset($_POST['email'])){

			// CONPROBAR SI YA EXISTE EN LA BASE DE DATOS
			if ($user->duplicacion($_POST['email'], $_POST['nombre'])){
				echo "<script> alert('USUARIO YA REGISTRADO');
				window.location='../index.php';
				</script>";
			}else{
				$user ->insertUser($_POST['email'],$_POST['nombre'],$_POST['celular']);
				echo "RESGISTRO EXITOSO";
			}

		}else {
			echo "FAVOR RELLENE LOS CAMPOS";
		}

  ///DESTINATARIO
		
		$destino=new Destinatario();
		if (isset($_POST['nombre_destino'])){
			$destino ->insertDestinatario($_POST['email_destino'],$_POST['nombre_destino'],$_POST['mensaje'],$_POST['email']);

  		}

	///VENTA O TRANSACCION Detalle
		$venta=new Venta();
		  $venta->insertDetalleVenta($_POST['count'],$_POST['product'],$_POST['email'])



?>



<?php if (!empty($_POST["valor"])): ?>  
	
	
	<form action="	<?php echo $initResult -> url ?>" method="post" id="returForm">
	<input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
	</form>

	<script>
	document.getElementById('returForm').submit();
	</script>   



<?php 
else:	echo "<script> alert('No ha seleccionado ninguna Tarjeta');
		 window.location='../index.php';
		</script>";



endif;

?>








