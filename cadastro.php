<?php
$email = $_POST['email'];
$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);
$connect = mysqli_connect('localhost','root','','cadastro');
$query_select = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
$select = mysqli_query($connect,$query_select);
$array = mysqli_fetch_array($select);
//$userarray = $array['usuario'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    if($usuario == "" || $usuario == null){
        echo"<script language='javascript' type='text/javascript'>
        alert('O campo login deve ser preenchido');window.location.href='
        cadastro.html';</script>";

        }else{
        if($array == $usuario){
            echo"<script language='javascript' type='text/javascript'>
            alert('Esse login já existe');window.location.href='
            cadastro.html';</script>";
            //die();

        }else{
            $query = "INSERT INTO usuarios (email,nome,usuario,senha) VALUES ('$email','$nome','$usuario','$senha')";
            $insert = mysqli_query($connect,$query);

            if($insert){
            echo"<script language='javascript' type='text/javascript'>
            alert('Usuário cadastrado com sucesso!');window.location.
            href='login.html'</script>";
            }else{
            echo"<script language='javascript' type='text/javascript'>
            alert('Não foi possível cadastrar esse usuário');window.location
            .href='cadastro.html'</script>";
            }
        }
        }
    } else {
        echo"<script language='javascript' type='text/javascript'>
        alert('$email não é um e-mail válido.');window.location.href='
        cadastro.html';</script>";
    }
?>