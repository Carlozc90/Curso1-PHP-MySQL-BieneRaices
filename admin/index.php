<?php 

require '../includes/app.php'; 
estaAutenticado();

use App\Propiedad;

// Implementar un metodo para obtener todas las propiedades
$propiedades = Propiedad::all();

// Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id,FILTER_VALIDATE_INT);

  if($id){

    $propiedad = Propiedad::find($id);

    $propiedad->eliminar();

  }
}

// Incluye un template
incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if ($resultado == 1): ?>
      <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif($resultado == 2): ?>
      <p class="alerta exito">Anuncio Actualizado correctamente</p>
    <?php elseif($resultado == 3): ?>
      <p class="alerta exito">Anuncio Eliminado correctamente</p>
    <?php endif; ?>



    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <Table class="propiedades">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titulo</th>
          <th>Imagen</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>

                <!-- Mostrar los Resultados -->
                <!-- mysqli_fetch_assoc() se usa para transformar la data de bd ah string -->
      <tbody>
        <?php foreach($propiedades as $propiedad): ?>
        <tr>
            <td><?php echo $propiedad->id; ?></td>
            <td><?php echo $propiedad->titulo; ?></td>
            <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" ></td>
            <td>$<?php echo $propiedad->precio; ?></td>
            <td>

              <form method="POST" class="w-100">


                  <input type="hidden" name="id" value="<?php  echo $propiedad->id;?>">
                  <input type="submit" class="boton-rojo-block" value="Eliminar">
              </form>

              <a href="propiedades/actualizar.php?id=<?php  echo $propiedad->id;?>" class="boton-amarillo-block">Actualizar</a>
            </td>
          </tr>
          <?php endforeach;?>
      </tbody>
    </Table>

  </main>

  <?php

    // Cerrar la conexion
    mysqli_close($db);


    incluirTemplate('footer'); 
?>