<?php 

    require 'includes/config/database.php';
    $db = conectarDB();

    // Autentificar el usuario

    $errores = [];

    // ver los archivos POST cuando el formulario se ah enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // filtrar el email
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        // sanitizado email
        $emailSanity = mysqli_real_escape_string($db, $email);


        $password = $_POST['password'];
        // sanitizado password
        $passwordSanity = mysqli_real_escape_string($db,$password);

        if (!$emailSanity) {
           $errores[] = "El email es obligatorio o no es valido";
        }

        if (!$passwordSanity) {
            $errores[] = "El Password es obligatorio o no es valido";
         }

         if (empty($errores)) {
            //  revisar si el usuario existe.
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";

            $resultado = mysqli_query($db,$query);

           if ($resultado->num_rows) {
                //   revisar si el password es correcto

                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto o no

                $auth = password_verify($password, $usuario["password"]);

                    if ($auth) {
                        //    El usuario esta autentificado
                        session_start();

                        // llenar el arreglo de la sesion
                        $_SESSION['usuario']=$usuario['email'];
                        $_SESSION['login']=true;
                    
                        header('Location: /admin');


                    }else{
                        $errores[] = "El Password es incorrecto";
                    }

           }else{
               $errores[]="El Usuario no existe";
           }
         }

    }

    // incluyendo el header
    require 'includes/funciones.php';
    incluirTemplate('header');?>

        <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach ($errores as $error):?>
            <div class="alerta error">
                <?php echo $error;?>
            </div>
        <?php endforeach;?>

        <!-- post para enviar el formulario -->
        <form class="formulario" method="POST">
            <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input name="email" type="email" placeholder="Tu Email" id="email"  />

            <label for="telefono">Password</label>
            <input name="password" type="password" placeholder="Tu Password" id="Password"  />

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">


        </form>
        </main>

<?php

incluirTemplate('footer'); ?>
