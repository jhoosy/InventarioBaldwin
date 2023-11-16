<!DOCTYPE html>
<html>

<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body>
        <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
          <div class="logo">
         <img src="img/logg2.png" alt="Logo de Baldwin">
          </div>
			
		</div>
		<br>
        
        <div class="login">
           <form  action="" method="POST" autocomplete="off">
                <div>INVENTARIO</div><br>
				
                <input class="input" type="text" placeholder="Usuario" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required><br>
                 <!-- #region -->
				
                <input class="input" type="password" placeholder="Contraseña" name="login_clave" pattern="[a-zA-Z0-9$@.-]{3,100}" maxlength="100" required><br>

			
                <input type="submit" class="button" value="INGRESAR">  

                <?php
                if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
                    require_once "./php/main.php";
                    require_once "./php/iniciar_sesion.php";
                }
                ?>

            </form>


         </div>
</body>

</html>
 




 