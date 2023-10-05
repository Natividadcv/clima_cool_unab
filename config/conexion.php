<?php
/* TODO: Inicio de Session */
session_start();
class Conectar
{
  protected $dbh;

  protected function Conexion()
  {
    try {
      
      /* TODO: Cadena de Conexion */
  
      /* Este código está creando un nuevo objeto PDO para establecer una conexión a una base de datos
      MySQL con los siguientes parámetros: */
      $conectar = $this->dbh = new PDO("mysql:host=localhost;port=3310;dbname=clima_cool", "root", "");
      //$conectar->exec("set names utf8");


      return $conectar;
    } catch (Exception $e) {
      /* TODO: En caso de error mostrar mensaje */
      print "Error Conexion BD " . $e->getMessage() . "<br/>";
      die();
    }
  }

public static function ruta()
{
  $host = $_SERVER['HTTP_HOST'];
  $uri = $_SERVER['REQUEST_URI'];

  /* Verificar si la ruta actual es localhost */
  if($host == 'localhost') {
    return "http://localhost/clima/";
  } else {
    $ip_address = $_SERVER['SERVER_ADDR'];
   
    return "http://$ip_address/clima/";
  }
}



}

