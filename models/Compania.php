<?php
    class Compania extends Conectar{
        /* TODO: Listar Registros */
        /**
         * Esta función de PHP recupera datos de una tabla de base de datos llamada "compañía" usando
         * un procedimiento almacenado.
         * 
         * @return el resultado de una consulta SQL que recupera todas las filas de una tabla o vista
         * llamada "compañía" usando un procedimiento almacenado llamado "SP_L_COMPANIA_01". El
         * resultado se devuelve como una matriz asociativa utilizando el método fetchAll() del objeto
         * PDOStatement.
         */
        public function get_compania(){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPANIA_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
       /**
        * Esta función de PHP recupera información de la empresa en función de una identificación de
        * empresa dada.
        * 
        * @param com_id Este es un parámetro que representa el ID de una empresa. Se utiliza en una
        * consulta de base de datos para recuperar información sobre una empresa con el ID
        * especificado.
        * 
        * @return una matriz de matrices asociativas que contiene información sobre una empresa con el
        * ID de empresa dado.
        */
        public function get_compania_x_com_id($com_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPANIA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$com_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina una empresa de una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param com_id El parámetro "com_id" es una variable que representa el ID de la empresa que
         * debe eliminarse de la base de datos. Esta función es un código PHP que se conecta a una base
         * de datos, llama a un procedimiento almacenado llamado "SP_D_COMPANIA_01" y pasa el parámetro
         * "com_id" a
         */
        public function delete_compania($com_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_COMPANIA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$com_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        /**
         * Esta función de PHP inserta una nueva empresa en una base de datos utilizando un
         * procedimiento almacenado.
         * 
         * @param com_nom Este parámetro representa el nombre de una empresa que debe insertarse en una
         * tabla de base de datos mediante un procedimiento almacenado denominado "SP_I_COMPANIA_01".
         */
        public function insert_compania($com_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_COMPANIA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$com_nom);
            $query->execute();
        }

        /**
         * La función actualiza el nombre de una empresa en una base de datos usando su ID.
         * 
         * @param com_id El ID de la empresa que necesita ser actualizado en la base de datos.
         * @param com_nom Este parámetro representa el nombre actualizado de una empresa que debe
         * actualizarse en la base de datos.
         */
        /* TODO:Actualizar Datos */
        public function update_compania($com_id,$com_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_COMPANIA_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$com_id);
            $query->bindValue(2,$com_nom);
            $query->execute();
        }
    }
