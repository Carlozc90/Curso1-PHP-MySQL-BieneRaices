<?php 
namespace App;

class ActiveRecord{
    
    // Atributos estaticos

    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores validacion
    protected static $errores = [];


    // definir la connecion a la base de datos
    public static function setDB($database){
        self::$db = $database;
       }



    public function guardar(){
      if (!is_null($this->id)) {
        //  actualizar
        $this->actualizar();
      }else{
        // Creando un nuevo registro
        $this->crear();
      }

    }

    public function crear(){

        // sanatizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);

        // Mensaje de exito
        if ($resultado) {
          // Redireccionar el usuario
          header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){
        // sanatizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
          $valores[] = "{$key}='{$value}'";
        }

       $query = "UPDATE " . static::$tabla . " SET ";
       $query .=  join(', ', $valores);
       $query .=" WHERE id = '" . self::$db->escape_string($this->id) . "' ";
       $query .= " LIMIT 1 ";

      $resultado= self::$db->query($query);

      
      if ($resultado) {
        // Redireccionar el usuario
        header('Location: /admin?resultado=2');
      }      
    }

    // eliminar un registro
    public function eliminar(){
      $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
      $resultado = self::$db->query($query);

      
    if ($resultado) {
      $this->borrarImagen();
      header('location: /admin?resultado=3');
    }

    }

    // identificar y unir los atributos de la db
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    // subida de archivos
    public function setImagen($imagen){
      // eliminar la imagen previa

      if(!is_null($this->id)){
        $this->borrarImagen();
      }

        //    Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Eliminar el archivo
    public function borrarImagen(){
        // comprobar si existe el archivo
        $existeArchivo= file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
          unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Validacion

    public static function getErrores() {
        return static::$errores;
    }


    public function validar(){

        static::$errores = [];
        return static::$errores;
    }

    // lista todos los registros
    public static function all(){
      $query = "SELECT * FROM " . static::$tabla;

      $resultado = self::consultarSQL($query);

      return $resultado;
    }

    // Obtiene determinado numero de registros
    public static function get($cantidad){
      $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

      $resultado = self::consultarSQL($query);

      return $resultado;
    }

    // busca un registro por su id

    public static function find($id) {
      $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

      $resultado = self::consultarSQL($query);

     return array_shift($resultado);
    }


    public static function consultarSQL($query){

      // Consultar la base de datos
      $resultado = self::$db->query($query);

      // Iterar los resultados
      $array = [];
      while ($registro = $resultado->fetch_assoc()) {
        $array[] = static::crearObjeto($registro);
      }

      // liberar la memoria
      $resultado->free();

      // retornar los resultados
      return $array;

    }

    protected static function crearObjeto($registro){
      $objeto = new static;

      foreach($registro as $key =>  $value ) {
        if (property_exists( $objeto , $key )) {
          $objeto->$key = $value;
        }
      }

      return $objeto;
    }

    // Sincroniza el objeto en la memoria e¿con los cambios realizados por el usuario

    public function sincronizar($args=[]) { 
      foreach($args as $key => $value) {
        if(property_exists($this, $key) && !is_null($value)) {
          $this->$key = $value;
        }
      }
  }

}