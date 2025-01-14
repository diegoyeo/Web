<?php
    $conexion = mysqli_connect("localhost", "root", "", "Asignacion");
    //obtener datos del formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tipoSolicitud=$_POST["tipoSolicitud"];
        $nombre=$_POST["nombre"];
        $primerA=$_POST["primerA"];
        $segundoA=$_POST["segundoA"];
        $tel=$_POST["tel"];
        $boleta=$_POST["boleta"];
        $estatura=$_POST["estatura"];
        $edad=$_POST["edad"];
        $correo=$_POST["correo"];
        /*$credencial=$_POST["credencialPDF"];
        $horario=$_POST["horarioPDF"];*/
        $usuario=$_POST["usuario"];
        $contra =$_POST["password"];

        // Comprobación para asegurarse de que los archivos se han enviado correctamente
        if (isset($_FILES['credencialPDF']) && $_FILES['credencialPDF']['error'] === UPLOAD_ERR_OK) {
            $credencialPDF = $_FILES['credencialPDF']['tmp_name'];
            $credencialPath = '../uploads/' . $_FILES['credencialPDF']['name'];
            move_uploaded_file($credencialPDF, $credencialPath);
        } else {
            echo '<script>Error al subir el archivo de credencial PDF o archivo no recibido</script>';
        }

        if (isset($_FILES['horarioPDF']) && $_FILES['horarioPDF']['error'] === UPLOAD_ERR_OK) {
            $horarioPDF = $_FILES['horarioPDF']['tmp_name'];
            $horarioPath = '../uploads/' . $_FILES['horarioPDF']['name'];
            move_uploaded_file($horarioPDF, $horarioPath);
        } else {
            echo '<script>Error al subir el archivo de horario PDF o archivo no recibido</script>';
        }


        $ingresarDatos="INSERT INTO alumno(nombre, primerApe,segundoApe,telefono,boleta,estatura,edad,correo,usuario_alum,contra_alum, credencial,Horario) 
        VALUES('$nombre','$primerA','$segundoA','$tel','$boleta','$estatura','$edad','$correo','$usuario','$contra','$credencialPath','$horarioPath')";
        mysqli_query($conexion,$ingresarDatos);
        if($tipoSolicitud=='Renovación'){
            $casilleroAnt =$_POST["numeroLocker"];
            $datosSolicitud="INSERT INTO solicitud(boleta,tipo_soli,estado_soli,hora_registro,casillero_anterior)
            VALUES('$boleta','$tipoSolicitud','pendiente',NOW(),'$casilleroAnt')";
            if(mysqli_query($conexion,$datosSolicitud)){
                echo "<script>alert('Tiene 24 horas para subir el comprobante de pago.');  window.location.href = '../acceso.html';</script>";
            }else{
                echo "<script>No se logró guardar con éxito los datos</script>";
            }
        }else{
            $datosSolicitud="INSERT INTO solicitud(boleta,tipo_soli,estado_soli,hora_registro)
            VALUES('$boleta','$tipoSolicitud','pendiente',NOW())";
            if(mysqli_query($conexion,$datosSolicitud)){
                echo "<script>alert('Debe iniciar sesión en 48 horas para ver el resultado de la solicitud.');  window.location.href = '../acceso.html';</script>";
            }else{
                echo "<script>No se logró guardar con éxito los datos</script>";
            }
        }
        /*if(mysqli_query($conexion,$ingresarDatos)){
            echo "Registro guardado";
        }else{
            echo "error";
        }*/
        }

    //header("Location: acuse.html");
    exit();
    
?>