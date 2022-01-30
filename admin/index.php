<?php 

  // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

  // Escribir el Query

  $query = "SELECT * FROM propiedades";


  // Consultar BD mysqli_query() le pasamos la coneccion
  $resultadoConsulta = mysqli_query($db, $query);
  
  // Muestra mensaje condicional
  $resultado = $_GET['resultado'] ?? null;

  // Incluye un template
  require '../includes/funciones.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Administrador de Bienes Raices</h1>

      <?php if ($resultado == 1): ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
      <?php elseif($resultado == 2): ?>
        <p class="alerta exito">Anuncio Actualozido correctamente</p>
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
          <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
          <tr>
              <td><?php echo $propiedad['id']; ?></td>
              <td><?php echo $propiedad['titulo']; ?></td>
              <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" ></td>
              <td>$<?php echo $propiedad['precio']; ?></td>
              <td>
                <a href="#" class="boton-rojo-block">Eliminar</a>
                <a href="propiedades/actualizar.php?id=<?php  echo $propiedad['id'];?>" class="boton-amarillo-block">Actualizar</a>
              </td>
            </tr>
            <?php endwhile;?>
        </tbody>
      </Table>

    </main>

    <?php

      // Cerrar la conexion
      mysqli_close($db);


      incluirTemplate('footer'); 
?>