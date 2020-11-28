<div class="articulo">
    <input type="hidden" id="id" value="<?php echo $item['id'];  ?>">
    <div class="imagen"><img src="img/<?php echo $item['imagen'];  ?>" /></div>
    <div class="titulo"><?php echo $item['descripcion'];  ?></div>
    <div class="precio">$<?php echo $item['monto'];  ?> CLP</div>
    <div class="botones">
        <button class='btn-add'>Agregar</button>
        <button class='btn-remove'>Eliminar</button>
    </div>
</div>