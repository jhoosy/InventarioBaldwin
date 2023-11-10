<div class="container is-fluid mb-6">
	<h1 class="title">Equipos</h1>
	<h2 class="subtitle">Nuevo equipo</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/producto_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
  <div class="form-column">
    <div class="form-control">
      <label>Código de barras</label>
      <input class="inputBarra" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required>
    </div>
  </div>

  <div class="form-column">
    <div class="form-control">
      <label>Marca</label>
      <input class="inputMarca" type="text" name="producto_marca" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="30" required>
    </div>
  </div>

  <div class="form-column">
    <div class="form-control">
      <label>Descripcion</label>
      <input class="inputDesc" type="text" name="producto_descripcion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="100" required>
    </div>
  </div>

  <div class="form-column">
    <div class="form-control">
      <label>Cantidad</label>
      <input class="inputCan" type="text" name="producto_cantidad" pattern="[0-9]{1,25}" maxlength="25" required>
    </div>
  </div>

  <div class="form-column">
    <div class="form-control">
      <label>Estado</label>
      <select class="inputEsta" name="producto_estado" required>
        <option value="opcion1">Bueno (B)</option>
        <option value="opcion2">Regular (R)</option>
        <option value="opcion3">Malo (M)</option>
      </select>
    </div>
  </div>

  <div class="form-column">
    <label>Categoría</label><br>
    <div class="select is-rounded">
      <select name="producto_categoria">
        <option value="" selected>Seleccione una opción</option>
        <?php
        $categorias = conexion();
        $categorias = $categorias->query("SELECT * FROM categoria");
        if ($categorias->rowCount() > 0) {
          $categorias = $categorias->fetchAll();
          foreach ($categorias as $row) {
            echo '<option value="' . $row['categoria_id'] . '">' . $row['categoria_nombre'] . '</option>';
          }
        }
        $categorias = null;
        ?>
      </select>
    </div>
  </div>

  <div class="form-column">
    <div class="form-control">
      <label>Observaciones</label>
      <input class="inputObse" type="text" name="producto_observaciones" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="100" required>
    </div>
  </div>

  <div class="form-column">
    <label>Agregar Imagen del Equipo</label><br>
    <div class="file is-small has-name">
      <label class="file-label">
        <input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg">
        <span class="file-cta">
          <span class="file-label">Presione aqui!</span>
        </span>
        <span class="file-name"></span>
      </label>
    </div>
  </div>

  <p class="has-text-centered">
    <button type="submit" class="btnGuardar">Guardar</button>
  </p>
 </form>
</div>