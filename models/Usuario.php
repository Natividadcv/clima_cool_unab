<?php
class Usuario extends Conectar
{
  /* TODO: Listar Registros */
  /**
   * Esta función de PHP recupera una lista de usuarios basada en una ID de tienda dada.
   * 
   * @param suc_id El parámetro "suc_id" es una variable que representa el ID de una sucursal o
   * ubicación específica. Esta función se utiliza para recuperar todos los usuarios asociados con una
   * sucursal o ubicación en particular según el parámetro "suc_id" que se le pasó.
   * 
   * @return una matriz de matrices asociativas que contienen información sobre los usuarios asociados
   * con un suc_id dado (ID de la tienda).
   */
  public function get_usuario_x_suc_id($suc_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_USUARIO_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO: Listar Registro por ID en especifico */
  /**
   * Esta función de PHP recupera la información de un usuario en función de su ID de usuario.
   * 
   * @param usu_id El parámetro "usu_id" es una variable que representa el ID de un usuario en una base
   * de datos. Esta función se utiliza para recuperar información sobre un usuario en función de su ID.
   * 
   * @return una matriz de matrices asociativas que contienen información sobre un usuario con el
   * `` dado. La información devuelta puede incluir campos como nombre de usuario, correo
   * electrónico, contraseña y otros detalles dependiendo de la implementación del procedimiento
   * almacenado `SP_L_USUARIO_02`.
   */
  public function get_usuario_x_usu_id($usu_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_L_USUARIO_02 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $usu_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  

  /* TODO: Eliminar o cambiar estado a eliminado */
  /**
   * Esta función de PHP elimina un usuario de una base de datos utilizando un procedimiento
   * almacenado.
   * 
   * @param usu_id El parámetro "usu_id" es una variable que representa el ID del usuario que debe
   * eliminarse de la base de datos.
   */
  public function delete_usuario($usu_id)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_D_USUARIO_01 (?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $usu_id);
    $query->execute();
  }

  /* TODO: Registro de datos */
  /**
   * Esta función inserta un nuevo usuario en una base de datos con diversa información de usuario y
   * una imagen de usuario opcional.
   * 
   * @param suc_id El ID de la sucursal o ubicación asociada del usuario.
   * @param usu_correo La dirección de correo electrónico del usuario que se está insertando en la base
   * de datos.
   * @param usu_nom Este parámetro representa el nombre del usuario que se está insertando en la base
   * de datos.
   * @param usu_ape Apellido del usuario que se está insertando en la base de datos.
   * @param usu_dni Este parámetro es probablemente el DNI (Documento Nacional de Identidad) del
   * usuario que se está insertando en la base de datos. Es un número de identificación único asignado
   * a personas en algunos países, como Perú y Argentina.
   * @param usu_telf Este parámetro representa el número de teléfono del usuario que se está insertando
   * en la base de datos.
   * @param usu_pass Este parámetro representa la contraseña del usuario que se inserta en la base de
   * datos.
   * @param rol_id El ID de rol del usuario que se está insertando.
   * @param usu_img Este parámetro se utiliza para almacenar la imagen del usuario. Se pasa como
   * argumento a la función insert_usuario() y se sube mediante el método upload_image() de la clase
   * Usuario. Si no se carga ninguna imagen, el valor de este parámetro se establece en una cadena
   * vacía.
   */
  public function insert_usuario($suc_id, $usu_correo, $usu_nom, $usu_ape, $usu_dni, $usu_telf, $usu_pass, $rol_id, $usu_img)
  {
    $conectar = parent::Conexion();

    require_once("Usuario.php");
    $usu = new Usuario();
    $usu_img = '';
    if ($_FILES["usu_img"]["name"] != '') {
      $usu_img = $usu->upload_image();
    }

    $sql = "CALL SP_I_USUARIO_01 (?,?,?,?,?,?,?,?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $suc_id);
    $query->bindValue(2, $usu_correo);
    $query->bindValue(3, $usu_nom);
    $query->bindValue(4, $usu_ape);
    $query->bindValue(5, $usu_dni);
    $query->bindValue(6, $usu_telf);
    $query->bindValue(7, $usu_pass);
    $query->bindValue(8, $rol_id);
    $query->bindValue(9, $usu_img);
    $query->execute();
  }

  /* TODO:Actualizar Datos */
  /**
   * Esta función actualiza la información de un usuario en una base de datos, incluida su imagen, si
   * se proporciona.
   * 
   * @param usu_id El ID del usuario que se va a actualizar.
   * @param suc_id Es probable que este parámetro sea el ID de la ubicación o sucursal asociada del
   * usuario.
   * @param usu_correo La dirección de correo electrónico del usuario que se está actualizando.
   * @param usu_nom Este parámetro representa el nombre del usuario que debe actualizarse en la base de
   * datos.
   * @param usu_ape Este parámetro representa el apellido o apellido de un usuario en un sistema de
   * gestión de usuarios.
   * @param usu_dni Este parámetro es probablemente el DNI (Documento Nacional de Identidad) del
   * usuario, que es un número de identificación único utilizado en algunos países, como Perú y España.
   * @param usu_telf Este parámetro representa el número de teléfono del usuario que se está
   * actualizando.
   * @param usu_pass Este parámetro representa la contraseña del usuario que debe actualizarse en la
   * base de datos.
   * @param rol_id Este parámetro representa el ID de rol del usuario que se está actualizando. Es
   * probable que se use para determinar el nivel de acceso y los permisos que tiene el usuario dentro
   * del sistema.
   * @param usu_img Este parámetro se utiliza para almacenar la imagen del usuario. Se puede cargar a
   * través de un formulario y luego pasar a esta función para actualizar la información del usuario en
   * la base de datos. Si no se carga ninguna imagen, utilizará el valor del campo
   * "hidden_usuario_imagen" en los datos POST.
   */
  public function update_usuario($usu_id, $suc_id, $usu_correo, $usu_nom, $usu_ape, $usu_dni, $usu_telf, $usu_pass, $rol_id, $usu_img)
  {
    $conectar = parent::Conexion();

    require_once("Usuario.php");
    $usu = new Usuario();
    $usu_img = '';
    if ($_FILES["usu_img"]["name"] != '') {
      $usu_img = $usu->upload_image();
    } else {
      $usu_img = $POST["hidden_usuario_imagen"];
    }

    $sql = "CALL SP_U_USUARIO_01 (?,?,?,?,?,?,?,?,?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $usu_id);
    $query->bindValue(2, $suc_id);
    $query->bindValue(3, $usu_correo);
    $query->bindValue(4, $usu_nom);
    $query->bindValue(5, $usu_ape);
    $query->bindValue(6, $usu_dni);
    $query->bindValue(7, $usu_telf);
    $query->bindValue(8, $usu_pass);
    $query->bindValue(9, $rol_id);
    $query->bindValue(10, $usu_img);
    $query->execute();
  }

  /**
   * Esta función actualiza la contraseña de un usuario en una base de datos mediante un procedimiento
   * almacenado.
   * 
   * @param usu_id El ID del usuario cuya contraseña necesita ser actualizada.
   * @param usu_pass Este parámetro representa la nueva contraseña que se actualizará para el usuario
   * con el ID de usuario especificado (usu_id).
   * 
   * @return el resultado de la ejecución de la consulta, que es una matriz de matrices asociativas que
   * contienen los datos obtenidos de la base de datos.
   */
  public function update_usuario_pass($usu_id, $usu_pass)
  {
    $conectar = parent::Conexion();
    $sql = "CALL SP_U_USUARIO_02 (?,?)";
    $query = $conectar->prepare($sql);
    $query->bindValue(1, $usu_id);
    $query->bindValue(2, $usu_pass);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* TODO:Acceso al Sistema */
    /**
     * Esta función de PHP maneja el inicio de sesión del usuario al recibir parámetros de una vista de
     * inicio de sesión, consultar una base de datos y generar variables de sesión para el usuario.
     */
  public function login()
  {
    $conectar = parent::Conexion();
    if (isset($_POST["enviar"])) {
      /* TODO: Recepcion de Parametros desde la Vista Login */
      $sucursal = $_POST["suc_id"];
      $correo = $_POST["usu_correo"];
      $pass =  $_POST["usu_pass"];
      if (empty($sucursal) and empty($correo) and empty($pass)) {
        exit();
      } else {
        $sql = "CALL SP_L_USUARIO_04 (?,?,?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $sucursal);
        $query->bindValue(2, $correo);
        $query->bindValue(3, $pass);
        $query->execute();
        $resultado = $query->fetch();
        if (is_array($resultado) and count($resultado) > 0) {
          /* TODO:Generar variables de Session del Usuario */
          $_SESSION["USU_ID"] = $resultado["USU_ID"];
          $_SESSION["USU_NOM"] = $resultado["USU_NOM"];
          $_SESSION["USU_APE"] = $resultado["USU_APE"];
          $_SESSION["USU_CORREO"] = $resultado["USU_CORREO"];
          $_SESSION["SUC_ID"] = $resultado["SUC_ID"];
          $_SESSION["COM_ID"] = $resultado["COM_ID"];
          $_SESSION["EMP_ID"] = $resultado["EMP_ID"];
          $_SESSION["ROL_ID"] = $resultado["ROL_ID"];
          $_SESSION["USU_IMG"] = $resultado["USU_IMG"];
          $_SESSION["SUC_NOM"] = $resultado["SUC_NOM"];


          header("Location:" . Conectar::ruta() . "view/home/");
        } else {
            header("Location:" . Conectar::ruta() . "view/404/errorLogin.php");
          exit();
        }
      }
    } else {
      exit();
    }
  }

  /* TODO: Subit imagen de usuario */
  /**
   * La función carga un archivo de imagen y devuelve su nuevo nombre.
   * 
   * @return new_name nuevo nombre del archivo de imagen cargado.
   */
  public function upload_image()
  {
    if (isset($_FILES["usu_img"])) {
      $extension = explode('.', $_FILES['usu_img']['name']);
      $new_name = rand() . '.' . $extension[1];
      $destination = '../assets/usuario/' . $new_name;
      move_uploaded_file($_FILES['usu_img']['tmp_name'], $destination);
      return $new_name;
    }
  }
}
