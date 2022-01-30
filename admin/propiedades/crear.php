<?php 
  // Base de datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  // Consultar para obtener los vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db,$consulta);

  // comprovacion de errores array
  $comprovacion=[];

  $titulo = "";
  $precio = "";
  $descripcion = "";
  $habitaciones = "";
  $wc = "";
  $estacionamiento ="";
  $vendedorID = "";


// Ejecutar el codigo despues de que el usuario envie el formulario
  if ($_SERVER['REQUEST_METHOD']==='POST') {

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorID = mysqli_real_escape_string($db, $_POST['vendedorID']);
    $creado = date("Y/m/d");

    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];


    if (!$titulo) {
      $comprovacion[]="El titulo no debe estar vacio";
    }
    if (!$precio) {
      $comprovacion[]="El precio no debe estar vacio";
    }
    if (strlen($descripcion) < 4) {
      $comprovacion[]="descripcion no debe estar vacio y mayor de 4 caracteres";
    }
    if (!$habitaciones) {
      $comprovacion[]="las habitaciones no debe estar vacio";
    }
    if (!$wc) {
      $comprovacion[]="Los Baños no debe estar vacio";
    }
    if (!$estacionamiento) {
      $comprovacion[]="Los estacionamiento no debe estar vacio";
    }
    if (!$vendedorID) {
      $comprovacion[]="Elije el vendedor";
    }
    if (!$imagen['name'] || $imagen['error']) {
      $comprovacion[] = "La imagen es obligatorias";
    }
    
    //validar por tamaño (1000 kb maximo)
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
      $comprovacion[] = "La imagen es muy pezada";
    }

    // echo "<pre>";
    // var_dump($comprovacion);;
    // echo "</pre>";


    if (empty($comprovacion)) {

        // subida de archivos
        // 
        // Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
          mkdir($carpetaImagenes);
        }
     
        // Generar un nombre unico
        $nombreImagen=md5(uniqid(rand(), true)) . ".jpg";


        // subir imagenes

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);


        // Insertar en la base de datos
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorID) VALUES ( '$titulo', '$precio', '$nombreImagen','$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorID' )";

        // echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
          // Redireccionar el usuario
          header('Location: /admin?resultado=1');
        }
    }


  }



  require '../../includes/funciones.php';   
  incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($comprovacion as $error):?>
    <div class="alerta error">
     <?php echo $error; ?>  
    </div>
  <?php endforeach; ?>


<form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
  <fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo;?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio;?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
    
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
  </fieldset>

  <fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones;?>">
    
    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc;?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento;?>">
  </fieldset>

  <fieldset>
    <legend>Vendedor</legend>

    <select name="vendedorID">
      <option value="">--Seleccion--</option>
      <?php while($row = mysqli_fetch_assoc($resultado)): ?>
        <option <?php echo $vendedorID === $row["id"] ? 'selected':'';?>  value="<?php echo $row['id'];?>">
          <?php echo $row['nombre'] . " " . $row["apellido"];?>
        </option>
      <?php endwhile; ?>
    </select>
  </fieldset>

  <input type="submit" value="Crear Propiedad" class="boton boton-verde">


</form>


    </main>

    <?php

incluirTemplate('footer'); ?>