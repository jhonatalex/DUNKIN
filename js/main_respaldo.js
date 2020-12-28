

document.addEventListener('DOMContentLoaded', event =>{
    
    //* cookies para evitar hace runa consulta a base datos y tener actualizado el carrito

    const cookies = null;
    let cookie = null;
    cookies.forEach(item =>{
        if(item.indexOf('items') > -1){
            cookie = item;
        }
    });

    /*if(cookie != null){
        const count = cookie.split('=')[1];
        console.log(count);
        document.querySelector('.btn-carrito').innerHTML = `(${count}) Carrito`;
    }*/
});



const bCarrito = document.querySelector('.btn-carrito');
bCarrito.addEventListener('click', event =>{

    const carritoContainer = document.querySelector('#carrito-container');


    //DESPELGAR LA VISTA
    if(carritoContainer.style.display == ''){
        carritoContainer.style.display = 'block';
        actualizarCarritoUI();
    }else{
        carritoContainer.style.display = '';
    }
});

function actualizarCarritoUI(){
    fetch('http://localhost/DUNKIN/api/carrito/api-carrito.php?action=mostrar')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        let tablaCont = document.querySelector('#tabla');
        let montotarjeta = document.querySelector('#monto_tarjeta');
        let subtotalItem= document.querySelector('#subtotal');
        let totalPago = document.querySelector('#totalcompra');
        let totaloculto = document.querySelector('#totaloculto');

        let cantidad = document.querySelector('#cantidad');
        let idProd = document.querySelector('#idProducto');
        let precioUnitario = '';
        let precioTotal = '';
   
        let html = '';
        let html2 = '';
        let cant=0;
        let id='';

        data.items.forEach(element =>{
            html += `
                <div class='fila'>
                    <div class='imagen'>
                        <img src='img/cincoP.png' width='100' />
                    </div>

                    <div class='info'>
                        <input type='hidden' value='${element.id}' />
                        <div class='nombre'>${element.cod_promocion}</div>
                        <div>${element.cantidad} items de $${element.monto} CLP</div>
                        <div>Subtotal: $${element.subtotal} CLP </div>
                        
                    </div>
                </div>
            `;

            html2 += `
                    <div>${element.cantidad} items de $${element.monto} CLP   Subtotal: $${element.subtotal} CLP </div>
                    `;
            
            
             precioUnitario =element.monto
             cant+= element.cantidad;
             id=element.id;    
        });



        precioTotal = `<p class='mail'>Total: $${data.info.total} CLP </p>`;
       // precioTotal = `<input type="hidden" name="mtotal" value= ${data.info.total}>`

        tablaCont.innerHTML = precioTotal + html; // AGREGA EL TOTAL Y EL CONTENDIDO
        subtotalItem.innerHTML=html2; // DESGLOCE DE LA CANTIDAD
        
        totalPago.innerHTML= precioTotal; //TOTAL DE LA COMPRA
     

        //cantidad.value=cant;
        cantidad.value=data.info.count 
        idProd.value=id;     
        montotarjeta.value=precioUnitario;  // PRECIO UNITARIO
        totaloculto.value=data.info.total; // TOTAL OCULTO



        //actulalizo el texto del boton dinamicamente
        document.cookie = `items=${data.info.count}`;
        bCarrito.innerHTML = `(${data.info.count}) Carrito`;


      

        
    });
}



var contador=0;



//Boton Remover un item seleccionando todos los botones
const botonesRemover =document.querySelectorAll('.btn-remove')
botonesRemover.forEach(boton =>{
        boton.addEventListener('click', e =>{
            
            contador--;
            const labelcantidad = document.querySelector('.labelcantidad');
            labelcantidad.innerHTML = `${contador}`;


                //const id = boton.parentElement.parentElement.children[0].value;
                //removeItemFromCarrito(id);
        });
});


//Seleccionar elemento AGREGAR
const botonesAgregar = document.querySelectorAll('.btn-add');
botonesAgregar.forEach(boton =>{
        boton.addEventListener('click', e =>{

            let totaloculto = document.querySelector('#totaloculto');
            let monto = document.getElementById("select_monto").value;
            
            
           
            contador++;
            const labelcantidad = document.querySelector('.labelcantidad');
            labelcantidad.innerHTML = `${contador}`;

            totaloculto.value= monto * contador; // TOTAL OCULTO

              // const id = boton.parentElement.parentElement.children[0].value;
            //addItemToCarrito(id);
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


