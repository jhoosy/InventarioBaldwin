<!DOCTYPE html>
<html>

<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="IMG/LOGO-ESCUDO-BALDWIN-PNG-1.png">
        </div>
        <div class="login-content">
            <form class="box login" action="" method="POST" autocomplete="off">
                <img src="img/txtlog.png"><br><br>
                <h2>INVENTARIO</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{3,100}" maxlength="100" required>
                    </div>
                </div>

                <input type="submit" class="btn" value="INGRESAR">

                <?php
                if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
                    require_once "./php/main.php";
                    require_once "./php/iniciar_sesion.php";
                }
                ?>

            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/login.js"></script>
</body>

</html>
