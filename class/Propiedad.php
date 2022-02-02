<?php
namespace App;

class Propiedad extends ActiveRecord {

  protected static $tabla = 'propiedades';
  protected static $columnasDB = ["id","titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedorID"];

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
}

