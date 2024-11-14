<!-- http://localhost/aulaphp140/TelaLogin/pages/login.php -->

<?php
    require_once '../classes/usuario.php';
    $usuario = new usuario();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TELA LOGIN TURMA 140</title>
</head>
<body>
    <ins><h1><mark>TELA LOGIN</mark></h1></ins>
    <form method="post">
        <label>Usuário:</label><br>
        <input type="email" name="email" placeholder="Digite o email do usuario."><br><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" placeholder="************************"><br><br>
        <input type="submit" value="LOGAR"><br>

        <a href="cadastro.php">Cadastre-se</a>
        

    </form>
    <?php
    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        if(!empty($email) && !empty($senha))
        {
            $usuario->conectar("cadastro140", "localhost", "root", "");
            if($usuario->msgErro == "")
            {
                if($usuario->logar($email, $senha))
                {
                    header("location: areaRestrita.php");
                }
                else
                {
                    ?>
                        <div class="msgErro">
                            <p> USUÁRIO NÃO CADASTRADO OU DADOS INCORRETOS.</p>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msgErro">
                        <?php echo "ERRO: " .$usuario->msgErro; ?>
                    </div>
                <?php
            }
        }
        else
        {
            ?>
                <div class="msg-erro">
                    <p>PREENCHA TODOS OS CAMPOS</p>
                </div>

            <?php
        }
    }
    ?>

</body>
</html>