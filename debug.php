<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "u926586104_phonenumbers";
    $password = "passwordForphonenumbers_asD!0";
    $dbname = "u926586104_phonenumbers";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el array de números de teléfono enviado desde JavaScript
    $phoneNumbers = $_POST['phoneNumbers'];

    // Crear una cadena de placeholders para los números de teléfono
    $placeholders = rtrim(str_repeat('?,', count($phoneNumbers)), ',');

    // Query para seleccionar los números que ya están en la tabla
    $sql = "SELECT digits FROM phones WHERE digits IN ($placeholders)";
    $stmt = $conn->prepare($sql);

    // Unir los parámetros para la consulta preparada
    $types = str_repeat('s', count($phoneNumbers));
    $stmt->bind_param($types, ...$phoneNumbers);
    $stmt->execute();

    // Obtener los números ya existentes en la tabla
    $existingNumbers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $existingNumbers = array_column($existingNumbers, 'digits');

    // Filtrar los números recibidos para eliminar los que ya están en la tabla
    $newNumbers = array_diff($phoneNumbers, $existingNumbers);

    // Devolver el arreglo filtrado de números
    echo json_encode($newNumbers);

    // Cerrar conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Método inválido";
}


