<?php

require_once "BancoDados.php";

function excluirNoticia(){
    try {
        $conexao = Conexao::getConexao();
        if(isset($_GET['id'])){ 
            $id = $_GET['id'];
        }

        
        $stmt = $conexao->prepare("DELETE FROM noticia WHERE id=$id and editavel=true");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            echo "<p>Usuário excluído com sucesso</p>";
        } else {
            echo "<p>Houve algum problema ao deletar a notícia</p>";
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

excluirNoticia();