<div class="container is-fluid mb-6">
	<h1 class="title">Área</h1>
	<h2 class="subtitle">Nuevo Área</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/categoria_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="categoria_nombre"  maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Ubicación</label>
				  	<input class="input" type="text" name="categoria_ubicacion"  maxlength="150" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>