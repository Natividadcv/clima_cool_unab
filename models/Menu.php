<?php
    class Menu extends Conectar{
        /* TODO: Listar Registros */
       /**
        * Esta función de PHP recupera un menú basado en una ID de rol determinada.
        * 
        * @param rol_id El parámetro "rol_id" es una variable que representa el ID de un rol en un
        * sistema. Esta función se utiliza para recuperar un menú en función del ID de función
        * proporcionado.
        * 
        * @return una matriz de elementos de menú que están asociados con un ID de rol específico. Los
        * elementos del menú se obtienen de la base de datos mediante un procedimiento almacenado
        * denominado "SP_L_MENU_01" y el ID de función se pasa como parámetro al procedimiento
        * almacenado.
        */
        public function get_menu_x_rol_id($rol_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_MENU_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Registrar el detalle automaticamente que no tiene el Menu */
       /**
        * Esta función de PHP inserta detalles de menú para una ID de función específica en una base de
        * datos mediante un procedimiento almacenado.
        * 
        * @param rol_id El parámetro "rol_id" es una variable que representa el ID de un rol en un
        * sistema. Esta función se utiliza para insertar detalles de menú para una ID de función
        * específica.
        * 
        * @return una matriz de matrices asociativas que representan el conjunto de resultados de la
        * consulta SQL ejecutada.
        */
        public function insert_menu_detalle_x_rol_id($rol_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_MENU_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Habilitar permiso al rol */
        /**
         * Esta función de PHP actualiza el estado de un elemento de menú a habilitado.
         * 
         * @param mend_id Es un parámetro que representa el ID de un elemento de menú que debe
         * actualizarse para habilitarlo.
         * 
         * @return el resultado de la ejecución de la consulta, que es una matriz de matrices
         * asociativas que contienen los datos obtenidos de la base de datos.
         */
        public function update_menu_habilitar($mend_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_MENU_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mend_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Deshabilitar permiso al rol */
       /**
        * Esta función de PHP actualiza un elemento del menú deshabilitándolo en la base de datos.
        * 
        * @param mend_id El parámetro "mend_id" es probablemente un identificador o clave principal
        * para un elemento de menú específico en una base de datos. Es probable que esta función se use
        * para actualizar el estado de un elemento de menú a "deshabilitado" en la base de datos
        * llamando a un procedimiento almacenado denominado "SP_U_MENU_02".
        * 
        * @return el resultado de la consulta ejecutada como una matriz de matrices asociativas.
        */
        public function update_menu_deshabilitar($mend_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_MENU_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mend_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

    }
