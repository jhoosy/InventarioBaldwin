<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

	/*== Almacenando datos ==*/
	$codigo=limpiar_cadena($_POST['producto_codigo']);
	$marca=limpiar_cadena($_POST['producto_marca']);

	$descripcion=limpiar_cadena($_POST['producto_descripcion']);
	$cantidad=limpiar_cadena($_POST['producto_cantidad']);
    $sede=limpiar_cadena($_POST['producto_sede']);
	$categoria=limpiar_cadena($_POST['producto_categoria']);
    $estado=limpiar_cadena($_POST['producto_estado']);
    $observaciones=limpiar_cadena($_POST['producto_observaciones']);




	/*== Verificando campos obligatorios ==*/
    if($codigo=="" || $marca=="" || $descripcion=="" || $cantidad=="" || $sede=="" || $categoria==""|| $estado==""|| $observaciones==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO de BARRAS no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$marca)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La Marca no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$descripcion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La Descripcion no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{1,25}",$cantidad)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La Cantidad no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$estado)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Estado no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$sede)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La sede no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$observaciones)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las Observaciones no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Verificando codigo ==*/
    $check_codigo=conexion();
    $check_codigo=$check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
    if($check_codigo->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_codigo=null;


   


    /* Directorios de imagenes */
	$img_dir='../img/producto/';


	/*== Comprobando si se ha seleccionado una imagen ==*/
	if($_FILES['producto_foto']['name']!="" && $_FILES['producto_foto']['size']>0){

        /* Creando directorio de imagenes */
        if(!file_exists($img_dir)){
            if(!mkdir($img_dir,0777)){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Error al crear el directorio de imagenes
                    </div>
                ';
                exit();
            }
        }

		/* Comprobando formato de las imagenes */
		if(mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png"){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La imagen que ha seleccionado es de un formato que no está permitido
	            </div>
	        ';
	        exit();
		}


		/* Comprobando que la imagen no supere el peso permitido */
		if(($_FILES['producto_foto']['size']/1024)>3072){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La imagen que ha seleccionado supera el límite de peso permitido
	            </div>
	        ';
			exit();
		}


		/* extencion de las imagenes */
		switch(mime_content_type($_FILES['producto_foto']['tmp_name'])){
			case 'image/jpeg':
			  $img_ext=".jpg";
			break;
			case 'image/png':
			  $img_ext=".png";
			break;
		}

		/* Cambiando permisos al directorio */
		chmod($img_dir, 0777);

		/* Nombre de la imagen */
		$img_nombre=renombrar_fotos($nombre);

		/* Nombre final de la imagen */
		$foto=$img_nombre.$img_ext;

		/* Moviendo imagen al directorio */
		if(!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$foto)){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
	            </div>
	        ';
			exit();
		}

	}else{
		$foto="";
	}


	/*== Guardando datos ==*/
    $guardar_producto=conexion();
    $guardar_producto=$guardar_producto->prepare("INSERT INTO producto(producto_codigo,producto_marca,producto_descripcion,producto_cantidad,producto_sede,producto_estado,producto_observaciones,producto_foto,categoria_id,usuario_id) VALUES(:codigo,:marca,:descripcion,:cantidad,:sede,:estado,:observaciones,:foto,:categoria,:usuario)");

    $marcadores=[
        ":codigo"=>$codigo,
        ":marca"=>$marca,
        ":descripcion"=>$descripcion,
        ":cantidad"=>$cantidad,
        ":sede"=>$sede,
        ":estado"=>$estado,
        ":observaciones"=>$observaciones,
        ":foto"=>$foto,
        ":categoria"=>$categoria,
        ":usuario"=>$_SESSION['id']
    ];

    $guardar_producto->execute($marcadores);

    if($guardar_producto->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡EQUIPO REGISTRADO!</strong><br>
                El equipo se a registrado con exito
            </div>
        ';
    }else{

    	if(is_file($img_dir.$foto)){
			chmod($img_dir.$foto, 0777);
			unlink($img_dir.$foto);
        }

        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error!</strong><br>
                No se pudo registrar el equipo, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_producto=null;