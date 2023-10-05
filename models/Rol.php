<?php
    class Rol extends Conectar{
        /* TODO: Listar Registros */
        /**
         * Esta función de PHP recupera una lista de roles asociados con una ID de tienda determinada.
         * 
         * @param suc_id El parámetro `suc_id` es un valor entero que representa el ID de una sucursal
         * o ubicación específica. Esta función recupera los roles asociados con esa sucursal o
         * ubicación en particular.
         * 
         * @return una matriz de matrices asociativas que contiene los roles asociados con un suc_id
         * dado (ID de la tienda).
         */
        public function get_rol_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_ROL_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función de PHP recupera un rol en función de su ID de una base de datos mediante un
         * procedimiento almacenado.
         * 
         * @param rol_id El parámetro "rol_id" es una variable que representa el ID de un rol en un
         * sistema o aplicación. Esta función está diseñada para recuperar información sobre un rol
         * específico en función de su ID.
         * 
         * @return una matriz de matrices asociativas que contiene la información de los roles que
         * coinciden con el rol_id dado.
         */
        public function get_rol_x_rol_id($rol_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_ROL_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina un rol de una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param rol_id El parámetro "rol_id" es el ID del rol que debe eliminarse de la base de
         * datos. Esta función es un método de una clase que maneja las operaciones de la base de datos
         * relacionadas con los roles y utiliza un procedimiento almacenado llamado "SP_D_ROL_01" para
         * eliminar el rol con la ID dada.
         */
        public function delete_rol($rol_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_ROL_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        /**
         * Esta función de PHP inserta un nuevo rol en una tabla de base de datos.
         * 
         * @param suc_id Es probable que este parámetro sea un identificador de una sucursal o
         * ubicación comercial específica. Se utiliza para asociar el nuevo rol que se está insertando
         * con una ubicación específica.
         * @param rol_nom Este parámetro representa el nombre del rol que debe insertarse en la base de
         * datos.
         */
        public function insert_rol($suc_id,$rol_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_ROL_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$rol_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        /**
         * Esta función de PHP actualiza un rol en una base de datos mediante el procedimiento
         * almacenado SP_U_ROL_01 con los parámetros rol_id, suc_id y rol_nom.
         * 
         * @param rol_id El ID del rol que debe actualizarse.
         * @param suc_id Es probable que sea una abreviatura de "identificación sucursal" que se
         * refiere a la identificación o identificador de una sucursal o ubicación dentro de una
         * empresa u organización.
         * @param rol_nom Este parámetro representa el nuevo nombre o título que se asignará a un rol o
         * puesto específico en un sistema u organización.
         */
        public function update_rol($rol_id,$suc_id,$rol_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_ROL_01 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$rol_nom);
            $query->execute();
        }

        /* TODO: Validar acceso ROL */
        /**
         * Esta función de PHP valida el acceso a un elemento de menú en función de la ID de usuario y
         * el identificador de menú.
         * 
         * @param usu_id Este parámetro es probablemente un identificador para un usuario en un
         * sistema. Se utiliza en la consulta SQL para recuperar información sobre el acceso del
         * usuario a un elemento de menú específico.
         * @param men_identi Este parámetro representa el identificador de una opción de menú. Se
         * utiliza en un procedimiento almacenado para validar si un usuario tiene acceso a una opción
         * de menú específica según su rol.
         * 
         * @return el resultado de la consulta ejecutada en la base de datos, que es una matriz de
         * matrices asociativas con los datos recuperados de la base de datos.
         */
        public function validar_acceso_rol($usu_id,$men_identi){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_MENU_03 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$usu_id);
            $query->bindValue(2,$men_identi);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
