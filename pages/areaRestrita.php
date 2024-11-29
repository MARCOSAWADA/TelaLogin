<!-- http://localhost/aulaphp140/TelaLogin/pages/areaRestrita.php -->


<?php

    require_once '../classes/usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastro140", "localhost", "root", "");
    $usuariosCadastrados = $usuario->listarUsuarios();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArEa ReStRiTa</title>
</head>
<body>
    <h1><mark>USUÁRIOS CADASTRADOS</h1>
    <table border='100'>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($usuariosCadastrados))
                {
                    foreach($usuariosCadastrados as $dados):
            ?>
            <tr>
                <td><?php echo $dados['nome'] ?></td>
                <td><?php echo $dados['email'] ?></td>
                <td><?php echo $dados['telefone'] ?></td>
            </tr>
            <?php
                endforeach;
                }
                else
                {
                    echo "Nenhum registro encontrado";
                }
            ?>
        </tbody>
    </table>
</body>
</html>