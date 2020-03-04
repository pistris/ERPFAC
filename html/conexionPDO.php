<?php
    class Conexion extends PDO {

        public $conexion;
        
        private $server="bhuaagzhlgugk5u9beiw-mysql.services.clever-cloud.com";
        private $base="bhuaagzhlgugk5u9beiw";
        private $usuario="uqmqkkwu33ddsizp";
        private $clave="RZIZqzC0eIuZ901QyzPA";
        
        public function __construct() {
        } 
            
        public function conectarBase(){
            try {
                $this->conexion = new PDO("mysql:host={$this->server};dbname={$this->base}", "{$this->usuario}", "{$this->clave}");
            } catch (PDOException $e) {
                print "Ocurrio un problema en la conexion: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        
        public function cerrarConexion(){
            $this->conexion = null;
        }
        
        public function abrirConexion(){
            return $this->conexion;
        }

        //Funcion para Select
        public function selectQuery($strSelectSQL){
            if($this->conexion instanceof PDO){
                $result = $this -> selectConsulta($strSelectSQL);
                
            }
            else{
                $this -> conectarBase();
                $result = $this -> selectConsulta($strSelectSQL);
                $this -> cerrarConexion();
            }
    
            return $result;
        }

        function selectConsulta($ExcutSql){
            $this->conexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $this->conexion->prepare($ExcutSql);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($resultado);
        }

        //Funcion para Delete, Update, Insert
        public function excuteQuery($strSelectSQL){
            if($this->conexion instanceof PDO){
                $result = $this -> ejecutarConsulta($strSelectSQL);
                
            }
            else{
                $this -> conectarBase();
                $result = $this -> ejecutarConsulta($strSelectSQL);
                $this -> cerrarConexion();
            }
    
            return $result;
        }

        function ejecutarConsulta($ExcutSql){
            $this->conexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $this->conexion->exec($ExcutSql);
            return json_encode($resultado);
        }

    }
?>