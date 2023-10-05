
<?php
    class Compra extends Conectar{
        /* La clase "Compra" contiene métodos para administrar compras, incluida la inserción y recuperación de
        detalles de compra, el cálculo de totales y la obtención de datos para varios gráficos y paneles. */

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función de PHP inserta un registro de compra con un ID de tienda y un ID de usuario
         * determinados en una base de datos mediante un procedimiento almacenado.
         * 
         * @param suc_id Este parámetro representa el ID de una tienda o sucursal donde se está
         * realizando una compra.
         * @param usu_id El parámetro "usu_id" es probablemente una abreviatura de "usuario_id" que se
         * refiere a la identificación de un usuario que está realizando una compra.
         * 
         * @return el resultado de la ejecución de la consulta, que es una matriz de matrices
         * asociativas con los datos obtenidos de la base de datos.
         */
        public function insert_compra_x_suc_id($suc_id,$usu_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_COMPRA_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Registrar detalle de compra  */
      /**
       * Esta función inserta un detalle de compra en una base de datos utilizando el procedimiento
       * almacenado SP_I_COMPRA_02.
       * 
       * @param compr_id El ID de la compra a la que se añade el producto.
       * @param prod_id Este parámetro representa el ID del producto que se compra en la transacción.
       * @param prod_pcompra Este parámetro representa el precio de compra del producto que se inserta
       * en la tabla de detalles de compra.
       * @param detc_cant La cantidad del producto comprado en la transacción de compra específica.
       */
        public function insert_compra_detalle($compr_id,$prod_id,$prod_pcompra,$detc_cant){
            $conectar=parent::Conexion();
            $sql="CALL SP_I_COMPRA_02 (?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->bindValue(2,$prod_id);
            $query->bindValue(3,$prod_pcompra);
            $query->bindValue(4,$detc_cant);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener detalle de compra */
        /**
         * Esta función de PHP recupera los detalles de una compra llamando a un procedimiento
         * almacenado con una identificación de compra determinada.
         * 
         * @param compr_id El parámetro compr_id es un parámetro de entrada que representa el ID de una
         * compra. Se utiliza para recuperar los detalles de una compra específica de la base de datos.
         * 
         * @return una matriz de matrices asociativas que representan los detalles de una compra
         * identificada por el parámetro ``.
         */
        public function get_compra_detalle($compr_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar un detalle de la compra */
        /**
         * Esta función de PHP elimina un registro de una tabla de base de datos llamada
         * "compra_detalle" usando un procedimiento almacenado llamado "SP_D_COMPRA_01".
         * 
         * @param detc_id El parámetro `detc_id` es una variable que representa el ID del detalle de la
         * compra que debe eliminarse de la base de datos. Esta función es un método de una clase que
         * maneja las operaciones de la base de datos relacionadas con las compras y sus detalles. La
         * función usa una declaración preparada para llamar a un procedimiento almacenado llamado `SP
         */
        public function delete_compra_detalle($detc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_COMPRA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$detc_id);
            $query->execute();
        }

        /* TODO: Calcular SUBTOTAL, IGV y TOTAL */
       /**
        * Esta función de PHP recupera un cálculo relacionado con una compra de una base de datos
        * utilizando un procedimiento almacenado.
        * 
        * @param compr_id Este es un parámetro que representa el ID de una compra. Se utiliza en una
        * consulta de base de datos para recuperar información sobre una compra específica.
        * 
        * @return una matriz de matrices asociativas que contiene el resultado de ejecutar un
        * procedimiento almacenado denominado "SP_U_COMPRA_01" con un parámetro "compr_id".
        */
        public function get_compra_calculo($compr_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_COMPRA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Actualizar datos de la compra a est = 1 */
        /**
         * Esta función actualiza un registro de compra en una base de datos usando el procedimiento
         * almacenado SP_U_COMPRA_03 con parámetros dados.
         * 
         * @param compr_id El ID de la compra a actualizar.
         * @param pag_id Es probable que este parámetro sea el ID del método de pago utilizado para la
         * compra.
         * @param prov_id Este parámetro representa el ID del proveedor asociado a la compra.
         * @param prov_ruc Este parámetro probablemente se refiere al número de RUC (Registro Único de
         * Contribuyentes) del proveedor o vendedor asociado con la compra. El RUC es un número de
         * identificación único asignado a empresas y personas en algunos países, incluido Perú.
         * @param prov_direcc prov_direcc es un parámetro que representa la dirección del proveedor en
         * una transacción de compra.
         * @param prov_correo Este parámetro representa la dirección de correo electrónico del
         * proveedor en una transacción de compra.
         * @param compr_coment Este parámetro es un comentario o descripción relacionada con la
         * transacción de compra.
         * @param mon_id El ID de la moneda utilizada en la compra.
         * @param doc_id Este parámetro representa el ID del documento asociado a la compra. Puede ser
         * una factura, un recibo o cualquier otro documento relevante.
         * 
         * @return el resultado de la consulta ejecutada como una matriz de matrices asociativas.
         */
        public function update_compra($compr_id,$pag_id,$prov_id,$prov_ruc,$prov_direcc,$prov_correo,$compr_coment,$mon_id,$doc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_U_COMPRA_03 (?,?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->bindValue(2,$pag_id);
            $query->bindValue(3,$prov_id);
            $query->bindValue(4,$prov_ruc);
            $query->bindValue(5,$prov_direcc);
            $query->bindValue(6,$prov_correo);
            $query->bindValue(7,$compr_coment);
            $query->bindValue(8,$mon_id);
            $query->bindValue(9,$doc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener compra x ID */
        /**
         * Esta función de PHP recupera un registro de compra de una base de datos utilizando un
         * procedimiento almacenado.
         * 
         * @param compr_id Este es un parámetro que representa el ID de una compra específica que la
         * función intenta recuperar de la base de datos. Se utiliza en la consulta SQL para filtrar
         * los resultados y devolver solo la compra con el ID coincidente.
         * 
         * @return el resultado de una consulta SELECT para recuperar información sobre una compra
         * (identificada por el parámetro ) de una base de datos. El resultado es una matriz
         * de matrices asociativas, donde cada matriz asociativa representa una fila del resultado de
         * la consulta.
         */
        public function get_compra($compr_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$compr_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener listado de todas las compras por sucursal */
        /**
         * Esta función de PHP recupera una lista de compras en función de una ID de tienda
         * determinada.
         * 
         * @param suc_id El parámetro `suc_id` es un valor entero que representa el ID de una tienda o
         * sucursal específica. Esta función recupera una lista de compras realizadas en la tienda
         * especificada.
         * 
         * @return una matriz de matrices asociativas que representan una lista de compras realizadas
         * por una ubicación de tienda específica identificada por el parámetro ``.
         */
        public function get_compra_listado($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRA_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener top 5 de compras */
        /**
         * Esta función de PHP recupera los productos más comprados para una ID de tienda determinada.
         * 
         * @param suc_id El parámetro `suc_id` es una variable que representa el ID de una tienda o
         * sucursal. Se utiliza en la consulta SQL para recuperar los principales productos comprados
         * por los clientes en una tienda o sucursal específica.
         * 
         * @return una matriz de matrices asociativas que contiene los mejores productos comprados en
         * una ubicación de tienda específica identificada por el parámetro ``.
         */
        public function get_compra_top_productos($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRAS_04 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listado de compras TOP6 para el dashboard */
        /**
         * Esta función de PHP recupera las 5 compras principales para una ID de tienda determinada.
         * 
         * @param suc_id Este parámetro es una variable que representa el ID de una tienda o sucursal.
         * Se utiliza como filtro para recuperar las 5 mejores compras realizadas en una tienda o
         * sucursal específica.
         * 
         * @return una matriz de matrices asociativas que contiene las 5 compras principales realizadas
         * en una ubicación de tienda específica identificada por el parámetro ``.
         */
        public function get_compra_top_5($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRA_05 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener datos de compra y venta para actividades recientes */
        /**
         * Esta función de PHP recupera datos de una base de datos mediante un procedimiento almacenado
         * y los devuelve como una matriz asociativa.
         * 
         * @param suc_id Este parámetro es una variable que representa el ID de una sucursal o
         * ubicación específica. Se utiliza como filtro para recuperar datos relacionados con una
         * sucursal o ubicación en particular de la base de datos.
         * 
         * @return una matriz de matrices asociativas que contiene los resultados de una llamada de
         * procedimiento almacenado a "SP_L_COMPRAVENTA_01" con un parámetro de "suc_id".
         */
        public function get_compraventa($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRAVENTA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener consumo por categoria para Donut del dashboard */
       /**
        * Esta función de PHP recupera compras de consumo por categoría para una ID de tienda dada.
        * 
        * @param suc_id Este parámetro es una variable que representa el ID de una tienda o sucursal
        * específica. Se utiliza en la consulta SQL para recuperar las compras de consumo por categoría
        * para una tienda en particular.
        * 
        * @return una matriz de matrices asociativas que contiene las categorías de consumo y compra
        * para una ID de tienda determinada.
        */
        public function get_consumocompra_categoria($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRA_04 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Obtener informacion para barra de compras del dashboard */
        /**
         * Esta función de PHP recupera datos de compra para una ubicación de tienda específica.
         * 
         * @param suc_id El parámetro `suc_id` es una variable que representa el ID de una tienda o
         * sucursal. Se utiliza como parámetro en un procedimiento almacenado `SP_L_COMPRA_06` para
         * recuperar información sobre las compras realizadas en una tienda específica.
         * 
         * @return una matriz de matrices asociativas que contiene los resultados de una llamada a
         * procedimiento almacenado. Los datos específicos que se devuelven dependen de la
         * implementación del procedimiento almacenado "SP_L_COMPRA_06" y del valor del parámetro
         * "suc_id".
         */
       /**
        * Esta función de PHP recupera datos de compra para una ubicación de tienda específica.
        * 
        * @param suc_id Este parámetro es una variable que representa el ID de una tienda o sucursal.
        * Se utiliza como filtro para recuperar datos relacionados con las compras realizadas en una
        * tienda o sucursal específica.
        * 
        * @return una matriz de matrices asociativas que contiene los resultados de una llamada a
        * procedimiento almacenado. El procedimiento almacenado se llama "SP_L_COMPRA_06" y toma un
        * parámetro, que es el "suc_id". La función ejecuta el procedimiento almacenado con el
        * parámetro dado y devuelve el conjunto de resultados como una matriz de matrices asociativas.
        */
        public function get_compra_barras($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_COMPRA_06 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
