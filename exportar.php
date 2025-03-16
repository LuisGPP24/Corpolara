<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aps_corpolara";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT `codigo_registro`,`numero_registro`,`cedula_solicitante`,`nombre_solicitante`,`telefono_solicitante`,`tipo_solicitud`,`sub_tipo_solicitud`,`estado_solicitud`,`descripcion_solicitud`,`financiado`,`remitido`,`monto`,`monto_aprobado`,`fecha_registro`,`condicion`,`estatus`,`observacion` FROM `solicitudes`";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="solicitudes.xls"');
    header('Cache-Control: max-age=0');

    
    $columnNames = [];
    while ($fieldInfo = $result->fetch_field()) {
        $columnNames[] = $fieldInfo->name;
    }
    echo implode("\t", $columnNames) . "\n";

    
    while ($row = $result->fetch_assoc()) {
        echo implode("\t", $row) . "\n";
    }
} else {
    echo "0 resultados";
}


$conn->close();
?>