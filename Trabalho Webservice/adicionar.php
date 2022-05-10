<?php

require_once "BancoDados.php";

function adicionarNoticia(){
    try {
        $conexao = Conexao::getConexao();
        if(isset($_GET['id'])){ 
            $id = $_GET['id'];
            $titulo = $_GET['titulo'];
            $subtitulo = $_GET['subtitulo'];
            $conteudo = $_GET['conteudo'];
            $data = $_GET['data'];
            $editavel = $_GET['editavel'];
            $idCategoria = $_GET['idCategoria'];
        }

        
        $stmt = $conexao->prepare("INSERT INTO noticia values ($id, $titulo, $subtitulo, $conteudo, $data, $editavel, $idCategoria)");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            echo "<p>Usuário adicionado com sucesso</p>";
        } else {
            echo "<p>Houve algum problema ao adicionar a notícia</p>";
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

adicionarNoticia();