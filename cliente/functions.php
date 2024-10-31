<?php
require_once __DIR__ . '/../config/database.php';
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));

}

function formatDate($date) {
    return $date->toDateTime()->format('Y-m-d');
}

function crearPocesos($nombre, $correo, $telefono, $direccion) {
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'nombre' => sanitizeInput($nombre),
        'correo' => sanitizeInput($correo),
        'telefono' => sanitizeInput($telefono),
        'direccion' => sanitizeInput($direccion),
        
    ]);
    return $resultado->getInsertedId();
}

function obtenerProcesos() {
    global $tasksCollection;
    return $tasksCollection->find();
}

function obtenerProcesosPorId($_id) {
    global $tasksCollection;
    return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($_id)]);
}

function actualizarProcesos($_id, $nombre, $correo, $telefono, $direccion) {
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($_id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'correo' => sanitizeInput($correo),
            'telefono' => sanitizeInput($telefono),
            'direccion' => sanitizeInput($direccion),
        ]]
    );
    return $resultado->getModifiedCount();
}

function eliminarProcesos($_id) {
    global $tasksCollection;
    $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($_id)]);
    return $resultado->getDeletedCount();
}



