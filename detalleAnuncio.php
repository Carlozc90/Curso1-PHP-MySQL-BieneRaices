<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion contenido-centrado">
      <h1>Casa en Venta frente al bosque</h1>

      <picture>
        <source srcset="build/img/destacada.webp" type="image/webp" />
        <source srcset="build/img/destacada.jpg" type="image/jpeg" />
        <img
          loading="lazy"
          src="build/img/destacada.jpg"
          alt="imagen de la propiedad"
        />
      </picture>

      <div class="resumen-propiedad">
        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
          <li>
            <img
              class="icono-anuncio"
              loading="lazy"
              src="build/img/icono_wc.svg"
              alt="icono wc"
            />
            <p>3</p>
          </li>
          <li>
            <img
              class="icono-anuncio"
              loading="lazy"
              src="build/img/icono_estacionamiento.svg"
              alt="icono estacionamiento"
            />
            <p>3</p>
          </li>
          <li>
            <img
              class="icono-anuncio"
              loading="lazy"
              src="build/img/icono_dormitorio.svg"
              alt="icono dormitorio"
            />
            <p>4</p>
          </li>
        </ul>

        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate
          beatae iusto provident hic nostrum voluptates, ex facilis quos,
          doloremque asperiores sapiente itaque? Minima aliquid sint totam
          alias, aperiam labore consectetur! Lorem ipsum dolor sit amet
          consectetur adipisicing elit. Aliquid nisi, repudiandae sit harum,
          delectus facere ducimus eaque, dignissimos unde nostrum non quasi?
          Aspernatur aut omnis doloremque unde libero maiores mollitia!
        </p>
      </div>
    </main>

    <footer class="footer seccion">
      <div class="contenedor contenedor-footer">
        <nav class="navegacion">
          <a href="nosotros.php">Nosotros</a>
          <a href="anuncio.php">Anuncio</a>
          <a href="blog.php">Blog</a>
          <a href="contacto.php">Contacto</a>
        </nav>

        <p class="copyright">Todos los derechos Reservados 2021 &copy;</p>
      </div>
    </footer>

    <script src="build/js/bundle.min.js"></script>
  </body>
</html>
