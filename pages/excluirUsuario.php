<!-- http://localhost/AulaPHP140/TelaLogin/pages/excluirUsuario.php -->

<?php

    require_once '../classes/usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastro140", "localhost", "root", "");

    if(isset($_POST['id_usuario']))
    {
        $id_usuario = (int)$_POST['id_usuario'];
        $usuario->deletar($id_usuario);
        header("Location: areaRestrita.php");
        exit;
    }
    else
    {
        echo "Erro ao selecionar o ID.";
    }
?>