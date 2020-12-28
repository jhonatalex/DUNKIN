
    <p><h2 class="textRegalar">Cuantas giftcard deseas regalar:</h2></p>

<div class="articulo">
    <input type="hidden" id="id" value="<?php echo $item['id'];  ?>">
    <div class="titulo"><?php echo $item['cod_promocion'];  ?></div>
    <div class="precio">$<?php echo $item['monto'];  ?> CLP</div>
    <div class="botones">
        <button class='btn-remove'>Eliminar</button>
        <label class='labelcantidad'>0</label>
        <button class='btn-add'>Agregar</button>
    </div>
</div>