<?php

class Conexion {

    public static function conectar() {

        $host = "localhost";
        $port = 3306;
        $dbName = "stripe-demo";
        $user = "demo";
        $password = "demo";
        $options = [
            PDO::MYSQL_ATTR_FOUND_ROWS => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];

        return new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password, $options);
    }
}