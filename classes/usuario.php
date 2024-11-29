<?php

    Class Usuario
    {
        private $pdo;
        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            try
            {
                $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
            }
            catch(PDOException $erro)
            {
                $msgErro = $erro->getMessage();
            }

        }

        public function cadastroUsuario($nome, $email, $telefone, $senha)
        {
            global $pdo;

            //verificar se ja existe um e-mail cadastrado
            $sql = $pdo->prepare("SELECT id_usuario from usuario WHERE email= :e");
            $sql->bindValue(":e",$email);
            $sql->execute();
            if($sql->rowCount()>0)
            {
                return false;
            }
            else
            {
                $sql = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, senha) VALUES (:n, :e, :t, :s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":s",$senha);
                $sql->execute();
                return true;
            }
        }

        public function logar($email, $senha)
        {
            global $pdo;

            $verificarEmailSenha = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s");
            $verificarEmailSenha->bindValue(":e", $email);
            $verificarEmailSenha->bindValue(":s", md5($senha));
            $verificarEmailSenha->execute();

            if($verificarEmailSenha->rowCount()>0)
            {
                $dados = $verificarEmailSenha->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_dados'];
                return true;
            }
            else{
                return false;
            }
        }
    }

?>