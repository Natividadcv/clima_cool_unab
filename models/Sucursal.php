<?php
class Sucursal extends Conectar
{
  /* TODO: Listar Registros */
  /**
   * Esta función de PHP recupera una lista de sucursales según la identificación de empleado
   * proporcionada.
   * 
   * @param emp_id El parámetro `emp_id` es un parámetro de entrada que representa el ID de un
   * empleado. Esta función recupera todas las sucursales (sucursales en español) asociadas con la
   * identificación de empleado dada.
   * 
   * @return una matriz de matrices asociativas que contienen información sobre las sucursales
   * (sucursales) asociadas con una identificación de empleado determinada.
   */
  public function get_sucursal_x_emp_id($emp_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_SUCURSAL_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $emp_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO: Listar Registro por ID en especifico */
  /**
   * Esta función de PHP recupera información sobre una rama específica en función de su ID.
   * 
   * @param suc_id El parámetro "suc_id" es una variable que representa el ID de una sucursal o
   * ubicación específica de una empresa. Esta función se utiliza para recuperar información sobre una
   * sucursal en particular en función de su ID.
   * 
   * @return una matriz de matrices asociativas que contienen información sobre una rama específica
   * (sucursal) identificada por el parámetro ``. La información se obtiene ejecutando un
   * procedimiento almacenado `SP_L_SUCURSAL_02` en una conexión de base de datos.
   */
  public function get_sucursal_x_suc_id($suc_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_SUCURSAL_02 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO: Eliminar o cambiar estado a eliminado */
  /**
   * Esta función de PHP elimina un registro de una tabla de base de datos para una identificación
   * determinada de una sucursal.
   * 
   * @param suc_id El parámetro "suc_id" es una variable que representa el ID de la "sucursal"
   * (sucursal o ubicación) que se desea eliminar de la base de datos. Es probable que esta función sea
   * parte de un programa o sistema más grande que administra información sobre diferentes sucursales o
   * ubicaciones de una empresa.
   */
  public function delete_sucursal($suc_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_D_SUCURSAL_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->execute();
  }

  /* TODO: Registro de datos */
  /**
   * Esta función de PHP inserta un nuevo registro en una tabla de base de datos para una
   * identificación de empresa y un nombre de sucursal determinados.
   * 
   * @param emp_id El DNI de la empresa a la que pertenecerá la nueva sucursal/sucursal.
   * @param suc_nom Este parámetro representa el nombre de la nueva sucursal o ubicación que se
   * insertará en la base de datos.
   */
  public function insert_sucursal($emp_id, $suc_nom)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_I_SUCURSAL_01 (?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $emp_id);
    $query->bindValue(2, $suc_nom);
    $query->execute();
  }

  /* TODO:Actualizar Datos */
  /**
   * Esta función de PHP actualiza un registro en una tabla de base de datos para un ID de sucursal, ID
   * de empresa y nombre de sucursal dados.
   * 
   * @param suc_id El ID de la sucursal (sucursal) que necesita ser actualizado.
   * @param emp_id Este parámetro representa el ID de la empresa a la que pertenece la sucursal.
   * @param suc_nom Este parámetro representa el nuevo nombre que se le asignará a una sucursal
   * específica (sucursal) de una empresa. La función está diseñada para actualizar el nombre de una
   * sucursal identificada por su ID (suc_id) y asociada a una empresa específica (emp_id).
   */
  public function update_sucursal($suc_id, $emp_id, $suc_nom)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_U_SUCURSAL_01 (?,?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->bindValue(2, $emp_id);
    $query->bindValue(3, $suc_nom);
    $query->execute();
  }
}
