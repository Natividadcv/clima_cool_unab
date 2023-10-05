<?php
class Documento extends Conectar
{
  /* TODO: Listar Registros */
  /**
   * Esta función de PHP recupera un documento en función de su tipo mediante un procedimiento
   * almacenado.
   * 
   * @param doc_tipo El parámetro "doc_tipo" es una variable que representa el tipo de documento que se
   * está solicitando. Se utiliza como parámetro en la consulta SQL para filtrar los resultados y
   * devolver solo los documentos del tipo especificado.
   * 
   * @return el resultado de una consulta de base de datos que recupera todas las filas de una tabla
   * relacionada con un tipo de documento específico. El resultado es una matriz de matrices
   * asociativas, donde cada matriz asociativa representa una fila de la tabla.
   */
  public function get_documento($doc_tipo)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_DOCUMENTO_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $doc_tipo);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
