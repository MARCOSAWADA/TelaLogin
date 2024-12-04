<!-- http://localhost/AulaPHP140/TelaLogin/pages/atualizarUsuario.php -->

<?php

    require_once '../classes/usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastro140", "localhost", "root", "");

    #Verificar o método de requisição e existência de dados
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario']))
    {
        $id_usuario = (int)$_POST['id_usuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $confSenha = $_POST['confSenha'];

        if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha))
        {
            if($senha == $confSenha)
            {
                if($usuario->atualizar($id_usuario, $nome, $email, $telefone, $senha))
                {
                    echo "Dados atualizados com sucesso.";
                    header("Location: areaRestrita.php");
                }
                else
                {
                    echo "Erro: Email já utilizado por outro usuário.";
                }
            }
            else
            {
                echo "Senha e confirmar senha não conferem.";
            }
        }
        else
        {
            echo "Preencha todos os campos.";
        }
    }
    else
    {
        echo "Erro: ID do usuário não encontrado.";
    }

?>