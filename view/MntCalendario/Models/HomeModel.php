<?php
class HomeModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar($title, $servicio, $inicio, $end, $cliente, $productoId, $direccion, $referencia, $instalacion_coment, $color)
    {
        $sql = "INSERT INTO evento (title, servicio, start, end, idcliente, productoId, direccion, referencia, instalacion_coment, color) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $array = array($title, $servicio, $inicio, $end, $cliente, $productoId, $direccion, $referencia, $instalacion_coment, $color);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        }else{
            $res = 'error';
        }
        return $res;
    }
    public function getEventos()
    { 
        //  // Filter events by calendar date 
        //     $where_sql = ''; 
        //     if(!empty($_GET['start']) && !empty($_GET['end'])){ 
        //         $where_sql .= " WHERE start BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' "; 
        //     } 
        //     // Fetch events from database 
        //     $sql = "SELECT * FROM evento $where_sql"; 

        $sql = "SELECT * FROM evento WHERE instalacion_completada = 0";
        return $this->selectAll($sql);

    }

        public function getCliente()
    { 
        $sql = "SELECT * FROM tm_cliente";
        return $this->selectAll($sql);

    }
        public function getProducto()
    { 
        $sql = "SELECT * FROM tm_producto";
        return $this->selectAll($sql);

    }




    public function modificar($title, $servicio, $inicio, $end, $cliente, $productoId, $direccion, $referencia, $instalacion_coment, $color, $id)
    { 
        $sql = "UPDATE evento SET title=?, servicio=?, start=?, end=?, idcliente=?, productoId=?, direccion=?, referencia=?, instalacion_coment=?, color=? WHERE id=?";
        $array = array($title, $servicio, $inicio, $end, $cliente, $productoId, $direccion, $referencia, $instalacion_coment, $color, $id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function eliminar($id)
    {
        $sql = "DELETE FROM evento WHERE id=?";
        $array = array($id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function dragOver($start,$end, $id)
    {
        $sql = "UPDATE evento SET start=?, end=? WHERE id=?";
        $array = array($start, $end, $id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
}

?>