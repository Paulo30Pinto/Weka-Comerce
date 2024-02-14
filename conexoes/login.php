<?php
session_start();
require_once "banco.php";

if (isset($_POST['btn-entrar'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $traz_dados = "SELECT email FROM tb_pessoa WHERE email LIKE '$username'";
    $resultado = mysqli_query($conexao, $traz_dados);
    // Verificar as credenciais do usuário em seu sistema de autenticação
    if (mysqli_num_rows($resultado) > 0) {
        // Se as credenciais forem válidas, inicie uma sessão e redirecione para a página de perfil
        $traz_dados1 = "SELECT * FROM tb_pessoa WHERE email LIKE '$username' AND senha  LIKE '$password'";
        $resultado1 = mysqli_query($conexao, $traz_dados1);
        if(mysqli_num_rows($resultado1) == 1){
            $dados = mysqli_fetch_array($resultado1);
            $_SESSION['logado'] = true;
            $_SESSION['user_id'] = $dados['id_pessoa'];
            header('Location: ../index_home.php?sucesso');
        }else{
            header('Location: ../index_home.php?Invalido');
        }
        //$dados = mysqli_fetch_array($resultado);

     
        exit();
    } else {
        // Se as credenciais forem inválidas, exiba uma mensagem de erro
      //  echo "Usuário ou senha inválidos.";
        header('Location: ../index_home.php?Sem Registro');
    }
}
    mysqli_close($conexao);
?>
