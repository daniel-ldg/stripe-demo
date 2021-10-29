<?php

include __DIR__ . "/../db/productos.php";

header('Content-Type: application/json');
echo json_encode(ModeloProductos::getProductos());