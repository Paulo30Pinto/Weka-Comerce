<?php 
    session_start();
   
   require_once "conexoes/banco.php";
   mysqli_set_charset($conexao, "utf8");


  

 // Verificar se a sessão está definida
 /*
if (isset($_SESSION['user_id'])) {
  // Se não houver uma sessão definida, redirecionar para a página de login
  /*echo"<META HTTP-EQUIV=REFRESH CONTENT='0;URL=http://localhost/PHP/bibliotecaCNT/index_home.php'>
  <script type=\"text/javascript\">alert(\"com secssao\");</script>";  */
 // exit();
 // session_abort();
 // session_destroy();
// echo "Bem-vindo, " . $_SESSION['username'] . "!";
 /* $id_us = $_SESSION['user_id'];
  $selecao = "SELECT * FROM tb_pessoa WHERE id_pessoa LIKE '$id_us'";
  $resultou = mysqli_query($conexao, $selecao);
  $dados = mysqli_fetch_array($resultou);

}else{
  session_unset();
  session_destroy();
} 
*/

if (isset($_SESSION['lista_tarefas'])) { $lista_tarefas = $_SESSION['lista_tarefas']; } else { $lista_tarefas = array(); }


$lista_tarefas = buscar_tarefas($conexao);


 
 if (isset($_POST['add'])) {
    // code...
    //print_r($_POST['id_produto']);
    if (isset($_SESSION['cart'])) {
      // code...

      $item_array_id = array_column($_SESSION['cart'], 'id_produto');
     // $item_array_id = array($_SESSION['cart'], 'id_produto');
     // print_r($item_array_id);

      if(in_array($_POST['id_produto'], $item_array_id)){
        echo "<script>alert('Item já existe no carrinho')</script>";
        echo "<script>window.location='index_home.php'</script>";

      }else {
        // code...
        $count = count($_SESSION['cart']);
        $item_array = array(
          'id_produto'=>$_POST['id_produto']
        );
          $_SESSION['cart'][$count] = $item_array;
        //  print_r($_SESSION['cart']);
      }

    }else {
      // code...
      $item_array = array(
        'id_produto'=>$_POST['id_produto']
      );

      $_SESSION['cart'][0] = $item_array;
      //print_r($_SESSION['cart']);
    }
  }


    if(isset($_POST['remove'])){
    //print_r($_GET['id']);
    if($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value) {
        // code...
        if ($value['id_produto'] == $_GET['id']) {
          // code...
          unset($_SESSION['cart'][$key]);
          echo "<script>alert('Produto foi removido')
                window.location = 'index_home.php'
          </script>";

        }
      }
    }
  } else{
    echo "Todo Certo";
  }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <title>WEKA_COMERCE</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->

  <link href="img/logo/branco.png" rel="apple-touch-icon">
  <link rel="shortcut icon" href="img/logo/Black.png" type="image/x-icon">
  <link href="img/logo/weka2.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Autor: Aguinaldo Mavenda
    URL: https://mavenda.vercel.appbiz
  ======================================================= -->
<style>
  [id="popovers"] .bd-example .btn,

  .about-cols .about-col .img{
  /* border: solid 1px red; */
   min-height: 25px;
  }

    #cart_count{
      text-align: center;
      padding: 0 0.9rem 0.1rem 0.9rem;
      border-radius: 3rem;
      font-size: 16px;
    }
</style>

</head>

<body>

    <div id="preloader" hidden>
        <div class="inner">
           <!-- HTML DA ANIMAÇÃO MUITO LOUCA DO SEU PRELOADER! -->
           <div class="bolas">
              <div></div>
              <div></div>
              <div></div>
           </div>
        </div>
    </div>

  <!--==========================
    Header
  ============================-->
  <div class="container d-none" id="formulario">
    <form action="" class="" id="pesqForm">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="pesquisar produtos" aria-label="pesquisar produtos" aria-describedby="basic-addon2">
        <span class="btn btn-primary" id="basic-addon2">pesquisar</span>
      </div>
    </form>
  </div>
  <header id="header">

    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <!--<h1><a href="#intro" class="scrollto">BizPage</a></h1>-->
        <!-- Uncomment below if you prefer to use an image logo -->
        <div id="menuLogo"></div>
        
        <a href="#" id="pesq-mobile" class="pesq">
          <div class="icon"><i class="fa fa-search" style="font-size: 18px;"></i></div>
         </a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li id="btn_home" class="btn_home menu-active"><a href="#" class="">Home</a></li>
          <li id="btn_prod" class="btn_prod"><a href="#">Produtos</a></li>
          <li id="btn_loja" class="btn_loja"><a href="#" clas="">Loja</a></li>
          <li id="btn_sobre" class="btn_sobre"><a href="#">Sobre</a></li>
          <li id="btn_new" class="btn_new"><a href="#">Noticias</a></li>
          <li hidden><a href="#">
            <div class="icon" id="carrinho"><i class="fa fa-shopping-bag" style="font-size: 18px;"></i>
              <span class="badge bg-danger rounded-pill" style="font-size: 14px;">3</span>
            </div>
          </a></li>
          <li class="menu-has-children position-relative"><a href="#!" class="sf-with-ul">Perfil</a>

              <span class="bg-danger" id="notificacao"></span>

            <ul style="display: none;">
              <li><a href="#" data-bs-toggle="modal" data-bs-target="#modaLogin">
                <i class="fa fa-user"></i>
                Login</a></li>
              <li><a href="#" data-bs-toggle="modal" data-bs-target="#cadPro">

                  <i class="fa fa-heart"></i>

                Meu Perfil</a></li>
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalCarrinho">
                  <i class="fa fa-shopping-cart"></i>
                  Compras
                    <?php
                    if(isset($_SESSION['cart'])){
                      $count = count($_SESSION['cart']);
                      echo "
                        <span id='cart_count' class='badge text-warning bg-dark rounded-pill'>$count</span>
                      ";
                    }else {
                      // code...
                      echo "<span id='cart_count' class='text-dark bg-warning rounded-pill badge'>0</span>";
                    }
                 ?>

                  </a></li>
              </ul>
          </li>
          <li><a href="#" id="pesq-pc" class="pesq">
            <div class="icon"><i class="fa fa-search" style="font-size: 18px;"></i></div>
           </a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>

  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/carousel/woocommerce.jpg" alt="" class="bd-placeholder-img" width="100%" height="100%">
            <div class="container">
              <div class="carousel-caption text-center d-none">
                <h1 style="">Produtos em Destaque</h1>
                <p>Esta plataforma foi criada para, ajudar a compreender menhor sobre informaçoes disponivels a mundo a fora de varios livros ja lançados.</p>

              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/carousel/bk (7).jpg" alt="" class="bd-placeholder-img" width="100%" height="100%">
            <div class="container">
              <div class="carousel-caption">
                <h1></h1>
                <p>.</p>

              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/carousel/CNT2.jpg" alt="" class="bd-placeholder-img" width="100%" height="100%">
            <div class="container">
              <div class="carousel-caption text-end">
                <h1></h1>
                <p>.</p>

              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <div id="introCarousel" class="carousel  slide carousel-fade d-none" data-bs-ride="carousel">

        <ol class="carousel-indicators">

        </ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active">
            <div class="carousel-background"><img src="img/aluno5.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content d-none">
                <h2>WEKA-Ecommerce</h2>
                <p class=""></p>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/aluno7.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Bilioteca Profissional</h2>
                <p>A manutenção diária da sua mente é feita com equipamentos modernos e livros qualificados.</p>

              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/aluno8.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Cursos Geral</h2>
                <p>Tratamos da sua formãoção, cursos geral e qualificados.</p>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/aluno11.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Consultoria</h2>
                <p>Harmonizar indivíduos com o ambiente ao seu redor. Para o equilibrar os cinco elementos da natureza (fogo, terra, madeira, metal e água).</p>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/aluno12.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Serviços</h2>
                <p>Fornecemos os nossos serviços para empresas.</p>

              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/aluno13.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Negocios</h2>
                <p>Fornecemos ambientes favoraves para o seu negoçio.</p>

              </div>
            </div>
          </div>



        </div>

        <a class="carousel-control-prev" href="#" role="button" data-bs-target="#introCarousel" data-bs-slide="prev" >
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#" data-bs-target="#introCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->

  <main id="main" class="" style="">
    <article id="inicio" class="" style="">
      <?php
      
         require_once "inicio.php";
       ?>
    </article>
    <article id="produtos" class="d-none" style="">
      <?php
         require_once "produtos.php";
       ?>
    </article>
    <article id="loja" class="d-none" style="">
      <?php
         require_once "loja.php";
       ?>
    </article>
    <article id="sobre" class="d-none" style="">
      <?php
         require_once "sobre.php";
       ?>
    </article>
    <article id="noticia" class="d-none" style="">
      <?php
         require_once "noticia.php";
       ?>
    </article>

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="wow fadeInUp">
      <div class="container">

        <header class="section-header">
          <h3>Parceiros & Clientes</h3>
        </header>

        <div class="owl-carousel clients-carousel d-block">
          <marquee behavior="scroll" direction="right" hspace="" width="">
          <img src="img/clients/1.png" alt="">
          <img src="img/clients/2.png" alt="">
          <img src="img/clients/3.png" alt="">
          <img src="img/pca12.png" alt="">
          <img src="img/Logo.png" alt="">
          <img src="img/c7.jpg" alt="">
          </marquee>
          <!--img src="img/clients/l.png" alt=""-->
        </div>
      </div>
    </section>


    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Contacte-nos</h3>
          <p>As nossas linhas estão ativas das 8h - 16h</p>

        </div>

        <div class="row contact-info">


          <div class="col-md-3">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Localização</h3>
              <address>Ingombotas, Rua Dr. Egas Moniz (Luanda-Angola)</address>
            </div>
          </div>

          <div class="col-md-3">
            <div class="contactphone" style="border-left: 1px solid #ddd;">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Telefone</h3>
              <p><a href="tel:+244946453613">+244 927 148 025</a></p>
            </div>
          </div>

            <div class="col-md-3">
            <div class="contact-phone">
              <i class="fa fa-whatsapp"></i>
<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#18d26e" class="bi bi-whatsapp d-none" viewBox="0 0 16 16" style="margin-bottom: 15px;">
  <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
</svg><br/>
              <h3>Whatsaap</h3>
              <p><a href="tel:+244925660519">+244 922 898 741</a></p>
            </div>
          </div>

          <div class="col-md-3">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="cnt_corporate@hotmail.com">geral
                  <br/>cnt_corporate@hotmail.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Sua mensagem foi enviada. Obrigado!</div>
          <div id="errormessage"></div>
          <form action="acao.php" method="POST" class="">
            <div class="row">
              <div class="form-group col-md-6 py-2 py-md-0">
                <input type="text" name="name" class="form-control" id="name" placeholder="Teu Name" data-rule="minlen:4" data-msg="Por favor insira no minimo, 4 caracteres." />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Teu Email" data-rule="email" data-msg="Por favor insira um Email válido" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group my-2">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" data-rule="minlen:4" data-msg="Por favor insira no minimo, 8 caracteres." />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Por favor escreva uma mensagem para nós." placeholder="Mensagem"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center my-2">
                <button type="submit">Enviar Mensagem</button>
              </div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/logo/weka2.png" style="width:150px;height:100px;padding-bottom: 10px;" alt="" title="" /> <br>
            <p> WEKA- Ecommerce  </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links Úteis</h4>
            <ul id="popovers">
              <li title="Missão" data-bs-content="
              Este Aviso de Privacidade explica como as suas informações pessoais serão utilizadas pela CNT em relação aos produtos e serviços de aprendizado digital.
              Quando as minhas informações pessoais serão coletadas?

              "><i class="ion-ios-arrow-right"></i> <a>Missão</a></li>
              <li data-bs-toggle="popover" title="Vissão" data-bs-content="
              As suas informações pessoais serão compartilhadas em situações específicas, abaixo apresentadas e não serão objeto de qualquer comercialização.
              . Com nossos prestadores de serviços (por exemplo, fornecedores que desenvolvem ou hospedam nossos Serviços), desde que aprovados em processo interno de conformidade;
   . Caso seja uma exigência legal ou regulatória;
              . Quando verificada uma desconformidade com as Leis Aplicáveis, com agências reguladoras ou instituição educacional;
              . Com responsáveis legais ou parceiros comerciais responsáveis pelo pagamento de nossos Serviços;
              . Com terceiros específicos, caso você opte por utilizar os Serviços destes (você será ativamente notificado pela CNT antes da realização deste compartilhamento);
              . Com empresas do mesmo grupo econômico, para envio de marketing (respeitadas as regras estipuladas na questão “E como fica o envio de marketing?);
              . Em caso de operações societárias;
              . Em outras situações, com o consentimento do usuário.

              "><i class="ion-ios-arrow-right"></i> <a>Vissão</a></li>
              <li data-bs-toggle="popover" title="Valores" data-bs-content="
              As informações pessoais coletadas dependerão da atividade que você está vinculado à CNT.
Para o processo de registro em nossos serviços, coletaremos: nome, sobrenome e endereço de e-mail. Quando relevante, também poderemos coletar: grupo etário, data de nascimento.

              "><i class="ion-ios-arrow-right"></i> <a>Valores</a></li>
              <li data-bs-toggle="popover" title="Politica de Privacidade" data-bs-content='
              . Você: titular de dados que utiliza os serviços da CNT
              . Parceiros Comerciais: prestadores de aprendizado, tais como escolas, colégios, autoridades educacionais locais, escolas de idiomas particulares, agências educacionais ou qualquer outra organização que compre o acesso aos Serviços para que sejam utilizados pelos usuários em sua organização.

              '
              ><i class="ion-ios-arrow-right"></i> <a>Politica de Privacidade</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contactos</h4>
            <p>
              Maculusso, Rua Dr. Egas Moniz<br>
              Maianga, Luanda<br>
              Angola<br>
              <strong>Telefone:</strong> +244 938 766 317 / 922 824 783<br>
              <strong>Email:</strong>cnt_corporate@hotmail.com<br>
            </p>

            <div class="social-links">
              <a href="www.facebook.com" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="www.instagram.com" class="instagram"><i class="fa fa-instagram"></i></a>
            </div>

          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>WEKA- Commerce</strong>. Todos os Direictos reservados.
      </div>
      <div class="credits">
        Desenvolvido por: <a href="https://fb.me/mav3nda">Paulo Bunga</a>
      </div>
    </div>
  </footer><!-- #footer -->



  <!--MODAL Perfil-->
  <div class="modal fade" id="cadPro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header" id="cad-header">

          <h5 class="modal-title fw-bold mb-0" id="exampleModalLabel">Meu Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="container text-center">
          <div class="d-flex align-items-center  mb-3">
            <div class="p-2 avatar avatar-circle avatar-xs me-2 flex-fill">
              <img src="img/clients/Rabby3.jpg" class="rounded-circle" width="60" height="60" alt="...">
            </div>
            <div class="p-2 flex-fill">
              <h6>
                <b>Rabby Ndombassy</b><br>
                <span>rabby@mail.com</span>
              </h6>
            </div>
            <div class="flex-fill">
            <button type="button" class="btn btn-outline-dark rounded-pill" 
                    style="width: 100%; max-height: 50px;">
                    <i class="fa fa-edit"></i>
                Editar Perfil
            </button>
            </div>
          </div>
          <div class="dados">
            <div class="row">
              <div class="col-6 text-center"><h6>Minhas Compras</h6></div>
              <div class="col-6 text-center"><h6>Produtos Favoritos</h6></div>
            </div>
            <div class="col-12 row">
              <?php
              foreach ($lista_tarefas as $produtos) :
          ?>
          <div class="col-4 portfolio-item filter-jardinagem wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/produto/012.png" class="img-fluid" alt="" style="">
                <a href="img/produto/<?php echo $produtos['imagem_produto']; ?>" data-lightbox="portfolio" data-title="Jardinagem" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#!" class="link-details" title="More Details"><i class="fa fa-shopping-cart"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#!"><i class="ion-ios-heart-outline"></i> <?php echo $produtos['nome_produto']; ?></a></h4>
                <p><i class="ion-cash"></i> <?php echo $produtos['valor_venda']; ?> KZ</p>
              </div>
            </div>
          </div>
          <?php
              endforeach;  
          ?>
              </div>
            
          </div>
          
            
          </div>
        </div>
        </div>
        <div class="modal-footer d-none">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
          <button type="button" class="btn btn-primary" hidden>Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!--MODAL LOGIN-->
  <div class="modal fade" id="modaLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold mb-0" id="exampleModalLabel">Faça o seu Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--LOGIN-->

          <form id="form_logar" class="" action="conexoes/login.php" method="POST">
            <div class="form-group mb-3">
              <label for="username" hidden>Email</label>
              <input type="email" class="form-control rounded-4" id="username" name="username" placeholder="name@example.com" required>

            </div>
            <div class="form-group mb-3">
              <label for="password" hidden>Password</label>
              <input type="password" class="form-control rounded-4" id="password" name="password" placeholder="Password" required>

            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit" name="btn-entrar" id="btn-entrar">Entrar</button>
            <small class="text-muted"></small>
            <hr class="my-4">
            <h2 class="fs-5 fw-bold mb-3">Faça seu cadastro</h2>
            <button id="btn_trocar_cadastrar" class="w-100 py-2 mb-2 btn btn-outline-info rounded-4">
              <i class="fa fa-globe" width="16" height="16"></i>
              Fazer novo Login
            </button>
          </form>
          <!--CADASTRO-->
          <form id="form_cadastro" class="d-none" action="conexoes/tarefas.php" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
              <label for="floatingNome d-none" hidden>Nome</label>
              <input type="text" class="form-control rounded-4" id="floatingNome" name="floatingNome" placeholder="Seu nome" required>

            </div>
            <div class="form-group mb-3">
              <label for="floatingNumero" hidden>Numero</label>
              <input type="text" class="form-control rounded-4" id="floatingNumero" name="floatingNumero" placeholder="Seu contacto" required>

            </div>
            <div class="form-group mb-3">
              <label for="floatingEmail" hidden>Email</label>
              <input type="email" class="form-control rounded-4" id="floatingEmail" name="floatingEmail" placeholder="name@example.com" required>

            </div>
            <div class="form-group mb-3">
              <label for="floatingPassword" hidden>Password</label>
              <input type="password" class="form-control rounded-4" id="floatingPassword" name="floatingPassword" placeholder="Password" required>

            </div>
            <div class="form-group mb-3">
              <label for="floatingPerfil" hidden>Foto de Perfil</label>
              <input type="file" class="form-control rounded-4" id="floatingPerfil" name="floatingPerfil" placeholder="foto de perfil">

            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit" name="cadastrar_btn" id="cadastrar_btn">Cadastrar</button>
            <small class="text-muted"></small>
            <hr class="my-4">
            <h2 class="fs-5 fw-bold mb-3">Faça seu cadastro</h2>
            <button id="btn_troca_logar" class="w-100 py-2 mb-2 btn btn-outline-info rounded-4">
              <i class="fa fa-globe" width="16" height="16"></i>
              Ja Tenho Conta
            </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
          <button type="button" class="btn btn-primary" hidden>Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!--MODAL CARRINHO-->
  <div class="modal fade" id="modalCarrinho" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title h4" id="exampleModalFullscreenLabel">
            <div class="container">
              <h4>
                <i class="fa fa-shopping-cart"></i>
                Carrinho De Compras
              </h4>
            </div>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
              <tr>

                <th scope="col">Apagar</th>
                <th scope="col">Nome</th>
                <th scope="col">Cor</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Tamanho</th>
                <th scope="col">Preco</th>

              </tr>
              </thead>
              <tbody>
            
      
              <?php 
                  $total = 0;
                  if(isset($_SESSION['cart'])){
                 
                   $produto_id = array_column($_SESSION['cart'], 'id_produto');

                   $selecao = "SELECT * FROM tb_produto";

                  $resultado = mysqli_query($conexao, $selecao);

                  while ($linhas = mysqli_fetch_assoc($resultado)) {
                    foreach ($produto_id as $id) {
                      if($linhas['id_produto'] == $id){
                  
                  
               ?>
              <tr>
                <form class='my-3 my-md-0 py-2' action='index_home.php?action=remove&id=$id_produto' method='post' class='itens-carrinho'>
                <th scope="row">
                  <button type='submit' name='remove' class='btn btn-outline-dark mx-2'><i class="fa fa-trash apagar" id=""></i></button>
                  
                </th>

                <td class="list-group list-group-item-action">
                  <div class="d-flex align-items-center text-reset">
                    <img src="img/produto/<?php echo $linhas['imagem_produto'];?>" alt="AVATAR" class="img-thumbnail flex-shrink-1" style="width: 50px; height: 50px;">
                    <div class="px-2 d-flex flex-column flex-fill">
                        <h6 class="my-0"><?php echo $linhas['nome_produto'];?></h6>
                        <small class=""><?php echo $linhas['marca'];?></small>
                    </div>

                </div>
                </td>
                <td>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Aleatoria</option>
                    <option value="1">Branco</option>
                    <option value="2">Vermelho</option>
                    <option value="3">Preto</option>
                  </select>
                </td>
                <td>
                  <input type="number" name="
                  " id="" value="1" class="numeros">
                </td>
                <td>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>X</option>
                    <option value="1">L</option>
                    <option value="2">M</option>
                    <option value="3">H</option>
                  </select>
                </td>
                <td><?php echo $linhas['valor_venda'];?></td>
                <input type='hidden' name='id_produto' value='<?php echo $linhas['id_produto']; ?>'>
              </form>
              </tr>
              <?php 
                    $total = $total + (int)$linhas['valor_venda'];
                }
              }
            }
          }
                else{
                    echo "<h2>Carrinho vazio</h2>";
                }
              ?>
              
              <tr>

                <th scope="row">
                  Total
                </th>
                <td colspan="4">

                </td>
                <td>$<?php echo $total; ?>.000</td>

              </tr>

              </tbody>
            </table>



            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-secondary">Efetuar Compra</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <!--37script src="contactform/contactform.js"></script-->

  <!-- Template Main Javascript File -->

  <script src="js/main.js"></script>
  <script type="text/javascript">
    $(window).on('load', function () {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(0).fadeOut('slow');
    $('body').delay(0).css({'overflow': 'visible'});
})
      window.onload = inicio()
      window.onresize =initJs()

      function inicio(){
          initJs()
        window.onresize =initJs()

      }

      function initJs(){
          if(Number(window.innerWidth)<=500){
                document.getElementById("menuLogo").innerHTML = '<a href="#" class="menu-active" style="position: fixed; top: 24px;" id="menuMobile"><img src="img/logo/branco-weka.png" style="width:90px;height: 26px;top: -50px;" alt="" title="" /></a>'

              }
          else if (Number(window.innerWidth)>500 && Number(window.innerWidth)<=800) {

                document.getElementById("menuLogo").innerHTML = '<a href="#" class="menu-active" id="menuMobile"><img src="img/logo/branco-weka.png" style="width:90px;height:100px;" alt="" title="" /></a>'
          }
          else if (Number(window.innerWidth)>800){

                document.getElementById("menuLogo").innerHTML = '<a href="#" class="menu-active" id="menuPC" style="position: absolute; top: 0px; left: 50px;"><img src="img/logo/branco-weka.png" style="width: 148px; height: 43px; margin-top: 15px;" alt="" title="" /></a>'
          }

          var url = window.location.href+"";
          var l = url.split("?")
          if(l.length == 2){
              if(l[1]=="message"){
                $("#sendmessage").show()
              }
          }
      }
/*

      $(document).ready(function() {
       // alert("Ola Mundo")
       $('#form_cadastro').submit(function(event) {
        // previne o envio padrão do formulário
        event.preventDefault();

        // obtém os dados do formulário
        var formData = $(this).serialize();

        // envia os dados para o arquivo PHP usando AJAX
        $.ajax({
            type: 'POST',
            url: "conexoes/tarefas.php",
            method: "post",
            data: formData,
            success: function(response) {
                // faça algo com a resposta do servidor
                alert(formData)
                
            },
            error: function() {
                // trata erros de comunicação com o servidor
                alert("Erro ao cadastrar")
            }
        });
    });
});

*/


  </script>
</body>
</html>
