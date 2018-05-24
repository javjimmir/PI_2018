<?php
session_start();
include '../php/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <!--<link rel="stylesheet" type="text/css" href="./css/style.css">-->
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/conectores_content.js"></script>
    <script type="text/javascript" src="../js/validacion_reg_empre.js"></script>
    <title>Index</title>
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
       <div class="selectboton">
           <input type="button" value="Soy una empresa"
                  onclick="window.location='registroempresa.html';" />
           <input type="button" value="Soy un particular"
                  onclick="window.location='registrouser.html';" />
       </div>

    </article>
</section>

<footer class="pie">

    </footer>

</body>
</html>