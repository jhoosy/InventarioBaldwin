<?php

// Ejemplo usando MySQLi
$conexion = new mysqli("localhost", "root", "", "datab");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// --------------------------------------------------------//




$query = "SELECT producto.*, categoria.categoria_nombre AS categoria_nombre
          FROM producto 
          INNER JOIN categoria ON producto.categoria_id = categoria.categoria_id";



$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

//----------------------------------------------------------//

require '../vendor/autoload.php'; // Asegúrate de cargar DOMPDF

use Dompdf\Dompdf;
use Dompdf\Options;

// Crear una instancia de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set(array('isRemoteEnabled'=> true));
$dompdf = new Dompdf($options);

// Contenido HTML para el PDF
$html = '<html><body>';// Ajusta la ruta y estilos del logo
$html .= '<h1 style="text-align: center;">Lista de Equipos</h1>';
$html .= '<img src="https://baldwin.edu.pe/wp-content/uploads/2020/10/LOGO-ESCUDO-BALDWIN-PNG-1-150x150.png" alt="Imagen remota" style="width: 80px; opacity: 0.5; margin-top: -80px;"><br><br>';
$html .= '<table style="border-collapse: collapse; width: 100%;">



            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Codigo:</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Marca:</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Descripcion:</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Cantidad:</th>
                    <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Categoria</th>
                </tr>
            </thead>
            <tbody>';

            

// Iterar sobre los resultados de la consulta
while ($fila = $resultado->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_codigo'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_marca'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_descripcion'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_cantidad'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['categoria_nombre'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';
$html .= '</body></html>';

$dompdf->loadHtml($html);

// (Opcional) Configuración adicional del PDF

// Renderizar el PDF (salida a pantalla o archivo)
$dompdf->render();
$dompdf->stream('Inventario.pdf'); // Salida a pantalla
// $dompdf->output(); // Salida a archivo (puedes guardar el archivo en el servidor)

// Cerrar la conexión a la base de datos
$conexion->close();
