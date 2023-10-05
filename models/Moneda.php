<?php
    class Moneda extends Conectar{
        /* TODO: Listar Registros */
        /**
         * Esta función de PHP recupera información de moneda basada en una identificación de tienda
         * determinada.
         * 
         * @param suc_id El parámetro `suc_id` es un valor entero que representa el ID de una sucursal
         * o ubicación específica. Esta función recupera información sobre la moneda utilizada por esa
         * sucursal o ubicación.
         * 
         * @return una matriz de matrices asociativas que contienen información sobre la moneda
         * asociada con una ID de tienda dada.
         */
        public function get_moneda_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_MONEDA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función de PHP recupera información de moneda basada en una identificación de moneda
         * determinada.
         * 
         * @param mon_id El parámetro `mon_id` es un parámetro de entrada de la función
         * `get_moneda_x_mon_id`. Se utiliza para recuperar información sobre una moneda específica
         * (moneda) en función de su ID (mon_id). La función ejecuta un procedimiento almacenado
         * `SP_L_MONEDA_02` con el `
         * 
         * @return una matriz de matrices asociativas que contienen información sobre una moneda
         * (moneda) en función del ID de moneda proporcionado (mon_id).
         */
        public function get_moneda_x_mon_id($mon_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_MONEDA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mon_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina una moneda de una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param mon_id El parámetro "mon_id" es una variable que representa el ID de la moneda que
         * debe eliminarse de la base de datos. Esta función es un código PHP que se conecta a una base
         * de datos, llama a un procedimiento almacenado llamado "SP_D_MONEDA_01" y le pasa el
         * parámetro "mon_id".
         */
        public function delete_moneda($mon_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_MONEDA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mon_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
       /**
        * Esta función de PHP inserta una nueva moneda en una tabla de base de datos.
        * 
        * @param suc_id Es probable que este parámetro sea un identificador de una sucursal o ubicación
        * específica dentro de una empresa u organización. Se usa como entrada para el procedimiento
        * almacenado SP_I_MONEDA_01 para insertar un nuevo registro de moneda (moneda) asociado con la
        * sucursal especificada.
        * @param mon_nom Este parámetro representa el nombre de la moneda que debe insertarse en la
        * base de datos.
        */
        public function insert_moneda($suc_id,$mon_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_MONEDA_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$mon_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        /**
         * Esta función de PHP actualiza un registro de moneda en una base de datos utilizando el
         * procedimiento almacenado SP_U_MONEDA_01.
         * 
         * @param mon_id El ID de la moneda que se va a actualizar.
         * @param suc_id El parámetro "suc_id" es probablemente una abreviatura de "sucursal_id", que
         * significa "branch_id" en inglés. Probablemente sea un identificador de una sucursal o
         * ubicación específica dentro de una empresa u organización.
         * @param mon_nom Este parámetro representa el nuevo nombre que se le asignará a una moneda en
         * una tabla de base de datos.
         */
        public function update_moneda($mon_id,$suc_id,$mon_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_MONEDA_01 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mon_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$mon_nom);
            $query->execute();
        }
    }
