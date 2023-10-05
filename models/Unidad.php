<?php
    class Unidad extends Conectar{
        /* TODO: Listar Registros */
        /**
         * Esta función de PHP recupera una lista de unidades en función de un ID de tienda
         * determinado.
         * 
         * @param suc_id Este parámetro es una variable que representa el ID de una sucursal o
         * ubicación específica. Se utiliza como parámetro de entrada para el procedimiento almacenado
         * "SP_L_UNIDAD_01" para recuperar una lista de unidades o departamentos asociados con esa
         * sucursal o ubicación.
         * 
         * @return una matriz de matrices asociativas que contiene los datos de las unidades asociadas
         * con una ID de tienda dada.
         */
        public function get_unidad_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_UNIDAD_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función de PHP recupera la información de una unidad en función de su ID.
         * 
         * @param und_id Este es un parámetro que representa el ID de una unidad (por ejemplo, una
         * unidad de medida, una unidad de departamento, etc.) que se consulta en una base de datos. La
         * función `get_unidad_x_und_id` toma este parámetro como entrada y devuelve información sobre
         * la unidad con el ID especificado.
         * 
         * @return una matriz de matrices asociativas que contiene la información de una unidad
         * (unidad) en función de su ID (und_id).
         */
        public function get_unidad_x_und_id($und_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_UNIDAD_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$und_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina una unidad de una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param und_id Este es un parámetro que representa el ID de la unidad que debe eliminarse de
         * la base de datos. La función utiliza este parámetro para llamar a un procedimiento
         * almacenado denominado "SP_D_UNIDAD_01" que se encarga de eliminar la unidad de la base de
         * datos.
         */
        public function delete_unidad($und_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_UNIDAD_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$und_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
       /**
        * Esta función de PHP inserta una nueva unidad en una tabla de base de datos con un nombre dado
        * y asociada con una ID de tienda específica.
        * 
        * @param suc_id Este parámetro es probablemente una identificación o código que identifica una
        * ubicación o sucursal específica de una empresa u organización. Se está utilizando como
        * parámetro para insertar una nueva unidad o departamento en una ubicación específica.
        * @param und_nom Este parámetro representa el nombre de la unidad que debe insertarse en la
        * base de datos.
        */
        public function insert_unidad($suc_id,$und_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_UNIDAD_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$und_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
       /**
        * Esta función de PHP actualiza la información de una unidad en una base de datos utilizando un
        * procedimiento almacenado.
        * 
        * @param und_id El ID de la unidad que necesita ser actualizada.
        * @param suc_id El parámetro "suc_id" es probablemente una abreviatura de "sucursal_id" que se
        * refiere al ID de la sucursal o ubicación donde se encuentra la unidad.
        * @param und_nom Este parámetro representa el nombre actualizado de una unidad (unidad en
        * español) que necesita ser actualizado en una base de datos.
        */
        public function update_unidad($und_id,$suc_id,$und_nom){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_UNIDAD_01 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$und_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$und_nom);
            $query->execute();
        }
    }
