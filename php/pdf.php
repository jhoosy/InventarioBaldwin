<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Crea una instancia de Dompdf
$dompdf = new Dompdf\Dompdf();

// Carga contenido HTML en Dompdf
$html = '<html><body><h1>Mi primer PDF con Dompdf</h1></body></html>';
$dompdf->loadHtml($html);

// Renderiza el PDF
$dompdf->render();

// Guarda el PDF en un archivo
$dompdf->stream('mi_pdf.pdf');
