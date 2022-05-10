<?php

require_once "conexao.php";


/*$protocolo    = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false) ? 'http' : 'https';
$host         = $_SERVER['HTTP_HOST'];
$script       = $_SERVER['SCRIPT_NAME'];
$parametros   = $_SERVER['QUERY_STRING'];
$UrlAtual     = $protocolo . '://' . $host . $script . '?' . $parametros;*/
$metodo = $_SERVER['REQUEST_METHOD'];
//echo "$UrlAtual . <br>";
//$method = $_GET['method'];
//echo $metodo."<br>";

function isMetodo($metodo)
{
if (!strcasecmp($_SERVER['REQUEST_METHOD'], $metodo)) {
return true;
}
return false;
}

if(isMetodo('GET')){

  function listarNoticias(){
    try {
        $conexao = Conexao::getConexao();

        /*$id = $_GET['id'];
        echo $id;
        $empty = empty($_GET['id']);
        echo $empty;
        $isset = isset($_GET['id']);
        echo $isset;*/

        if(isset($_GET['id'])){
            
            $id = $_GET['id'];
            //echo $id;

            $stmt = $conexao->prepare("SELECT * FROM noticia WHERE id=$id");
            $stmt->execute();

            if($stmt->rowCount()>0){
                foreach($stmt as $noticia){ 
                  echo json_encode($noticia);
                }
            } else {
                echo "<p>Houve algum problema ao listar as notícias</p>";
                json_last_error_msg();
            }
        }

        if(empty($_GET['id'])){

            $stmt = $conexao->prepare("SELECT * FROM noticia ORDER BY id");
            $stmt->execute();

            if($stmt->rowCount()>0){
                foreach($stmt as $noticia){ 
                  echo json_encode($noticia);
                }
            } else {
                echo "<p>Houve algum problema ao listar as notícias</p>";
                json_last_error_msg();
            }

        }
            
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }
}
return listarNoticias();

}


if(isMetodo('POST')){
  function adicionarNoticia(){
    try {
        $conexao = Conexao::getConexao();

        $id = $_GET['id'];
        $titulo = $_GET['titulo'];
        $subtitulo = $_GET['subtitulo'];
        $conteudo = $_GET['conteudo'];
        $data = $_GET['data'];
        $editavel = $_GET['editavel'];
        $idCategoria = $_GET['idCategoria'];

        
        $stmt = $conexao->prepare("INSERT INTO noticia values ($id, '$titulo', '$subtitulo', '$conteudo', $data, $editavel, $idCategoria)");
        $stmt->execute();
        

        if($stmt->rowCount()>0){

            $dados= [
                'id' => $id,
                'titulo' => $titulo,
                'subtitulo' => $_GET['subtitulo'],
                'conteudo' => $_GET['conteudo'],
                'data' => $_GET['data'],
                'editavel' => $_GET['editavel'],
                'idCategoria' => $_GET['idCategoria'],
            ];
    
            echo json_encode($dados);

        } else {
            echo "<p>Houve algum problema ao adicionar a notícia</p>";
            json_last_error_msg();
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

return adicionarNoticia();
}


if(isMetodo('DELETE')){
  echo 'requisicao delete';

  function excluirNoticia(){
    try {
        $conexao = Conexao::getConexao();
        /*if(isset($_GET['id'])){ 
            $id = $_GET['id'];
        }*/

        $id = $_GET['id'];
        //echo $id;
        
        $stmt = $conexao->prepare("DELETE FROM noticia WHERE id=$id");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            //$mensagem = "Noticia ".$id." excluida com sucesso";
            $dados = [
                'Noticia Deletada' => $id,
            ];
            echo json_encode($dados);

        } else {
            echo "<p>Houve algum problema ao deletar a noticia</p>";
            json_last_error_msg();
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

return excluirNoticia();

}


if(isMetodo('PUT')){
  echo 'requisicao put';

  function editarNoticia(){
    try {
        $conexao = Conexao::getConexao();
        
        $id = $_GET['id'];
        $titulo = $_GET['titulo'];
        $subtitulo = $_GET['subtitulo'];
        $conteudo = $_GET['conteudo'];
        $data = $_GET['data'];
        $editavel = $_GET['editavel'];
        $idCategoria = $_GET['idCategoria'];

        
        $stmt = $conexao->prepare("UPDATE noticia SET titulo='$titulo', subtitulo='$subtitulo', conteudo='$conteudo', data=$data, editavel=$editavel, idCategoria=$idCategoria WHERE id=$id");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            //echo "<p>Usuário editado com sucesso</p>";
            $dados= [
                'id' => $id,
                'titulo' => $titulo,
                'subtitulo' => $_GET['subtitulo'],
                'conteudo' => $_GET['conteudo'],
                'data' => $_GET['data'],
                'editavel' => $_GET['editavel'],
                'idCategoria' => $_GET['idCategoria'],
            ];

            echo json_encode($dados);

        } else {
            echo "<p>Houve algum problema ao editar a notícia</p>";
            json_last_error_msg();
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

return editarNoticia();

}