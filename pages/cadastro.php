<!-- http://localhost/aulaphp140/TelaLogin/pages/cadastro.php -->

<?php
    require_once '../classes/usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TELA CADASTRO</title>
</head>
<body>
    <h1><mark><b><font color="green">TELA DE CADASTRO DE USUÁRIO</font></b></mark></h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" placeholder="Digite o nome completo"><br><br>
        <label>E-mail:</label><br>
        <input type="email" name="email" placeholder="Digite o e-mail"><br><br>
        <label>Telefone:</label><br>
        <input type="telefone" name="telefone" placeholder="Digite o número do telefone"><br><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" placeholder="Criar uma senha"><br><br>
        <label>Confirmar Senha:</label><br>
        <input type="password" name="confSenha" placeholder="Confirmar sua senha."><br><br>
        
        <input type="submit" value="CADASTRAR"><br>

        <p>Já cadastrado&#10067; Clique <a href="login.php">&#10145;&#65039;<mark>AQUI</mark></a>&#11013;&#65039; para acessar.</p>
    </form>

        <!-- isset = se existe -->
    <?php
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];
            $confirmarSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($confirmarSenha))
            {
                $usuario->conectar("cadastro140", "localhost", "root", "");
                if($usuario->msgErro == "")
                {
                    if($senha == $confirmarSenha)
                    {
                        if($usuario->cadastroUsuario($nome, $email, $telefone, $senha))
                        {
                            ?>
                            <div class="msg-sucesso">
                                <font color="red"><p>Cadastro realizado com sucesso.</p></font>
                                <p>Clique aqui para <a href="login.php">logar.</a></p>
                            </div>
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                            <?php echo "ERROOOOOOOOOOOOO: ".$usuario->msgErro; ?>
                        </div>
                        <?php  
                    }
                }
                else
                {
                    
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                    <h1><font color="red"><p>Preencha todos os campos.</p></font>
                    </div>
                <?php
            }
        }
    ?>

</body>
</html>