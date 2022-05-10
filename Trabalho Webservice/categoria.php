<?php

require_once "BancoDados.php";

function listarCategoria(){
    try {
        $conexao = Conexao::getConexao();
        if(isset($_GET['id'])){ 
            $id = $_GET['id'];
        }

        $stmt = $conexao->prepare("SELECT * FROM noticia where id=$id");//Seleciona as colunas id, nome, login, senha da table pessoas
        $stmt->execute();
        
        

        foreach($stmt as $linha){
            echo"<tr>";
                echo"<td> ".$linha['id'] ." </td>";
                echo"<td> ".$linha['titulo'] ." </td>";
                echo"<td> ".$linha['subtitulo'] ." </td>";
                echo"<td> ".$linha['conteudo'] ." </td>";
                echo"<td> ".$linha['data'] ." </td>";
                echo"<td> ".$linha['editavel'] ." </td>";
                echo"<td> ".$linha['idCategoria'] ." </td>";
            echo"<tr>";
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

listarCategoria();