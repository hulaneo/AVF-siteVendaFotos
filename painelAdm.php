<?php
session_start();
$usuario = $_SESSION["logado"]["usuario"];
$uploaddir = __DIR__ . "\\fotos\\$usuario\\";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';

fazerUploadImagem($uploaddir, $uploadfile);

function criarPasta($dir){
    mkdir("$dir", 0777, true);
}

function fazerUploadImagem($dir, $file){
    if (is_dir($dir)){
    echo ("pasta existe");
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file)) {
            echo "Arquivo válido e enviado com sucesso.\n";
        } else {
            echo "Possível ataque de upload de arquivo!\n";
        };
    } else {
        echo ("pasta não existe");
        criarPasta($dir);
        fazerUpload($dir, $file);
    };
}

echo 'Aqui está mais informações de debug:';
print_r($_FILES);

print "</pre>";

?>
