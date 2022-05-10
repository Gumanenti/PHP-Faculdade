<?php

require_once "BancoDados.php";

function editarNoticia(){
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

        
        $stmt = $conexao->prepare("UPDATE noticia SET titulo=$titulo, subtitulo=$subtitulo, conteudo=$conteudo, data=$data, editavel=$editavel, idCategoria=$idCategoria WHERE id=$id");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            echo "<p>Usuário editado com sucesso</p>";
        } else {
            echo "<p>Houve algum problema ao editar a notícia</p>";
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

editarNoticia();