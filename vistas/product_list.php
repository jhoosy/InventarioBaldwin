<div class="container is-fluid mb-6">
    <h1 class="title">Equipos</h1>
    <h2 class="subtitle">Lista de equipos</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        # Eliminar producto #
        if(isset($_GET['product_id_del'])){
            require_once "./php/producto_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=product_list&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador producto #
        require_once "./php/producto_lista.php";
    ?>
</div>

<script>
    // Agrega un evento para mostrar una ventana emergente de confirmación antes de eliminar un producto.
    var eliminarBotones = document.querySelectorAll('.button.is-danger.is-rounded.is-small');
    eliminarBotones.forEach(function(boton) {
        boton.addEventListener('click', function(event) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este producto?");
            if (!confirmacion) {
                event.preventDefault(); // Evita la acción predeterminada (eliminación) si se cancela la confirmación.
            }
        });
    });
</script>
