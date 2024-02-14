<?php
	 
	session_start(); 
	session_destroy();
	require_once "banco.php";
        mysqli_set_charset($conexao, "utf8");
	
/*
        if (isset($_POST['cadas'])) { $_SESSION['lista_tarefas'][] = $_POST['inputNome']; }

        $lista_tarefas = array();

        if (isset($_SESSION['lista_tarefas'])) { $lista_tarefas = $_SESSION['lista_tarefas']; }
*/

         if (isset($_POST['cadas'])) { 

         	$tarefa = array();
			//$tarefa['nome'] = $_POST['inputNome'];

                        if ($_POST['inputNome'] != '') { 
                                $tarefa['nome'] = $_POST['inputNome'];
                               
                        };
                        $tarefa['descricao'] = $_POST['inputDescricao'];
                        $tarefa['qtd'] = $_POST['inputQuantidade'];
                        $tarefa['categoria'] = $_POST['inputCategoria'];
                        $tarefa['cor'] = $_POST['inputCor'];
                        $tarefa['vcompra'] = $_POST['inputCompra'];
                        $tarefa['tamanho'] = $_POST['inputTamanho'];
                     
                        if ($_POST['inputMarca'] != '') { $tarefa['marca'] = $_POST['inputMarca']; }; 
                        if ($_POST['inputPreco'] != '') { $tarefa['preco'] = $_POST['inputPreco']; }; 
           
                
                       
                            $img = $_FILES["inputImg"];
	
                            move_uploaded_file($img["tmp_name"], "../img/produto/".$img["name"]);
                            
                        $tarefa['img'] = $img["name"]; 
           

         //	$_SESSION['lista_tarefas'][] =  $_POST['inputNome']; 
         //	$_SESSION['lista_tarefas'][] = $tarefa;
         	gravar_tarefa($conexao, $tarefa);


         } 

   

         if (isset($_SESSION['lista_tarefas'])) { $lista_tarefas = $_SESSION['lista_tarefas']; } else { $lista_tarefas = array(); }


 	$lista_tarefas = buscar_tarefas($conexao);

         if (isset($_SESSION['lista_pessoas'])) { $lista_pessoas = $_SESSION['lista_pessoas']; } else { $lista_pessoas = array(); }


 	$lista_pessoas = buscar_pessoas($conexao);

/*
 foreach ($lista_tarefas as $tarefa) :
  //   echo "<br>".$tarefa['nome_produto'];
  echo json_encode($tarefa) . "<br>";

  endforeach;  
  */


  if (isset($_POST['cadastrar_btn'])) { 

           $tarefa = array();
                  //$tarefa['nome'] = $_POST['inputNome'];

              //    if ($_POST['floatingNome'] != '') { 
                $tarefa['nome'] = $_POST['floatingNome'];
                         
             //     };
             $tarefa['numero'] = $_POST['floatingNumero'];
             $tarefa['email'] = $_POST['floatingEmail'];
             $tarefa['senha'] = $_POST['floatingPassword'];
       
                   $img = $_FILES["floatingPerfil"];
  
                   move_uploaded_file($img["tmp_name"], "../img/clients/".$img["name"]);
                      
                   $tarefa['img'] = $img["name"]; 
/*
                  $sql = "INSERT INTO tb_pessoa (nome, numero, email, senha, foto) VALUES ('$nome', '$numero', '$email', ' $pass', ' $novaPic')";
    
   // move_uploaded_file($_FILES['musica']['tmp_name'],'audio/'.$musica);
	
		if(mysqli_query($conexao, $sql)):
	//	$_SESSION['mensagem'] = "Cadastrado com sucesso";
        header('Location: ../index_home.php?sucesso');
       
	//	echo "Cadastro com Sucesso";
		else:
	//	$_SESSION['mensagem'] = "Erro de cadastro";
        header('Location: ../index_home.php?Error');
	//		echo "erro de cadastro";
		endif;
     */

   //	$_SESSION['lista_tarefas'][] =  $_POST['inputNome']; 
   //	$_SESSION['lista_tarefas'][] = $tarefa;
           cadastrar_usuario($conexao, $tarefa);


   } 

?>