<?php
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

// Recibir el array de números desde JavaScript
$numeros = $_POST['numeros'];

// Array para almacenar los números que no están en la tabla
$numeros_no_existen = [];

// Verificar si cada número está en la tabla
foreach ($numeros as $numero) {
    $sql = "SELECT COUNT(*) AS existe FROM colombia WHERE numeros = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $numero);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['existe'] == 0) {
        // El número no está en la tabla, así que lo agregamos al array de números no existentes
        $numeros_no_existen[] = $numero;
    }
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Devolver el array de números depurado como JSON
echo json_encode($numeros_no_existen);
?>
