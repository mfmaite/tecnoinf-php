<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMenuModalLabel">Nuevo menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="sections/menu/save.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="menu-name" class="col-form-label">Nombre del menú:</label>
            <input type="text" class="form-control" id="menu-name" name="name" required>
          </div>
          <div class="form-group">
            <label for="menu-price" class="col-form-label">Precio del menú:</label>
            <input type="number" class="form-control" id="menu-price" name="price" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="menu-photo" class="col-form-label">Foto del menú:</label>
            <input type="file" class="form-control-file" id="menu-photo" name="photo" accept="image/*" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
