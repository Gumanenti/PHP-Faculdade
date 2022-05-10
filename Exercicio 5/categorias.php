<?php
require_once "conexao.php";


/*$protocolo    = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false) ? 'http' : 'https';
$host         = $_SERVER['HTTP_HOST'];
$script       = $_SERVER['SCRIPT_NAME'];
$parametros   = $_SERVER['QUERY_STRING'];
$UrlAtual     = $protocolo . '://' . $host . $script . '?' . $parametros;*/
$metodo = $_SERVER['REQUEST_METHOD'];

function isMetodo($metodo)
{
if (!strcasecmp($_SERVER['REQUEST_METHOD'], $metodo)) {
return true;
}
return false;
}

if(isMetodo('GET')){

    function listarCategorias(){
      try {
          $conexao = Conexao::getConexao();
  
          /*$id = $_GET['id'];
          $empyt = empty($_GET['id']);
          echo $empyt;
          $isset = isset($_GET['id']);
          echo $isset;*/
          
          if(empty($_GET['id']) and isset($_GET['id'])){
              //echo 'vamos';
              $id = $_GET['id'];
              //echo $id;
              $stmt = $conexao->prepare("SELECT * FROM categoria WHERE id=$id");
              $stmt->execute();

              if($stmt->rowCount()>0){
                    foreach($stmt as $categoria){ 
                    echo json_encode($categoria);
                    }
                } else {
                    echo "<p>Houve algum problema ao listar a Categoria</p>";
                    json_last_error_msg();
                }

          } else {
              //echo 'nao vamos';
              $stmt = $conexao->prepare("SELECT * FROM categoria ORDER BY id");
              $stmt->execute();

              if($stmt->rowCount()>0){
                    foreach($stmt as $categoria){ 
                    echo json_encode($categoria);
                    }
                } else {
                    echo "<p>Houve algum problema ao listar a Categoria</p>";
                    json_last_error_msg();
                }
          }

          /*$stmt = $conexao->prepare("SELECT * FROM categoria WHERE id=$id");
          //$stmt = $conexao->prepare("SELECT * FROM categoria ORDER BY id");
          $stmt->execute();
        
        if($stmt->rowCount()>0){
            foreach($stmt as $categoria){ 
              echo json_encode($categoria);
            }
        } else {
            echo "<p>Houve algum problema ao adicionar a Categoria</p>";
            json_last_error_msg();
        }*/
              
          
      }catch (Exception $th) {
          echo $th->getMessage();
          exit;
      }
  }
  return listarCategorias();
  
  }


if(isMetodo('POST')){
  function adicionarCategoria(){
    try {
        $conexao = Conexao::getConexao();
        
        $id = $_GET['id'];
        //echo $id;
        $nome = $_GET['nome'];
        //echo $nome;

        
        $stmt = $conexao->prepare("INSERT INTO categoria (id, nome) values ('$id', '$nome')");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            //echo "<p>Usuário adicionado com sucesso</p><br>";
            $dados = [
                'id' => $id,
                'nome' => $nome,
            ];
            echo json_encode($dados);
        } else {
            echo "<p>Houve algum problema ao adicionar a notícia</p>";
            json_last_error_msg();
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        echo "<p>Houve algum problema ao adicionar a notícia</p>";
        exit;
    }

}

return adicionarCategoria();
}


if(isMetodo('DELETE')){
  echo 'requisicao delete';

  function excluirCategoria(){
    try {
        $conexao = Conexao::getConexao();
        /*if(isset($_GET['id'])){ 
            $id = $_GET['id'];
        }*/

        $id = $_GET['id'];
        echo $id;
        
        $stmt = $conexao->prepare("DELETE FROM categoria WHERE id=$id");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            //echo "<p>Categoria excluida com sucesso</p>";

            $dados = [
                'Categoria Deletada' => $id,
            ];
            echo json_encode($dados);

        } else {
            echo "<p>Houve algum problema ao deletar a categoria</p>";
            json_last_error_msg();
        }
        
    }catch (Exception $th) {
        echo $th->getMessage();
        exit;
    }

}

return excluirCategoria();

}


if(isMetodo('PUT')){
  echo 'requisicao put';

  function editarCategoria(){
    try {
        $conexao = Conexao::getConexao();
        if(isset($_GET['id'])){ 
            $id = $_GET['id'];
            $nome = $_GET['nome'];
        }

        
        $stmt = $conexao->prepare("UPDATE categoria SET nome='$nome' WHERE id=$id");
        $stmt->execute();
        

        if($stmt->rowCount()>0){
            //echo "<p>Usuário editado com sucesso</p>";

            $dados = [
                'id' => $id,
                'nome' => $nome,
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

return editarCategoria();

}

?>
