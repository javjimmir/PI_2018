<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
    <!--<link rel="stylesheet" type="text/css" href="./css/style.css">-->
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/conectores_content.js"></script>
    <script type="text/javascript" src="../js/validacion_reg_usu.js"></script>
    <script type="text/javascript" src="../js/fondo.js"></script>
    <title>Contacto | WildSports</title>
    </head>
<body>

<header class="menuLogin">

    </header>
<nav class="menuPrincipalUser">

</nav>
<aside class="publicidad">

    </aside>
<section>
    <article>
        <div class="fondo">
        <form action="mailto:javierjimenezmiranda@gmail.com" method="post" enctype="text/plain" class="formcontact" id="form_contact">
            <h1>Formulario de contacto</h1>
            <div id="form1">
                <label for="">Nombre</label><br>
                <input type="text" id="nombre-usu" placeholder="NOMBRE" required><br>
                <label for="">Correo electrónico</label><br>
                <input type="mail" id="mail-usu" placeholder="EMAIL" required><br><br><br>
                <p>Nota: Nos pondremos en contacto con usted a través del email facilitado, Gracias.</p>
            </div>
            <div id="form2">
                <label for="">Tipo de consulta</label><br>
                <select name="" id="tipo_consulta">
                    <option value="informacion">¿¿Olvidaste la contraseña??</option>
                    <option value="informacion">Solicitar información</option>
                    <option value="sugerencias">Sugerencias</option>
                    <option value="quejas">Quejas y reclamaciones</option>
                    <option value="publi">Publicidad</option>
                    <option value="otras">Otras</option>
                </select><br>
                <label for="">Descripción</label><br>
                <textarea name="" id="desc-contacto">   Detalle aqui su peticion</textarea><br>
            </div>
            <input type="submit" value="Enviar" id="boton-contact">
        </form>
            <div id="error-usu"></div>
        </div>

    </article>
</section>s

<footer class="pie">

    </footer>

</body>
</html>