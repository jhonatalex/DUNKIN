
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DETALLE DE COMPRAR</title>
	<style>
		body{background-color: #264673; box-sizing: border-box; font-family: Arial;}

		form{
			background-color: white;
			padding: 10px;
			margin: 100px auto;
			width: 400px;
		}

		input[type=text], input[type=password]{
			padding: 10px;
			width: 380px;
		}
		input[type="submit"]{
			border: 0;
			background-color: #ED8824;
			padding: 10px 20px;
		}

		.error{
			background-color: #FF9185;
			font-size: 12px;
			padding: 10px;
		}
		.correcto{
			background-color: #A0DEA7;
			font-size: 12px;
			padding: 10px;
		}
	</style>
</head>
<body>
		<div class="container ">


				<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
					<h2>COMPRA EXITOSA</h2>
					<h3>Gif Card  Dunkin</h3>	
					<table class=" table table-striped table-hover">
						<thead><tr><th>Campo</th><th>Valor</th> </tr></thead>
						<tbody>
							<tr>
								<td>MONTO: </td>
								<td id="amount" > </td>
							</tr>
							<tr>
								<td>Codigo de Autorizacion: </td>
								<td id="autoCode" >  </td>
							</tr>
							<tr>
								<td>Codigo de Respuesta:  </td>
								<td id="respCode" >  </td>
							</tr>
						</tbody>
					</table>
						<p><input type="submit" value="VOLVER AL SITIO" name="volver" ></p>
				</form>
		  
		
		</div>	
          
            <?php  
             if(isset($_POST["volver"])){
                header("Location: ../index.php");
            }
            ?>
          



</body>
</html>





