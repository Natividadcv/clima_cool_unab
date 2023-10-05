<?php
    class Pago extends Conectar{
        /* TODO: Listar Registros */
       /**
        * Esta función de PHP recupera información de pago de una base de datos utilizando un
        * procedimiento almacenado.
        * 
        * @return una matriz de matrices asociativas que contiene los resultados de ejecutar el
        * procedimiento almacenado "SP_L_PAGO_01".
        */
        public function get_pago(){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PAGO_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

    }
