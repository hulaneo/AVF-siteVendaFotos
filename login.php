<?php
$connect = mysqli_connect('localhost','root','','cadastro');
$db = mysqli_select_db($connect,'usuarios');
$login = $_POST['usuario'];
$entrar = $_POST['entrar'];
$pass = md5($_POST['senha']);

  if (isset($entrar)) {
    /*$sgdbConsulta = array (
      "con" => $connect,
      "query" = "SELECT * FROM usuarios WHERE usuario='$login' AND senha='$pass' LIMIT 1",
    );*/
    $verifica = mysqli_query($connect, "SELECT * FROM usuarios WHERE usuario='$login' AND senha='$pass' LIMIT 1") or die("erro ao selecionar");

      if (mysqli_num_rows($verifica)<=0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='login.html';</script>";
        die();
      }else{
        session_start();
        $_SESSION["logado"]=mysqli_fetch_array($verifica);
        $nomeConectado = $_SESSION["logado"]["nome"];
        setcookie("login",$login);
        echo"<script language='javascript' type='text/javascript'>
        window.location.href='painelAdm.html';</script>";
      }
  }
?>