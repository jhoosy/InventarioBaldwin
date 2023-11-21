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

require '../vendor/autoload.php'; // LIBRERIA DOMPDF - MI PDF

use Dompdf\Dompdf;
use Dompdf\Options;

// 
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set(array('isRemoteEnabled'=> true));
$dompdf = new Dompdf($options);

// Información del informe
$titulo = 'INVENTARIO';
$nameEmpresa = 'JAMES BALDWIN S.A.C';
$ruc = '20606849983';
$lugar= 'Jr. Huancané 520, Juliaca 21101';
$fechaInforme = date('d/m/Y'); // Puedes ajustar el formato según tus preferencias
// Contenido de mi PDF
$html = '<html><body>';
$html .= '<h2 style="text-align: center; color: black">'.$titulo.'</h2>';
$html .= '<h4 style="text-align: left;">'.$nameEmpresa.'</h4>';
$html .= '<p style="text-align: left;">RUC: '.$ruc.'</p>';
$html .= '<p style="text-align: left;">'.$lugar.'</p>';

$html .= '<p style="text-align: right;margin-top: -80px;">'.$fechaInforme.'</p>';


$html .= '<div style="position: absolute; top: 0; right: 0; margin: 10px;">';
$html .= '<img src="https://baldwin.edu.pe/wp-content/uploads/2020/10/LOGO-ESCUDO-BALDWIN-PNG-1-150x150.png" alt="Imagen remota" style="width: 80px; opacity: 0.5;">';
$html .= '</div>';


$html .= '<table style="border-collapse: collapse; width: 100%;">';

$html .= '<thead>';
$html .= '<tr style="background-color: #166416">';
$html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; color: #E2F0E2;">Codigo:</th>';
$html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; color: #E2F0E2;">Marca:</th>';
$html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; color: #E2F0E2;">Descripcion:</th>';
$html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; color: #E2F0E2;">Cantidad:</th>';
$html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; color: #E2F0E2;">Estado:</th>';
$html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; color: #E2F0E2;">Observaciones:</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

// Resultado de mis Consultas
while ($fila = $resultado->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_codigo'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_marca'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_descripcion'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_cantidad'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_estado'] . '</td>';
    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $fila['producto_observaciones'] . '</td>';
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
?>

