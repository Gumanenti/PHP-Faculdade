<?php
 
include_once "variaveis.php";
 
// Condicional que mostra um erro se arquivo não for baixado
if ($_FILES['arquivo']['error'] != 0) {
    die("Não foi possível fazer o upload.<br />" . $_UPLOAD['erros'][2][$_FILES['arquivo']['error']]);
    exit;
}
 
 
// Faz a verificação da extensão do arquivo
$extensao_do_arquivo = strtolower(end($tmp));
if (array_search($extensao_do_arquivo, $_UPLOAD['extensoes_baixar']) === false) {
    echo "Sistema só recebe arquivos com as seguintes extensões: pdf, gif, jpg ou png";
}
 
// Faz a verificação do tamanho do arquivo
else if ($_UPLOAD['tamanho_do_arquivo_maximo'] < $_FILES['arquivo']['size'] and $_UPLOAD['tamanho_do_arquivo_minimo'] >  $_FILES['arquivo']['size'] ) {
    echo "O arquivo está com tamanho incompatível, envie arquivos de 10KB até 1Mb.";
}
 
else {
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UPLOAD['renomeiar_arquivo'] == true) {
        $nome_final = time().'.jpg';
    } else {
        $nome_final = $_FILES['arquivo']['name'];
    }
    
    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UPLOAD['pasta_do_arquivo'] . $nome_final)) {
        // exibi mensagem de Upload efetuado com sucesso
        echo "Upload efetuado com sucesso!";
        echo '<br /><a href="' . $_UPLOAD['pasta_do_arquivo'] . $nome_final . '"><h4>Clique aqui para acessar o UPLOAD</h4></a>';
    } else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
    }
 
}

    echo'<a href="./pasta_de_arquivos">Clique aqui para acessar os arquivos baixados</a>';
    echo'<br><br><a href="ead_1.php">Voltar a página principal</a>';


 
