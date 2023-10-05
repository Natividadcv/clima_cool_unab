<?php
    class Cliente extends Conectar{
        /* TODO: Listar Registros */
        /**
         * Esta función de PHP recupera los datos del cliente en función de la identificación de la empresa
         * proporcionada.
         * 
         * @param emp_id Esta función espera un parámetro:
         * 
         * @return una matriz de matrices asociativas que contienen información sobre los clientes asociados
         * con una identificación de empresa específica.
         */
        public function get_cliente_x_emp_id($emp_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_CLIENTE_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función de PHP recupera la información de un cliente en función de su ID de cliente.
         * 
         * @param cli_id El parámetro `cli_id` es una variable que representa el ID de un cliente. Se utiliza
         * en la consulta SQL para recuperar información sobre un cliente específico de la base de datos.
         * 
         * @return una matriz de matrices asociativas que contiene la información de un cliente con el cli_id
         * dado.
         */
        public function get_cliente_x_cli_id($cli_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_CLIENTE_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$cli_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina un cliente de una base de datos utilizando un procedimiento almacenado.
         * 
         * @param cli_id El parámetro `cli_id` es la ID del cliente que debe eliminarse de la base de datos.
         * Esta función es un método de una clase que extiende una clase padre `Conexion`, que es responsable
         * de establecer una conexión con la base de datos. La función ejecuta un procedimiento almacenado
         * `SP_D_CLIENTE_01`
         */
        public function delete_cliente($cli_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_CLIENTE_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$cli_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        /**
         * Esta función inserta un nuevo cliente en una base de datos utilizando el procedimiento almacenado
         * SP_I_CLIENTE_01 con los parámetros proporcionados.
         * 
         * @param emp_id El ID de la empresa a la que pertenece el cliente.
         * @param cli_nom El nombre del cliente que se inserta en la base de datos.
         * @param cli_ruc Este parámetro representa el RUC (Registro Único de Contribuyentes) de un cliente,
         * que es un número de identificación único asignado a empresas y personas físicas en algunos países de
         * América Latina, como Perú y Ecuador, para efectos fiscales.
         * @param cli_telf Este parámetro representa el número de teléfono de un cliente.
         * @param cli_direcc Este parámetro representa la dirección del cliente que se inserta en la base de
         * datos.
         * @param cli_correo Este parámetro representa la dirección de correo electrónico de un cliente que se
         * está insertando en una tabla de base de datos.
         */
    public function insert_cliente($emp_id,$cli_nom,$cli_ruc,$cli_telf,$cli_direcc,$cli_correo){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_CLIENTE_01 (?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->bindValue(2,$cli_nom);
            $query->bindValue(3,$cli_ruc);
            $query->bindValue(4,$cli_telf);
            $query->bindValue(5,$cli_direcc);
            $query->bindValue(6,$cli_correo);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        /**
         * Esta función actualiza la información de un cliente en una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param cli_id El ID del cliente a actualizar.
         * @param emp_id El ID de la empresa asociada al cliente.
         * @param cli_nom Nombre del cliente
         * @param cli_ruc Este parámetro es probablemente el RUC (Registro Único de Contribuyentes) del
         * cliente, que es un número de identificación único asignado a empresas y personas físicas en algunos
         * países de América Latina, como Perú y Ecuador, para efectos fiscales.
         * @param cli_telf Este parámetro representa el número de teléfono de un cliente en una base de datos.
         * @param cli_direcc Este parámetro representa la dirección de un cliente en un sistema de gestión de
         * clientes.
         * @param cli_correo Este parámetro representa la dirección de correo electrónico de un cliente en una
         * base de datos. Se utiliza en una función para actualizar la información de un cliente en la base de
         * datos.
         */
        public function update_cliente($cli_id,$emp_id,$cli_nom,$cli_ruc,$cli_telf,$cli_direcc,$cli_correo){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_CLIENTE_01 (?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$cli_id);
            $query->bindValue(2,$cli_nom);
            $query->bindValue(3,$emp_id);
            $query->bindValue(4,$cli_ruc);
            $query->bindValue(5,$cli_telf);
            $query->bindValue(6,$cli_direcc);
            $query->bindValue(7,$cli_correo);
            $query->execute();
        }
    }
