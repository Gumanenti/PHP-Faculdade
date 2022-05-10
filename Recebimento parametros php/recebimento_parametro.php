<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Recebe Parametros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
      <div class="container">
        <div class="row">
          <div class="col-3" id="lado-esquerdo">
          </div>
          
          <div class="col-6" id="centro">
          <form method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome:</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Idade:</label>
                <input type="number" class="form-control" name="idade" placeholder="Idade">
            </div>

            <h6>Sexo:</h6>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" value="Masculino" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Masculino
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" value="Feminino">
                <label class="form-check-label" for="exampleRadios2">
                    Feminino
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" value="Outro">
                <label class="form-check-label" for="exampleRadios2">
                    Outro
                </label>
            </div>
            <h6>Selecione Frutas: </h6>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Abacaxi" name="frutas[]">
                <label class="form-check-label" for="defaultCheck1">
                    Abacaxi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Banana" name="frutas[]">
                <label class="form-check-label" for="defaultCheck1">
                    Banana
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Morango" name="frutas[]">
                <label class="form-check-label" for="defaultCheck1">
                    Morango
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Limão" name="frutas[]">
                <label class="form-check-label" for="defaultCheck1">
                    Limão
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Uvaia" name="frutas[]">
                <label class="form-check-label" for="defaultCheck1">
                    Uvaia
                </label>
            </div>

            <button>Enviar</button>
            </form>
          </div>
          
          <div class="col-3" id="lado-direito">
          </div>
        </div>
      </div>
      <?php

        if (isset($_POST["nome"]) and !empty($_POST["nome"])) {
            $nome = $_POST["nome"];
            //echo strlen($nome);
            if(strlen($nome)<5 or strlen($nome)>11){
                echo "<p>Nome com tamanho (acima/abaixo) do esperado.</p>";
            }
        } else {
            echo "<p>Nome não foi enviado.</p>";
        }
        
        if (isset($_POST["idade"]) and !empty($_POST["idade"])) {
            $idade = $_POST["idade"];
            if($idade < 18 or $idade > 60){
                echo "Idade (acima/abaixo) do limite esperado.";
            }

        } else {
            echo "<p>A idade não foi enviada.</p>";
        }

        if (isset($_POST["sexo"]) and !empty($_POST["sexo"])) {
            $sexo = $_POST["sexo"];
        } else {
            echo "<p>Sexo não foi enviado.</p>";
        }

        if (isset($_POST["frutas"]) and !empty($_POST["frutas"])) {
            $frutasEscolhidas = $_POST["frutas"];
        } else {
            echo "<p>Nenhuma fruta foi enviada.</p>";
        }

        if (isset($_POST["idade"]) and !empty($_POST["idade"])) {
            $idade = $_POST["idade"];
            if($idade > 17 and $idade < 61){
                if (isset($_POST["sexo"]) and !empty($_POST["sexo"])) {
                    if (isset($_POST["nome"]) and !empty($_POST["nome"])) {
                        $nome = $_POST["nome"];
                        if(strlen($nome)>5 and strlen($nome)<11){
                            if (isset($_POST["frutas"]) and !empty($_POST["frutas"])) {
                                $frutasEscolhidas = $_POST["frutas"];
                                echo "<p>Olá $nome, vejo que você tem $idade anos e é do sexo $sexo. Vejo que você gosta das frutas:</p>";
                                for ($i=0; $i<count($frutasEscolhidas); $i++) {
                                    echo "<li>" . $frutasEscolhidas[$i] . "</li><br>";
                                }
                                }
                        }
                    }
                }
            }

        } else {
            echo "";
        }

        if (isset($_POST["idade"]) and !empty($_POST["idade"])) {
            $idade = $_POST["idade"];
            if($idade > 17 and $idade < 61){
                if (isset($_POST["sexo"]) and !empty($_POST["sexo"])) {
                    if (isset($_POST["nome"]) and !empty($_POST["nome"])) {
                        $nome = $_POST["nome"];
                        if(strlen($nome)>5 and strlen($nome)<11){
                            if (empty($_POST["frutas"]) == true) {
                                //$frutasEscolhidas = $_POST["frutas"];
                                echo "<p>Olá $nome, vejo que você tem $idade anos e é do sexo $sexo. Você não gosta de nenhuma fruta mesmo?</p>";
                                /*for ($i=0; $i<count($frutasEscolhidas); $i++) {
                                    echo "<li>" . $frutasEscolhidas[$i] . "</li><br>";
                                }*/
                                }
                        }
                    }
                }
            }

        } else {
            echo "";
        }

      ?>
</body>

</html>