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
                $sql->bindValue(":s",md5($senha));
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

        
// 28/11________________________________________________________________________

        public function listarUsuarios()
        {
            global $pdo;
            
            $sql = $pdo->prepare("SELECT * FROM usuario");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            } else {
                return false;
            }
        }


        public function editarUsuario($nome, $email, $telefone, $senha)
        {
            global $pdo;
            
            $sql = $pdo->prepare("UPDATE usuario SET nome = :n, email = :e, telefone = :t, senha = :s WHERE id_usuario = :id");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":s", md5($senha));
            $sql->bindValue(":id", $id);
            $sql->execute();
            
            return true;
        }



// 03/12________________________________________________________________________

        public function atualizar($id_usuario, $nome, $email, $telefone, $senha)
        {
            global $pdo;
            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND id_usuario != :id");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
            
            if($sql->rowCount()>0)
            {
                return false;
            }
            else
            {
                $sql = $pdo->prepare("UPDATE usuario 
                SET 
                nome = :n, 
                telefone = :t, 
                email = :e, 
                senha = :s
                WHERE 
                id_usuario = :id");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->bindValue(":id", $id_usuario);
                $sql->execute();
                return true;
            }
        }

        public function deletar(int $id_usuario)
        {
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
        }
    }

?>