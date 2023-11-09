<?php
// Conéctate a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datab";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Realiza consultas SQL para obtener los valores
$result = $conn->query("SELECT COUNT(*) AS usuario FROM usuario");
$row = $result->fetch_assoc();
$usuario = $row['usuario'];

$result = $conn->query("SELECT COUNT(*) AS categoria FROM categoria");
$row = $result->fetch_assoc();
$categoria = $row['categoria'];

$result = $conn->query("SELECT COUNT(*) AS producto FROM producto");
$row = $result->fetch_assoc();
$producto = $row['producto'];



// Cierra la conexión a la base de datos
$conn->close();

// Crea un array asociativo con los valores
$valores = array(
    'usuario' => $usuario , 
    'categoria' => $categoria ,
    'producto' => $producto 
);

// Devuelve los valores en formato JSON
echo json_encode($valores);

?>

