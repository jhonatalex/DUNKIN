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

           
                        <h2>DESTINATARIO</h2>
                        <div class="col-md-8">
                            <input type="text" placeholder="Nombre y Apellido del Destinatario" name="nombre_destino"
                                id="nombre">
                        </div>
      
                        <div class="col-md-8">
                            <input type="email" placeholder="Email Destinatario" name="email_destino" id="email_destino">
                 
            
                        <div class="col-md-8">
                            <textarea cols="10" rows="1" placeholder="Dedicatoria... Opcional" name="mensaje"
                                id="mensaje"></textarea>
                            <div class="error errormensaje"></div>
                        </div>


                        <h2>Pago con Webpay</h2>
                        <p><b>Orden de Compra</b>:  <?php echo $buyOrder ?>  </p>
                        <p>Detalle</p>
         

                            <label id = "subtotal" >  </label>  
                            <spam id = "totalcompra" ></spam> 
                            <input  type="hidden" name="count" id = "cantidad" >
                            <input  type="hidden" name="product" id = "idProducto" >
                            <input  type="hidden" name="valor" id = "totaloculto" >
                            <button type="submit" class="btnpagar">Pagar</button>

          


             </form>


            <br>


	
        <div class="col-md-6 webpay">
                <img src="img/pen.jpg" alt="Webpay">

        </div>

  

    </div>   


</div>












