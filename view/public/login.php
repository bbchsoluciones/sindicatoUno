<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="../../assets/vendor/fontawesome/css/all.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../assets/css/estilos_public.css" rel="stylesheet">
    <link href="../../assets/css/animate.css" rel="stylesheet">
</head>

<body>
    <div class="login-page">
        <div class="login">
            <div class="overlay-image"></div>
            <div class="cabecera">
                <span data-animation="animated bounceOut">Autentificar</span>
            </div>
            <form class="form-login">
                <div class="form-group fill-line">
                    <label for="title">Identificador</label>
                    <div class="input-container">
                        <input type="text" id="title" name="title" placeholder="Ingrese identificador">
                        <div class="line1"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group fill-line">
                    <label for="title">Contraseña</label>
                    <div class="input-container">
                        <input type="password" id="title" name="title" placeholder="Ingrese contraseña">
                        <div class="line2"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="remember">
                    <div class="float-left">
                        <label class="customcheck">
                            Recordarme
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="forgot-pass float-left">
                        <span class="cursor">¿Olvidaste tu contraseña?</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-success">Entrar</button>
                </div>
            </form>
            <a type="button" class="back btn" href="index.php">
                <i class="fa fa-chevron-left "></i>
                Volver
            </a>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
          ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/carousel-animation.js"></script>
    <script src="../../assets/js/active-button.js"></script>
    <!--
        <script src="assets/js/sticky-header-navbar.js"></script>
        <script src="assets/js/scroll0.js"></script>
        -->
</body>

</html>