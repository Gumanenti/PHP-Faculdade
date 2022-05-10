<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Carros</title>
</head>

<body>
    <?php
    require_once "BancoDados.php";

    if (isset($_POST["nome"]) and !empty($_POST["nome"]) and
    isset($_POST["login"]) and !empty($_POST["login"]) and
    isset($_POST["senha"]) and !empty($_POST["senha"]) and
    isset($_POST["id"]) and !empty($_POST["id"]) and
    isset($_POST["op"]) and $_POST["op"] == "editarPessoa") {
        $nome = $_POST["nome"];
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        $id = $_POST["id"];


        try {
            $conexao = Conexao::getConexao();

            $stmt = $conexao->prepare("UPDATE pessoas SET nome=?, login=?, senha=? WHERE id=?");
            $stmt->execute([$nome, $login, $senha, $id]);

            if ($stmt->rowCount() > 0) {
                echo "<p>O usuário foi editado com sucesso!</p>";
            } else {
                echo "<p>Houve algum problema na edição!</p>";
            }
        } catch (Exception $th) {
            echo $th->getMessage();
            exit;
        }
    }

if (isset($_POST["nome"]) and !empty($_POST["nome"]) and
    isset($_POST["login"]) and !empty($_POST["login"]) and
    isset($_POST["senha"]) and !empty($_POST["senha"]) and
    isset($_POST["op"]) and $_POST["op"] == "cadastrarPessoa") {

        // Idealmente, verifica a validade de cada campo.

    $nome = $_POST["nome"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    try {
        // INSERT INTO Pessoas(nome,login,senha) VALUES ('Tiago', 'senha@senha.com', '123456');

        $conexao = Conexao::getConexao();
        // $stmt = $conexao->prepare("INSERT INTO pessoas(nome,login,senha) VALUES (?, ?, ?)");
        // $stmt->execute([$nome, $login, $senha]);


        $stmt = $conexao->prepare("INSERT INTO pessoas(nome,login,senha) VALUES (:p1, :p2, :p3)");
        $stmt->execute([
            "p1" => $nome,
            "p2" => $login,
            "p3" =>$senha
        ]);

        if ($stmt->rowCount() > 0) {
            echo "<p>O usuário foi cadastrado com sucesso!</p>";
        } else {
            echo "<p>Houve algum problema no cadastro!</p>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        die;
    }
}
    ?>

    <header>
        <h1>Loja de carros mágicos</h1>
        <h2>Você entra rico e triste, sai pobre e mais triste ainda</h2>
    </header>
    <main>
        <h2>Cadastrar pessoa</h2>
        <form method="POST">
            <p>Nome:</p>
            <input type="text" name="nome" required>
            <p>Login:</p>
            <input type="email" name="login" required>
            <p>Senha:</p>
            <input type="password" name="senha" minlength="5" required>
            <br>
            <input type="hidden" name="op" value="cadastrarPessoa">
            <button>Cadastrar</button>
        </form>
        <hr>
        <h2>Editar pessoa</h2>
        <form method="POST">
            <p>ID:</p>
            <input type="number" name="id" required>
            <p>Nome:</p>
            <input type="text" name="nome" required>
            <p>Login:</p>
            <input type="email" name="login" required>
            <p>Senha:</p>
            <input type="password" name="senha" minlength="5" required>
            <br>
            <input type="hidden" name="op" value="editarPessoa">
            <button>Editar</button>
        </form>
        <hr>
        <h2>Deletar pessoa</h2>
        <form method="POST">
            <p>ID:</p>
            <select name="id">
                <?php
                    $lista = listarPessoas_fetch();
                    for ($i=0; $i<count($lista); $i++) {
                        $id = $lista[$i]["id"];
                        $nome = $lista[$i]["nome"];
                        echo "<option value='$id'>$nome</option>";
                    }
                ?>
            </select>
            <br>
            <button>Deletar</button>
        </form>
        <hr>

        <h2>Lista de pessoas cadastradas</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Senha</th>
                </tr>
            </thead>
            <tbody>
                <?php listarPessoas(); ?>
            </tbody>
        </table>


    </main>

    <?php

    function listarPessoas_fetch()
    {
        $lista = [];
        try {
            $conexao = Conexao::getConexao();

            $stmt = $conexao->prepare("SELECT id, nome FROM pessoas ORDER BY nome");
            $stmt->execute();

            $lista = $stmt->fetchAll();
        } catch (Exception $th) {
            echo $th->getMessage();
            exit;
        }
        return $lista;
    }

       

        function listarPessoas()
        {
            try {
                $conexao = Conexao::getConexao();

                $stmt = $conexao->prepare("SELECT id, nome, login, senha FROM pessoas ORDER BY id");
                $stmt->execute();

                foreach ($stmt as $linha) {
                    echo "<tr>";
                    echo "<td>" . $linha["id"] . "</td>";
                    echo "<td>" . $linha["nome"] . "</td>";
                    echo "<td>" . $linha["login"] . "</td>";
                    echo "<td>" . $linha["senha"] . "</td>";
                    echo "</tr>";
                }
            } catch (Exception $th) {
                echo $th->getMessage();
                exit;
            }
        }

     

        ?>
</body>

</html>