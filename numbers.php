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

    // Iterar sobre el array e insertar cada número en la tabla
    foreach ($phoneNumbers as $phoneNumber) {
        // Escapar el número para evitar inyección SQL
        $phoneNumber = $conn->real_escape_string($phoneNumber);
        
        // Query para insertar el número en la tabla
        $sql = "INSERT INTO phones (digits) VALUES ('$phoneNumber')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Número de teléfono insertado correctamente: $phoneNumber <br>";
        } else {
            echo "Error al insertar el número de teléfono: " . $conn->error . "<br>";
        }
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "Método inválido";
}


