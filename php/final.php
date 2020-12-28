
<?php  

		include_once '../Entities/Venta.php';
		include_once '../api/productos/productos.php';



// Load Composer's autoloader
require '../lib/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



		//Obtener  el  #Numero de La orden de Compra
		$venta=new Venta();
		$datos_detalle=$venta->getLastVenta();
		foreach($datos_detalle as $clave=>$elementos){
		
		  if ($clave=="cantidad") {
		  $cantidad=$elementos;
		  }	
				if ($clave=="id_user") {
				  $id_usuario=$elementos;
				  }
		
				  if ($clave=="orden_compra") {
					$ordenCompra=$elementos;
					}

		}
		
		var_dump($datos_detalle); 


		//Obtener La venta y sus datos por numero de Orden
		$datos_venta=$venta->getventa($ordenCompra);
		foreach($datos_venta as $clave=>$elementos){
			
			if ($clave=="estado") {
				$estado_transaccion=$elementos;
				}
					if ($clave=="orden_compra") {
						$orden_compra=$elementos;
					}
			
						if ($clave=="monto_tarjeta") {
							$monto_tarjeta=$elementos;
							}
		  }


		  
		if($estado_transaccion==1)  {
			
			echo "TRANSACCION APROBADA  // ACCIONES REDIRECCIONAR A A LA PAGINA DE EXITO Y MANDAR LOS CORREOS Y ".$estado_transaccion;
			$producto=new Productos();

			var_dump($monto_tarjeta); 
			var_dump($cantidad);

			$items=$producto->getCardByMontoCantidad($monto_tarjeta,'disponible',$cantidad);
			

							$codigos=[];
							foreach($items as $item){
								$producto->UpdateProducto($item['id'],$orden_compra,'usada'); //QUEMANDO LOS CODIGOS
								array_push($codigos, $item['cod_promocion']);
							}
	 
							var_dump($codigos); 

					
								sendEmail();
							//header("Location: ../layout/exito.php");
						   	
					

		}else{

			echo "TRANSACCION RECHAZDA    // ACCIONES REDIRECCIONAR A A LA PAGINA DE FRACASO   ".$estado_transaccion;
			header("Location: ../layout/fracaso.php");
		}




		function sendEmail(){


				// Instantiation and passing `true` enables exceptions
				$mail=new PHPMailer(true);

				try {
					//Server settings
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
					$mail->isSMTP();                                            // Send using SMTP
					$mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
					$mail->Username   = 'marketglobaldeveloper@gmail.com';                     // SMTP username
					$mail->Password   = 'chileandroid2020';                               // SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
					$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

					//Recipients
					$mail->setFrom('marketglobaldeveloper@gmail.com', 'Mailer');
					$mail->addAddress('marketglobalspa@gmail.com', 'Joe User');     // Add a recipient
					$mail->addAddress('globaltechnologieshd@gmail.com');               // Name is optional
					//$mail->addReplyTo('info@example.com', 'Information');
					//$mail->addCC('cc@example.com');
					//$mail->addBCC('bcc@example.com');

					// Attachments
					//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
					//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
					$codigo="GIFTCARD";

					// Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Correo de Contacto';
					$mail->Body    = 'Nombre' .$codigo. '<b>in bold!</b>';
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
					echo 'Message has been sent';

				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}


		}





 ?>



