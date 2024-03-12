<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
   // Datos de conexión a la base de datos
$servername = "localhost";
$username = "u926586104_typedNums";
$password = "estoesunaclave123A!";
$dbname = "u926586104_typedNums";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Números de teléfono proporcionados desde JavaScript
$numeros = [];

$longitud = count($numeros);
if($longitud == 0){$conn->close();}

// Preparar la consulta SQL para inserción
$sql = "INSERT INTO colombia (numeros) VALUES (?)";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Bucle para insertar cada número de teléfono
foreach ($numeros as $numero) {
    // Vincular parámetro
    $stmt->bind_param("s", $numero);
    
    // Ejecutar la consulta
    if ($stmt->execute() === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }
}

echo "Los números de teléfono se han insertado correctamente.";

// Cerrar la conexión
$stmt->close();
$conn->close();
}
