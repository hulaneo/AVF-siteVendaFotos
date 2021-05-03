<?php
session_start();
$usuario = $_SESSION["logado"]["usuario"];
$uploaddir = __DIR__ . "\\Arquivos\\$usuario";
$uploadfile = basename($_FILES['userfile']['name']);
$receber = $_FILES['userfile']['type'];
//var_dump($receber);
echo '<pre>';

switch(true) {
    case preg_match('/^image.*/i', $receber):
        fazerUploadImagem();
        break;
    case preg_match('/^video.*/i', $receber):
        fazerUploadVideo();
        break;
    default:
        echo '<script>'.'console.log("Nenhum tipo especificado")'.'</script>';
}

function criarPasta($dir){
    mkdir($dir, 0777, true);
}

function fazerUploadImagem(){
    $dir = $GLOBALS["uploaddir"].'\\fotos\\';
    $file = $dir . $GLOBALS["uploadfile"];
    //var_dump($dir);
    if (is_dir($dir)){
    echo ("pasta existe\n");
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
            echo "Arquivo válido e enviado com sucesso.";
        } else {
            echo "Possível ataque de upload de arquivo!";
        };
    } else {
        echo ("pasta não existe\n");
        criarPasta($dir);
        fazerUploadImagem();
    };
}

function fazerUploadVideo(){
    $dir = $GLOBALS["uploaddir"].'\\videos\\';
    $file = $dir . $GLOBALS["uploadfile"];
    if (is_dir($dir)){
    echo ("pasta existe\n");
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
            echo "Arquivo válido e enviado com sucesso.";
        } else {
            echo "Possível ataque de upload de arquivo!";
        };
    } else {
        echo ("pasta não existe\n");
        criarPasta($dir);
        fazerUploadVideo();
    };
}

?>
