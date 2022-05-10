<?php

    $path = "arquivosUpload/";
    $diretorio = dir($path);

    echo "<h1>Lista de Arquivos do diretório: </h1><br />";
    echo"<h3>Clique em algum link para acessar o arquivo solicitado</h3>";
    while($arquivo = $diretorio -> read()){
        echo"<a href='".$path.$arquivo."'>".$arquivo."</a><br />";    
    }
    $diretorio -> close();

    echo'<br><br><a href="ead_1.php">Voltar a página principal</a>';
    
?>