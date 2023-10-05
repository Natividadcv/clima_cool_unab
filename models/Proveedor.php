<?php
    class Proveedor extends Conectar{
        /* TODO: Listar Registros */
       /**
        * Esta función de PHP recupera una lista de proveedores basada en una identificación de empresa
        * determinada.
        * 
        * @param emp_id El parámetro "emp_id" es una variable que representa el ID de una empresa. Esta
        * función se utiliza para recuperar información sobre un proveedor en función del ID de la
        * empresa con la que está asociado.
        * 
        * @return una matriz de matrices asociativas que contienen información sobre los proveedores
        * asociados con una identificación de empresa determinada.
        */
        public function get_proveedor_x_emp_id($emp_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PROVEEDOR_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función de PHP recupera la información de un proveedor en función de su ID.
         * 
         * @param prov_id El parámetro "prov_id" es una variable que representa el ID de un proveedor
         * específico. Esta función se utiliza para recuperar información sobre un proveedor en función
         * de su ID.
         * 
         * @return una matriz de matrices asociativas que contiene la información de un único proveedor
         * identificado por el parámetro ``.
         */
        public function get_proveedor_x_prov_id($prov_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PROVEEDOR_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prov_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina un proveedor de una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param prov_id El parámetro "prov_id" es una variable que representa el ID del proveedor que debe
         * eliminarse de la base de datos. Esta función es un método de una clase que extiende una clase padre
         * "Conexion" que maneja la conexión a la base de datos. La función ejecuta un procedimiento almacenado
         * "SP_D_PROVEEDOR
         */
        public function delete_proveedor($prov_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_PROVEEDOR_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prov_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        /**
         * Esta función inserta un nuevo proveedor en una base de datos usando el procedimiento
         * almacenado SP_I_PROVEEDOR_01 con los parámetros dados.
         * 
         * @param emp_id El ID de la empresa a la que pertenece el proveedor.
         * @param prov_nom El nombre del proveedor (cadena).
         * @param prov_ruc This parameter represents the RUC (Registro Único de Contribuyentes) of a
         * supplier in a database.
         * @param prov_telf Este parámetro representa el número de teléfono de un proveedor o
         * proveedor.
         * @param prov_direcc Este parámetro representa la dirección del proveedor que se está
         * insertando en la base de datos.
         * @param prov_correo Este parámetro representa la dirección de correo electrónico del
         * proveedor que se inserta en la base de datos.
         */
        public function insert_proveedor($emp_id,$prov_nom,$prov_ruc,$prov_telf,$prov_direcc,$prov_correo){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_PROVEEDOR_01 (?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->bindValue(2,$prov_nom);
            $query->bindValue(3,$prov_ruc);
            $query->bindValue(4,$prov_telf);
            $query->bindValue(5,$prov_direcc);
            $query->bindValue(6,$prov_correo);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        /**
         * Esta función actualiza la información de un proveedor en una base de datos utilizando
         * procedimientos almacenados en PHP.
         * 
         * @param prov_id El ID del proveedor a actualizar.
         * @param emp_id Es probable que este parámetro sea el ID de la empresa o empleador asociado
         * con el proveedor que se está actualizando.
         * @param prov_nom El nombre del proveedor (cadena).
         * @param prov_ruc This parameter represents the RUC (Registro Único de Contribuyentes) of a
         * supplier in a database.
         * @param prov_telf Este parámetro representa el número de teléfono de un proveedor en una
         * función de PHP llamada "update_proveedor".
         * @param prov_direcc Este parámetro representa la dirección de un proveedor en la función
         * update_proveedor.
         * @param prov_correo Este parámetro representa la dirección de correo electrónico de un
         * proveedor en un sistema que gestiona proveedores.
         */
        public function update_proveedor($prov_id,$emp_id,$prov_nom,$prov_ruc,$prov_telf,$prov_direcc,$prov_correo){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_PROVEEDOR_01 (?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prov_id);
            $query->bindValue(2,$emp_id);
            $query->bindValue(3,$prov_nom);
            $query->bindValue(4,$prov_ruc);
            $query->bindValue(5,$prov_telf);
            $query->bindValue(6,$prov_direcc);
            $query->bindValue(7,$prov_correo);
            $query->execute();
        }
    }
