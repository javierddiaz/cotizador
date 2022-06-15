<?php
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");
    extract($_POST);

    $password=md5($password);

    $sql=mysqli_query($con, "select * from tb_user where username='$user' and userpassword='$password' ");
   
	while ($row=mysqli_fetch_array($sql))
	{
        session_start();
        $session_id = session_id();
        $_SESSION["seguir"]="ok";
        $_SESSION["codigo"]=$row["termcondition"];
        $_SESSION["nombre"]=$row["token"];
        $_SESSION["instructor"]=$row["nombre"];
        $_SESSION["correo"]=$row["correo"];
        $_SESSION["telefono"]=$row["telefono"];
        $delete=mysqli_query($con,"DELETE FROM tmp_cotizacion WHERE session_id='".$session_id."'");
        header('Location: cotizacion.php');
        exit;
    }
    header('Location: index.php');
?>