<?php

include __DIR__ . '/../db/productos.php';
include __DIR__ . '/../stripe.php';

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

$checkout = $stripe->checkout->sessions->create([
  'success_url' => 'https://example.com/success',
  'cancel_url' => 'https://example.com/cancel',
  'payment_method_types' => ['card', 'oxxo'],
  'line_items' => [
    [
      'amount' => $producto["precio"],
      'currency' => 'MXN',
      'description' => $producto["descripcion"],
      'images' => [$producto["foto"]],
      'name' => $producto["nombre"],
      'quantity' => 1
    ]
    ],
  'mode' => 'payment',
]);

$respuesta = [
    'id' => $checkout->id
];

header('Content-Type: application/json');
echo json_encode($respuesta);
