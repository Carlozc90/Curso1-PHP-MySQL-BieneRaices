<?php
namespace App;

class Propiedad {

    // Atributos estaticos

    protected static $db;
    protected static $columnasDB = ["titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedorID"];

    // Errores validacion
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorID;

    // definir la connecion a la base de datos
    public static function setDB($database){
        self::$db = $database;
       }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? "";
        $this->precio = $args['precio'] ?? "";
        $this->imagen = $args['imagen'] ?? "";
        $this->descripcion = $args['descripcion'] ?? "";
        $this->habitaciones = $args['habitaciones'] ?? "";
        $this->wc = $args['wc'] ?? "";
        $this->estacionamiento = $args['estacionamiento'] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedorID = $args['vendedorID'] ?? "";
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
        $query = " INSERT INTO propiedades ( ";
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

       $query = "UPDATE propiedades SET ";
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
      // Eliminar la propiedad
      $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
      $resultado = self::$db->query($query);

      
    if ($resultado) {
      $this->borrarImagen();
      header('location: /admin?resultado=3');
    }

    }

    // identificar y unir los atributos de la db
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
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
        return self::$errores;
    }


    public function validar(){

        
    if (!$this->titulo) {
        self::$errores[]="El titulo no debe estar vacio";
      }
      if (!$this->precio) {
        self::$errores[]="El precio no debe estar vacio";
      }
      if (strlen($this->descripcion) < 4) {
        self::$errores[]="descripcion no debe estar vacio y mayor de 4 caracteres";
      }
      if (!$this->habitaciones) {
        self::$errores[]="las habitaciones no debe estar vacio";
      }
      if (!$this->wc) {
        self::$errores[]="Los Baños no debe estar vacio";
      }
      if (!$this->estacionamiento) {
        self::$errores[]="Los estacionamiento no debe estar vacio";
      }
      if (!$this->vendedorID) {
        self::$errores[]="Elije el vendedor";
      }
      if (!$this->imagen) {
        self::$errores[] = "La imagen es obligatorias";
      }
  
      return self::$errores;
    }

    // lista todos los registros
    public static function all(){
      $query = "SELECT * FROM propiedades";

      $resultado = self::consultarSQL($query);

      return $resultado;
    }

    // busca un registro por su id

    public static function find($id) {
      $query = "SELECT * FROM propiedades WHERE id = ${id}";

      $resultado = self::consultarSQL($query);

     return array_shift($resultado);
    }


    public static function consultarSQL($query){

      // Consultar la base de datos
      $resultado = self::$db->query($query);

      // Iterar los resultados
      $array = [];
      while ($registro = $resultado->fetch_assoc()) {
        $array[] = self::crearObjeto($registro);
      }

      // liberar la memoria
      $resultado->free();

      // retornar los resultados
      return $array;

    }

    protected static function crearObjeto($registro){
      $objeto = new self;

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

