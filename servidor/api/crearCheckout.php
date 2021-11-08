<?php

include __DIR__ . '/../db/productos.php';

if (!isset($_POST["producto"]) || empty($_POST["producto"])) {
    http_response_code(400);
    exit;
}

$idProducto = $_POST["producto"];

$producto = ModeloProductos::getProductoById($idProducto);

if ($producto == null) {
    http_response_code(401);
    exit;
}

