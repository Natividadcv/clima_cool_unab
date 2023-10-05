<?php
class Categoria extends Conectar
{

  /* TODO: Listar Registros */
    /**
     * Esta función de PHP recupera una lista de categorías en función de una ID de tienda dada.
     * 
     * suc_id El parámetro "suc_id" es un parámetro de entrada que representa el ID de una tienda o
     * sucursal. Se utiliza para recuperar una lista de categorías asociadas con esa tienda o sucursal en
     * particular.
     * 
     * query matriz de matrices asociativas que contienen los resultados de una llamada a un
     * procedimiento almacenado para recuperar categorías en función de un ID de tienda determinado.
     */
  public function get_categoria_x_suc_id($suc_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_CATEGORIA_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO: Listar Registro por ID en especifico */
    /**
     * Esta función de PHP recupera una categoría en función de su ID de una base de datos mediante un
     * procedimiento almacenado.
     * 
     * cat_id El parámetro "cat_id" es una variable que representa el ID de una categoría. Esta
     * función se utiliza para recuperar información sobre una categoría en función de su ID.
     * 
     * query matriz de matrices asociativas que contienen información sobre una categoría en función
     * del ID de categoría proporcionado.
     */
  public function get_categoria_x_cat_id($cat_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_CATEGORIA_02 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $cat_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }


  /* TODO: Eliminar o cambiar estado a eliminado */

    /**
     * Esta función de PHP elimina una categoría llamando a un procedimiento almacenado con una ID de
     * categoría determinada.
     * 
     * cat_id El parámetro cat_id es el ID de la categoría que debe eliminarse de la base de datos.
     */

  public function delete_categoria($cat_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_D_CATEGORIA_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $cat_id);
    $query->execute();
  }

  /* TODO: Registro de datos */
    /**
     * Esta función de PHP inserta una nueva categoría en una tabla de base de datos.
     * 
     * @param suc_id Es probable que este parámetro sea un identificador de una sucursal o ubicación
     * específica de una empresa. Se utiliza como parámetro para insertar una nueva categoría en la base de
     * datos para una sucursal específica.
     * @param cat_nom Este parámetro representa el nombre de la categoría que debe insertarse en la base de
     * datos.
     */
  public function insert_categoria($suc_id, $cat_nom)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_I_CATEGORIA_01 (?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->bindValue(2, $cat_nom);
    $query->execute();
  }

  /* TODO: Actualizar Datos */
    /**
     * Esta función actualiza una categoría en una base de datos utilizando un procedimiento almacenado.
     * 
     * @param cat_id El ID de la categoría que se va a actualizar.
     * @param suc_id El parámetro "suc_id" es probablemente una abreviatura de "sucursal_id" que hace
     * referencia al ID de la sucursal o ubicación asociada con la categoría que se actualiza.
     * @param cat_nom Este parámetro representa el nuevo nombre que se le asignará a la categoría que se
     * está actualizando.
     */
  public function update_categoria($cat_id, $suc_id, $cat_nom)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_U_CATEGORIA_01 (?,?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $cat_id);
    $query->bindValue(2, $suc_id);
    $query->bindValue(3, $cat_nom);
    $query->execute();
  }

  /* TODO: Obtener el total de stock por categoria */
    /**
     * Esta función de PHP recupera el stock total de una categoría para una ID de tienda determinada.
     * 
     * @param suc_id El parámetro "suc_id" es una variable que representa el ID de una tienda o sucursal
     * específica. Se utiliza en la consulta SQL para recuperar el stock total de cada categoría para una
     * tienda en particular.
     * 
     * @return una matriz de matrices asociativas que contiene el stock total de cada categoría en una
     * ubicación de tienda específica, obtenida llamando a un procedimiento almacenado denominado
     * "SP_L_CATEGORIA_03" con el ID de la ubicación de la tienda como parámetro.
     */
  public function get_categoria_total_stock($suc_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_CATEGORIA_03 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
