<?php
    class Calendario extends Conectar{

        /* TODO: Listar Registros */
        /**
         * Esta función de PHP recupera una lista de estados de una base de datos utilizando un
         * procedimiento almacenado.
         * 
         * @return una matriz de matrices asociativas, que contiene los resultados de ejecutar un
         * procedimiento almacenado llamado "listar_estado".
         */
        public function get_estado(){
            $conectar=parent::Conexion();
            $sql="CALL listar_estado()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        /* El `}` está cerrando la clase `Calendario`. */
        }


        /**
         * Esta función de PHP actualiza una tarea como completa en una base de datos utilizando un
         * procedimiento almacenado.
         * 
         * @param id El parámetro "id" es el identificador de la tarea que debe marcarse como completada en la
         * base de datos. La función "update_completeTask" ejecuta un procedimiento almacenado llamado
         * "completar_instalacion" pasando el parámetro "id" como argumento.
         */
        public function update_completeTask($id)
        {
        $conectar = parent::Conexion();
        $sql = "CALL completar_instalacion (?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $id);
        $query->execute();
        }


        /**
         * Esta función de PHP actualiza el estado de finalización de una tarea para deshacer mediante una
         * instrucción SQL preparada.
         * 
         * @param id El parámetro "id" es un valor entero que representa el identificador único de una tarea
         * que debe marcarse como incompleta o "deshacer". Es probable que esta función sea parte de un sistema
         * más grande que administra las tareas y su estado de finalización.
         */
        public function update_undoTaskCompletion($id)
        {
        $conectar = parent::Conexion();
        $sql = "CALL deshacer_completado (?)";
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $id);
        $query->execute();
        }


    }
?>
