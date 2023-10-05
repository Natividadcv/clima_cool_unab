<?php
    class Producto extends Conectar{
        /* TODO: Listar Registros */
       /**
        * Esta función de PHP recupera una lista de productos basada en una ID de tienda dada.
        * 
        * @param suc_id Este es un parámetro que representa el ID de una tienda o sucursal específica.
        * Se utiliza en una llamada de procedimiento almacenado para recuperar una lista de productos
        * asociados con esa tienda o sucursal en particular.
        * 
        * @return una matriz de matrices asociativas que contienen información sobre productos
        * asociados con una ID de tienda específica.
        */
        public function get_producto_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PRODUCTO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        /**
         * Esta función recupera la información de un producto en función de su ID de una base de datos
         * mediante un procedimiento almacenado.
         * 
         * @param prod_id El parámetro "prod_id" es una variable que representa el ID de un producto.
         * Esta función se utiliza para recuperar información sobre un producto de una base de datos
         * utilizando su ID.
         * 
         * @return una matriz de matrices asociativas que contienen la información de un producto con
         * el prod_id dado.
         */
        public function get_producto_x_prod_id($prod_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PRODUCTO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO:Listado de Productos por categoria */
        /**
         * Esta función de PHP recupera productos en función de una ID de categoría determinada
         * mediante un procedimiento almacenado.
         * 
         * @param cat_id El parámetro cat_id es un valor entero que representa el ID de una categoría.
         * Esta función recupera todos los productos que pertenecen a la categoría con el ID
         * especificado.
         * 
         * @return una matriz de matrices asociativas que contienen información sobre productos
         * pertenecientes a una categoría específica, identificada por el parámetro ``.
         */
        public function get_producto_x_cat_id($cat_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PRODUCTO_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$cat_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        /**
         * Esta función de PHP elimina un producto de una base de datos utilizando un procedimiento
         * almacenado.
         * 
         * @param prod_id El parámetro "prod_id" es una variable que representa el ID del producto que
         * debe eliminarse de la base de datos. Esta función es un método de una clase que extiende una
         * clase padre "Conexion" que maneja la conexión a la base de datos. La función ejecuta un
         * procedimiento almacenado "SP_D_PRODUCTO_01
         */
        public function delete_producto($prod_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_D_PRODUCTO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        /**
         * Esta función inserta un nuevo producto en una base de datos con varios atributos que
         * incluyen nombre, descripción, precio e imagen.
         * 
         * @param suc_id El ID de la tienda donde se insertará el producto.
         * @param cat_id ID de categoría del producto
         * @param prod_nom El nombre del producto que se está insertando.
         * @param prod_descrip Este parámetro es una cadena que representa la descripción de un
         * producto. Se utiliza como entrada para la llamada al procedimiento almacenado para insertar
         * un nuevo producto en la base de datos.
         * @param und_id Es probable que este parámetro se refiera a la unidad de medida del producto
         * que se está insertando. Podría ser un valor numérico o una cadena que represente la unidad
         * (por ejemplo, "kg", "m", "piezas").
         * @param mon_id Este parámetro representa el ID de la moneda utilizada para el precio del
         * producto.
         * @param prod_pcompra El precio de compra del producto.
         * @param prod_pventa Este parámetro representa el precio de venta de un producto.
         * @param prod_stock Este parámetro representa el stock o cantidad de un producto disponible en
         * inventario.
         * @param prod_fechaven Este parámetro es probablemente un campo de fecha que representa la
         * fecha de vencimiento del producto que se inserta en la base de datos.
         * @param prod_img Este parámetro es el archivo de imagen del producto que se está insertando.
         * Se carga utilizando el método "upload_image" de la clase "Producto". Si no se selecciona
         * ninguna imagen, se pasa una cadena vacía como valor.
         */
        public function insert_producto($suc_id,$cat_id,$prod_nom,$prod_descrip,$und_id,
                                        $mon_id,$prod_pcompra,$prod_pventa,$prod_stock,
                                        $prod_fechaven,$prod_img){
            $conectar=parent::Conexion();

            require_once("Producto.php");
            $prod=new Producto();
            $prod_img='';
            if($_FILES["prod_img"]["name"] !=''){
                $prod_img=$prod->upload_image();
            }

            $sql="CALL SP_I_PRODUCTO_01 (?,?,?,?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$cat_id);
            $query->bindValue(3,$prod_nom);
            $query->bindValue(4,$prod_descrip);
            $query->bindValue(5,$und_id);
            $query->bindValue(6,$mon_id);
            $query->bindValue(7,$prod_pcompra);
            $query->bindValue(8,$prod_pventa);
            $query->bindValue(9,$prod_stock);
            $query->bindValue(10,$prod_fechaven);
            $query->bindValue(11,$prod_img);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        /**
         * Esta función actualiza un producto en una base de datos con varios parámetros, incluidos el
         * ID del producto, el nombre, la descripción, el precio, las existencias y la imagen.
         * 
         * @param prod_id El ID del producto a actualizar.
         * @param suc_id El ID de la tienda o sucursal donde se encuentra el producto o asociado.
         * @param cat_id ID de categoría del producto
         * @param prod_nom El nombre del producto que se está actualizando.
         * @param prod_descrip Este parámetro es una variable de cadena que representa la descripción
         * de un producto. Se utiliza en la función de actualizar la descripción de un producto en una
         * base de datos.
         * @param und_id Este parámetro representa la unidad de medida del producto.
         * @param mon_id Este parámetro representa el ID de la moneda utilizada para el precio del
         * producto.
         * @param prod_pcompra El precio de compra del producto.
         * @param prod_pventa Este parámetro representa el precio de venta de un producto.
         * @param prod_stock Este parámetro representa el stock o cantidad de un producto disponible en
         * inventario.
         * @param prod_fechaven Este parámetro representa la fecha de caducidad de un producto.
         * @param prod_img Este parámetro se utiliza para almacenar la imagen del producto que se está
         * actualizando. Si se sube una nueva imagen, se almacenará en esta variable, de lo contrario,
         * se utilizará el valor del campo hidden_producto_imagen.
         */
        public function update_producto($prod_id,$suc_id,$cat_id,$prod_nom,$prod_descrip,$und_id,
                                        $mon_id,$prod_pcompra,$prod_pventa,$prod_stock,
                                        $prod_fechaven,$prod_img){
            $conectar=parent::Conexion();

            require_once("Producto.php");
            $prod=new Producto();
            $prod_img='';
            if($_FILES["prod_img"]["name"] !=''){
                $prod_img=$prod->upload_image();
            }else{
                $prod_img = $POST["hidden_producto_imagen"];
            }

            $sql="CALL SP_U_PRODUCTO_01 (?,?,?,?,?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$cat_id);
            $query->bindValue(4,$prod_nom);
            $query->bindValue(5,$prod_descrip);
            $query->bindValue(6,$und_id);
            $query->bindValue(7,$mon_id);
            $query->bindValue(8,$prod_pcompra);
            $query->bindValue(9,$prod_pventa);
            $query->bindValue(10,$prod_stock);
            $query->bindValue(11,$prod_fechaven);
            $query->bindValue(12,$prod_img);
            $query->execute();
        }

        /* TODO: Registrar Imagen */
       /**
        * La función carga un archivo de imagen y devuelve su nuevo nombre.
        * 
        * @return el nuevo nombre del archivo de imagen cargado.
        */
        public function upload_image(){
            if (isset($_FILES["prod_img"])){
                $extension = explode('.', $_FILES['prod_img']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '../assets/producto/' . $new_name;
                move_uploaded_file($_FILES['prod_img']['tmp_name'], $destination);
                return $new_name;
            }
        }

        /* TODO: Consumo de productos */
      /**
       * Esta función de PHP recupera información de consumo para un ID de producto determinado de una
       * base de datos utilizando un procedimiento almacenado.
       * 
       * @param prod_id El parámetro `prod_id` es un parámetro de entrada de la función
       * `get_producto_consumo`. Se utiliza para especificar el ID del producto para el que se va a
       * recuperar la información de consumo de la base de datos.
       * 
       * @return una matriz de matrices asociativas que contiene el resultado de ejecutar un
       * procedimiento almacenado denominado "SP_L_PRODUCTO_05" con un parámetro "prod_id".
       */
        public function get_producto_consumo($prod_id){
            $conectar=parent::Conexion();
            $sql="CALL SP_L_PRODUCTO_05 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
