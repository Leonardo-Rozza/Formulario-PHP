<?php 

require "mail.php";

function validateForm($nombre, $email, $password, $asunto, $comentarios){
  return !empty($nombre) && !empty($email) && !empty($password) && !empty($asunto) && !empty($comentarios);
}

$status = "";

  // Comprobamos si el formulario fue enviado
  if(isset($_POST['form'])){
    // Invocamos función para validar y con el unpacking array le pasamos los parametros solicitados a la función
    if(validateForm($_POST['nombre'], $_POST['email'], $_POST['password'], $_POST['asunto'],$_POST['comentarios'])){
      // Sanitizando los datos
      $name = htmlentities($_POST['nombre']);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = htmlentities($_POST['password']);
      $asunto = htmlentities($_POST['asunto']);
      $comentarios = htmlentities($_POST['comentarios']);

      $body = "$name <$email> te envia el siguiente mensaje: <br><br> $comentarios";
      $status = "success";

      //Mandar el mail.
      sendMail($asunto, $body, $email, $name, true);
    }
    else
    {
      $status = "error";
    }
    }
  




?>




<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulario</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
  </head>
  <body
    class="vh-100 d-flex justify-content-center align-items-center bg-info-subtle"
  >
    <section class="container-sm">
      <?php if($status == "success"): ?>
        <div class="alert alert-success" role="alert">
          El formulario se envio con éxito!
        </div>
      <?php endif; ?>
      <?php if($status == "error"): ?>
        <div class="alert alert-danger" role="alert">
          Falta minimo un campo por completar.
        </div>
      <?php endif; ?>
      <form action="./" method="POST">
        <h1 class="text-center mb-3">Contactanos!</h1>
        <div class="form-floating mb-3">
          <input
            name="nombre"
            type="text"
            class="form-control"
            id="floatingInput2"
            placeholder="name@example.com"
            style="background-color: whitesmoke"
          />
          <label for="floatingInput2">Nombre</label>
        </div>
        <div class="form-floating mb-3">
          <input
            name="email"
            type="email"
            class="form-control"
            id="floatingInput"
            placeholder="name@example.com"
            style="background-color: whitesmoke"
          />
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3">
          <input
            name="password"
            type="password"
            class="form-control"
            id="floatingPassword"
            placeholder="Password"
            style="background-color: whitesmoke"
          />
          <label for="floatingPassword">Contraseña</label>
        </div>
        <div class="form-floating mb-3">
          <textarea
            name="asunto"
            class="form-control"
            placeholder="Leave a comment here"
            id="floatingTextarea2"
            style="background-color: whitesmoke"
          ></textarea>
          <label for="floatingTextarea2">Asunto</label>
        </div>
        <div class="form-floating mb-3">
          <textarea
            name="comentarios"
            class="form-control"
            placeholder="Leave a comment here"
            id="floatingTextarea1"
            style="height: 100px; background-color: whitesmoke"
          ></textarea>
          <label for="floatingTextarea1">Comentarios</label>
        </div>
        <div class="d-grid gap-2 mx-auto btn btn-outline-primary">
          <button
            class="btn btn"
            type="submit"
            name="form"
            id="liveAlertBtn"
          >
            Enviar
          </button>
        </div>
        
      </form>
    </section>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
