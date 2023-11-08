<div class="container is-fluid">
	<h1 class="title">Home</h1>
	<h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h2>


  <!--AGEGUE EL CONTADOR DE DASHBOARD -->
	<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="estilos.css">

</head>
<body>
  <div class="container-fluid">
    <div class="row" style="display: flex; flex-wrap: wrap;">
      <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><span id="usuariosCount">0</span></h3>
            <h4>USUARIOS</h4>
          </div>
          <div class="icon">
            <i class="ion ion-podium"></i>
          </div>
        </div>
      </div>
 
      <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><span id="categoriasCount">0</span></h3>
            <h4>CATEGORIAS</h4>
          </div>
          <div class="icon">
            <i class="ion ion-podium"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3 span id="productosCount">0</h3>
            <h4>EQUIPOS</h4>
          </div>
          <div class="icon">
            <i class="ion ion-briefcase"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Agrega jQuery para actualizar los contadores -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>