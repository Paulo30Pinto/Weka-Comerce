<?php
    $bdServidor = 'localhost';
    $bdUsuario = 'root';
    $bdSenha = '';
    $bdBanco = 'weka_commerce';

    $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);
    mysqli_set_charset($conexao, "utf8");

  /*  if(mysqli_connect_errno($conexao)) {
        echo "Problemas para conectar no banco. Verifique os dados!" .mysqli_connect_errno($conexao);
        die();
        } */

    function buscar_tarefas($conexao) { $sqlBusca = 'SELECT * FROM tb_produto'; $resultado = mysqli_query($conexao, $sqlBusca);
        $tarefas = array();
        while ($tarefa = mysqli_fetch_assoc($resultado)) { $tarefas[] = $tarefa; }
        return $tarefas;
}

function buscar_pessoas($conexao) { $sqlBusca = 'SELECT * FROM tb_pessoa'; $resultado = mysqli_query($conexao, $sqlBusca);
    $tarefas = array();
    while ($tarefa = mysqli_fetch_assoc($resultado)) { $tarefas[] = $tarefa; }
    return $tarefas;
}

    
    function gravar_tarefa($conexao, $tarefa) { 
       
        $sqlGravar = "INSERT INTO tb_produto (id_produto, nome_produto, descricao, quantidade, imagem_produto, categoria, marca, valor_compra, valor_venda, cor, tamanho) VALUES (
            (SELECT MAX(p.id_produto)+1 as id_produto FROM tb_produto p)
            , '{$tarefa['nome']}', '{$tarefa['descricao']}', {$tarefa['qtd']}, '{$tarefa['img']}', '{$tarefa['categoria']}', '{$tarefa['marca']}', {$tarefa['vcompra']}, {$tarefa['preco']}, '{$tarefa['cor']}', '{$tarefa['tamanho']}')
";
   // mysqli_query($conexao, $sqlGravar);

    if(mysqli_query($conexao, $sqlGravar)):
        //	$_SESSION['mensagem'] = "Cadastrado com sucesso";
            header('Location: ../admin.php?sucesso');
           
        //	echo "Cadastro com Sucesso";
            else:
        //	$_SESSION['mensagem'] = "Erro de cadastro";
            header('Location: ../admin.php?Error');
        //		echo "erro de cadastro";
    endif;
}


    function cadastrar_usuario($conexao, $tarefa){
        $sqlGravar = "INSERT INTO tb_pessoa (id_pessoa, nome, numero, email, senha, foto) VALUES (
            (SELECT MAX(p.id_pessoa)+1 as id_pessoa FROM tb_pessoa p)
            , '{$tarefa['nome']}', '{$tarefa['numero']}', '{$tarefa['email']}', '{$tarefa['senha']}', '{$tarefa['img']}')
";

        if(mysqli_query($conexao, $sqlGravar)):
            //	$_SESSION['mensagem'] = "Cadastrado com sucesso";
                header('Location: ../index_home.php?sucesso');
               
            //	echo "Cadastro com Sucesso";
                else:
            //	$_SESSION['mensagem'] = "Erro de cadastro";
                header('Location: ../index_home.php?Error');
            //		echo "erro de cadastro";
        endif;
    }

   