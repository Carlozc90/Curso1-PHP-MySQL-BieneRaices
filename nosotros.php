<?php require 'includes/funciones.php';
incluirTemplate('header');?>

    <section class="contenedor seccion">
      <h1>Conoce sobre Nosotros</h1>
      <div class="contenido-nosotros">
        <div class="imagen">
          <picture>
            <source srcset="build/img/nosotros.webp" type="image/webp" />
            <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
            <img
              loading="lazy"
              src="build/img/nosotros.jpg"
              alt="Sobre Nosotros"
            />
          </picture>
        </div>

        <div class="texto-nosotros">
          <blockquote>25 Años de experiencia</blockquote>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt,
            quia eligendi dignissimos dolor, provident praesentium excepturi
            beatae qui ab perferendis aspernatur quibusdam fugiat repellat. Ut
            provident quae modi distinctio eum! Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Doloremque dolores esse minus
            provident perferendis rem nam ipsam. Nesciunt nobis accusamus unde,
            qui, blanditiis non optio veritatis libero consequatur placeat
            aliquid. Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Odio, sed minus corporis porro error, est cum aliquam fuga commodi
            nostrum dicta consequatur labore molestias. Quaerat fugiat pariatur
            est nulla commodi.
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
            dolor perferendis corrupti, ducimus cum facilis, nesciunt tempore ut
            esse rerum a autem voluptatem neque corporis fugit exercitationem,
            provident molestias saepe.
          </p>
        </div>
      </div>
    </section>

    <main class="contenedor seccion">
      <h1>Mas Sobre Nosotros</h1>
      <div class="iconos-nosotros">
        <div class="icono">
          <img
            src="build/img/icono1.svg"
            alt="Icono seguridad"
            loading="lazy"
          />
          <h3>Seguridad</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus
            debitis esse molestiae vel. Quod, odio, porro nihil tempore earum
            nisi aliquam debitis illum fugiat fuga sapiente aut eos harum
            explicabo?
          </p>
        </div>
        <div class="icono">
          <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy" />
          <h3>Precio</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus
            debitis esse molestiae vel. Quod, odio, porro nihil tempore earum
            nisi aliquam debitis illum fugiat fuga sapiente aut eos harum
            explicabo?
          </p>
        </div>
        <div class="icono">
          <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy" />
          <h3>Tiempo</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus
            debitis esse molestiae vel. Quod, odio, porro nihil tempore earum
            nisi aliquam debitis illum fugiat fuga sapiente aut eos harum
            explicabo?
          </p>
        </div>
      </div>
    </main>

    <?php

incluirTemplate('footer'); ?>
