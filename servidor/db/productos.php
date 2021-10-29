<?php

include __DIR__ . "/conexion.php";

class ModeloProductos {

    private static $TABLA_PRODUCTOS = "producto";

    public static function getProductos() {
        $tabla = self::$TABLA_PRODUCTOS;
        $stmt = Conexion::conectar()->prepare("SELECT * from $tabla");        
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            error_log("bd_error:" . implode(":", $stmt->errorInfo()));
        }
        return null;
    }

}