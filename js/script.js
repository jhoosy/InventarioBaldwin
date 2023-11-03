$(document).ready(function() {
    function actualizarContadores() {
      $.ajax({
        url: 'vistas/obtener_valores.php', // Reemplaza con la ruta correcta al archivo PHP
        method: 'GET',
        success: function(data) {
          var valores = JSON.parse(data);
  
          // Actualiza los valores de los contadores en las tarjetas
          $("#usuariosCount").text(valores.usuario || 0);
          $("#categoriasCount").text(valores.categoria || 0);
          $("#productosCount").text(valores.producto || 0);
        },
        error: function(error) {
          console.error("Error al obtener los valores de la base de datos:", error);
        }
      });
    }
  
    // Inicializa la actualización de contadores
    actualizarContadores();
  
    // Actualiza los contadores cada cierto intervalo (por ejemplo, cada 1 minuto)
    setInterval(actualizarContadores, 60000); // 60000 ms = 1 minuto
  });
  
   