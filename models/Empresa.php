<?php
class Empresa extends Conectar
{
  /* TODO: Listar Registros */
  /**
   * Esta función de PHP recupera información sobre una empresa en función de su ID.
   * 
   * @param com_id El parámetro "com_id" es una variable que representa el ID de una empresa. Se
   * utiliza como parámetro de entrada del procedimiento almacenado "SP_L_EMPRESA_01" para recuperar
   * información de la empresa de la base de datos.
   * 
   * @return una matriz de matrices asociativas que contienen información sobre las empresas asociadas
   * con el com_id dado.
   */
  public function get_empresa_x_com_id($com_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_EMPRESA_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $com_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO: Listar Registro por ID en especifico */
 /**
  * Esta función de PHP recupera información sobre una empresa en función de su ID.
  * 
  * @param emp_id Este es un parámetro que representa el ID de una empresa (empresa en español) que
  * queremos recuperar de la base de datos. La función está diseñada para obtener los detalles de una
  * empresa en función de su ID.
  * 
  * @return una matriz de matrices asociativas que contienen información sobre una empresa, según el ID
  * de empresa proporcionado.
  */
  public function get_empresa_x_emp_id($emp_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_EMPRESA_02 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $emp_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO: Eliminar o cambiar estado a eliminado */
  /**
   * Esta función de PHP elimina una empresa de una base de datos utilizando un procedimiento
   * almacenado.
   * 
   * @param emp_id El parámetro "emp_id" es una variable que representa el ID de la empresa (compañía)
   * que necesita ser borrada de la base de datos.
   */
  public function delete_empresa($emp_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_D_EMPRESA_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $emp_id);
    $query->execute();
  }

  /* TODO: Registro de datos */
  /**
   * Esta función de PHP inserta una nueva empresa en una base de datos con el ID de la empresa, el
   * nombre de la empresa y el RUC de la empresa proporcionados.
   * 
   * @param com_id Es probable que este parámetro sea un identificador de la empresa a la que
   * pertenecerá la nueva empresa. Puede ser un valor numérico o alfanumérico que identifique de manera
   * única a la empresa en una base de datos o sistema.
   * @param emp_nom Este parámetro representa el nombre de la empresa que se está insertando en la base
   * de datos.
   * @param emp_ruc emp_ruc significa "Empresa Registro Único de Contribuyentes", que es un número de
   * identificación único asignado a empresas en algunos países, como Perú. Se utiliza con fines
   * fiscales y para identificar a la empresa en procedimientos legales y administrativos.
   */
  public function insert_empresa($com_id, $emp_nom, $emp_ruc)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_I_EMPRESA_01 (?,?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $com_id);
    $query->bindValue(2, $emp_nom);
    $query->bindValue(3, $emp_ruc);
    $query->execute();
  }

  /* TODO:Actualizar Datos */
  /**
   * Esta función actualiza la información de una empresa en una base de datos utilizando
   * procedimientos almacenados en PHP.
   * 
   * @param emp_id El ID de la empresa (empresa) a actualizar.
   * @param com_id Este parámetro es probablemente el ID de la empresa asociada con la empresa dada
   * (español para "compañía").
   * @param emp_nom Este parámetro representa el nombre actualizado de la empresa.
   * @param emp_ruc Este parámetro es probablemente el RUC (Registro Único de Contribuyentes) de una
   * empresa o negocio. Es un número de identificación único asignado a empresas en algunos países,
   * como Perú.
   */
  public function update_empresa($emp_id, $com_id, $emp_nom, $emp_ruc)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_U_EMPRESA_01 (?,?,?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $emp_id);
    $query->bindValue(2, $com_id);
    $query->bindValue(3, $emp_nom);
    $query->bindValue(4, $emp_ruc);
    $query->execute();
  }
}
