<?php

$buyOrder=strval(rand(10000,9999999));

?>


<div class="container">
    <div class="row align-items-center">

            <form  class="contact-form" action="./php/pagoTransbank.php" method="POST" class="form-inline" role="form">

                         <h2>DATOS USUARIO (REMITENTE)<h2>
                        <div class="col-md-8">
                            <input type="text" placeholder="Nombre y Apellido" name="nombre" id="name">
                            <div class="error errornombre"></div>
                        </div>
      
                        <div class="col-md-8">
                            <input type="email" placeholder="Email" name="email" id="email_pk">
                            <div class="error errormail"></div>
                        </div>
                        <div class="col-md-8">
                            <input type="text" placeholder="Celular" name="celular" id="celular">
                            <div class="error errorcel"></div>
                        </div>


                        
                        <div id="destinatarios">
                          
                        </div>
                        


                        <h2>Pago con Webpay</h2>
                        <p><b>Orden de Compra</b>:  <?php echo $buyOrder ?>  </p>
                        <p>Detalle</p>
         

                        <p><b>cantidad</b>:  <?php echo $buyOrder ?>  </p>
                        <p><b>Orden de Compra</b>:  <?php echo $buyOrder ?>  </p>
                            <spam id = "totalcompra" ></spam> 
                            <input   name="count" id = "cantidad" >
                            <input   name="monto_tarjeta" id = "monto_tarjeta" >
                            <input  name="valor" id = "totaloculto" >
                            <button type="submit" class="btnpagar">Pagar</button>

          
             </form>


            <br>


	
        <div class="col-md-6 webpay">
                <img src="img/pen.jpg" alt="Webpay">

        </div>

  

    </div>   


</div>












