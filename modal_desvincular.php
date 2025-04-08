<!-- filepath: c:\xampp\htdocs\nuevo\modal_desvincular.php -->
<div class="modal fade" id="desvincularModal_<?php echo $contacto['id']; ?>" tabindex="-1" aria-labelledby="desvincularModalLabel_<?php echo $contacto['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="desvincularModalLabel_<?php echo $contacto['id']; ?>">Confirmar Desvinculación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas desvincular a <strong><?php echo $contacto['nombre']; ?></strong> de esta empresa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="modificaciones_contacto.php?id_empresa=<?php echo $id; ?>&id_contacto=<?php echo $contacto['id']; ?>&borrar=true" class="btn btn-danger"> Eliminar</a>
            </div>
        </div>
    </div>
</div>
  
