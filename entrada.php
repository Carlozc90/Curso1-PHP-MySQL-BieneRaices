<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion contenido-centrado">
      <h1>Guia para la decoracion de tu hogar</h1>

      <picture>
        <source srcset="build/img/destacada2.webp" type="image/webp" />
        <source srcset="build/img/destacada2.jpg" type="image/jpeg" />
        <img
          loading="lazy"
          src="build/img/destacada2.jpg"
          alt="imagen de la propiedad"
        />
      </picture>

      <p class="informacion-meta">
        Escrito el: <span>20/10/2021</span> por: <span>Admin</span>
      </p>

      <div class="resumen-propiedad">
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
