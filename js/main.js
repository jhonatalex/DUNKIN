

        let subtotalItem= document.querySelector('#subtotal');
        let totalPago = document.querySelector('#totalcompra');


        let montotarjeta = document.querySelector('#monto_tarjeta');
        const labelcantidad = document.querySelector('.labelcantidad');
        let totaloculto = document.querySelector('#totaloculto');

        let cantidad = document.querySelector('#cantidad');
        let idProd = document.querySelector('#idProducto');

        var recipients=document.querySelector('#destinatarios');

        let precioUnitario = '';
        let precioTotal = '';
   
        var contador=0;
       
        let plantillaDestinatario;
    


//Seleccionar elemento AGREGAR
const botonesAgregar = document.querySelectorAll('.btn-add');
botonesAgregar.forEach(boton =>{
        boton.addEventListener('click', e =>{

            let monto = document.getElementById("select_monto").value;
            contador++;
            labelcantidad.innerHTML = `${contador}`;
            cantidad.value=contador;   //CANTIDAD
            montotarjeta.value=monto;  // PRECIO UNITARIO
            totaloculto.value= monto * contador; // TOTAL OCULTO

              // const id = boton.parentElement.parentElement.children[0].value;
            //addItemToCarrito(id);
           

            
                 plantillaDestinatario += `

                                 <h3> DESTINATARIO ${contador} </h3>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Nombre y Apellido del Destinatario" name="nombre_destino_${contador}"
                                        id="nombre">
                                </div>
                                <div class="col-md-8">
                                    <input type="email" placeholder="Email Destinatario" name="email_destino_${contador}" id="email_destino_${contador}">
                                </div>
                                <div class="col-md-8">
                                    <textarea cols="10" rows="1" placeholder="Dedicatoria... Opcional" name="mensaje_${contador}"
                                        id="mensaje"></textarea>
                                    <div class="error errormensaje"></div>
                                </div> 
       
        `;


        recipients.innerHTML = plantillaDestinatario;





    });
});




//Boton Remover un item seleccionando todos los botones
const botonesRemover =document.querySelectorAll('.btn-remove')
botonesRemover.forEach(boton =>{
        boton.addEventListener('click', e =>{
            
            let monto = document.getElementById("select_monto").value;
            contador--;
            const labelcantidad = document.querySelector('.labelcantidad');
            labelcantidad.innerHTML = `${contador}`;
            cantidad.value=contador;   //CANTIDAD
            montotarjeta.value=monto;  // PRECIO UNITARIO
            totaloculto.value= monto * contador; // TOTAL OCULTO

                //const id = boton.parentElement.parentElement.children[0].value;
                //removeItemFromCarrito(id);


                plantillaDestinatario -= `

                    
                <h3> DESTINATARIO ${contador} </h3>
               <div class="col-md-8">
                   <input type="text" placeholder="Nombre y Apellido del Destinatario" name="nombre_destino_${contador}"
                       id="nombre">
               </div>
               <div class="col-md-8">
                   <input type="email" placeholder="Email Destinatario" name="email_destino_${contador}" id="email_destino_${contador}">
               </div>
               <div class="col-md-8">
                   <textarea cols="10" rows="1" placeholder="Dedicatoria... Opcional" name="mensaje_${contador}"
                       id="mensaje"></textarea>
                   <div class="error errormensaje"></div>
               </div> 

            `;


            recipients.innerHTML = plantillaDestinatario;





        });
});







//AGREGAR ELEMENTO
function addItemToCarrito(id){
    fetch('http://localhost/DUNKIN/api/carrito/api-carrito.php?action=add&id=' + id)
    .then(res => res.json())
    .then(data =>{
        console.log(data.status);
        actualizarCarritoUI();
    });
}


//REMOVER ELEMENTO
function removeItemFromCarrito(id){
    fetch('http://localhost/DUNKIN/api/carrito/api-carrito.php?action=remove&id=' + id)
    .then(res => res.json())
    .then(data =>{
        console.log(data.status);
        actualizarCarritoUI();
    });
}


