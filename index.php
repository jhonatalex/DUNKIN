<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">

  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</head>
<body>
    <?php
        include_once('layout/menu.php');

    ?>

    <main>

    <div class="imagenCard"> 
      <img src="./img/veinteP.png" alt="giftcard">
  
    </div> 

    <p><h2 class="textoMonto">Elige el monto que quieres regalar:</h2></p>
    <select class="select-css" id="select_monto" onchange=" <?php     ?>">
            <option value ="0">Selecciona una opción</option>

            <option value="5000">5000</option>
            <option value="10000">10000</option>
            <option value="20000">20000</option>
            <option value="30000">30000</option>   
            <option value="40000">40000</option>
            <option value="50000">50000</option>
    </select>


             <?php
            
                   // SOLICITUD A MI API
                //$response = json_decode(file_get_contents('http://localhost//DUNKIN/api/productos/api-productos.php?monto=5000'), true);
                  
                     
               ?>
           
                <p><h2 class="textRegalar">Cuantas giftcard deseas regalar:</h2></p>
                <div class="articulo">
                    <div class="botones">
                        <button class='btn-remove'>Eliminar</button>
                        <label class='labelcantidad'>0</label>
                        <button class='btn-add'>Agregar</button>
                    </div>
                </div>
    
 

    <?php
       include_once('layout/resumenPago.php');
    ?>


<div class="footer"></div>

</main>

    <script src="js/main.js"></script>



</body>

 </html>   

           


