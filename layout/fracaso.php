<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DETALLE DE COMPRAR</title>
	<style>
			body{  background-image: url("../img/LANDING-FAIL-CE.png");
               box-sizing: border-box; font-family: Arial;
            
            }

		form{

			margin: 180px auto;
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
            margin-left: 125px;
		}

        h2{
                padding-left: 60px;
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
					<h2>COMPRA FRACASADA</h2>
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
