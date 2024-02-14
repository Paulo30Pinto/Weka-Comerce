    <section id="about">
      <div class="container col-about position-relative">


        <header class="section-header wow fadeInUp">
          <h3><?php 
          if (isset($_SESSION['user_id'])) {
            echo $dados['nome'];
          } else{
            echo "PRODUTOS";
          }
          ?></h3>

        </header>




        <div class="d-flex flex-nowrap justify-content-start align-content-center about-cols py-2" style="overflow-x: auto; scroll-behavior: smooth; width: 100%;" id='innerW'>
        <?php
              $sqlBusca1 = "SELECT * FROM tb_produto WHERE categoria LIKE'%' group by categoria ORDER BY categoria desc limit 9";
              $resultado1 = mysqli_query($conexao, $sqlBusca1);
              
              while ($produtos = mysqli_fetch_assoc($resultado1)):
              
          ?>
        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col row">
              <div class="img col" style="">
                <center class=""><img src="img/produto/<?php echo $produtos['imagem_produto']; ?>" style="height: 250px; width: 90%;" alt="" class="img-fluid"></center>
                <div class="icon d-none"><i class="ion-bag"></i></div>
              </div>
              <div class="col text-center">
                <h2 class="title"><a href="#"><?php echo $produtos['categoria']; ?></a></h2>
                <p>
                    <?php echo $produtos['descricao']; ?>
                </p>
                <button class="cta-btn shadow-lg">Ver mais</button>
              </div>
            </div>
          </div>
          <?php
              endwhile;  
          ?>
       

        </div>

        <button class='rolar rounded-circle' id="voltar">
          <i class='ion-chevron-left'></i>
        </button>
        <button class='rolar rounded-circle' id="avancar">
        <i class='fa fa-chevron-right'></i>
        </button>
      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container">

        <header class="section-header wow fadeInUp">
          <h3>Compra pelas marcas em destaques </h3>

        </header>

        <div class="row produto-cad">

        <?php
             $sqlBusca1 = "SELECT * FROM tb_produto WHERE destaque = 1 ORDER BY nome_produto asc limit 6";
             $resultado1 = mysqli_query($conexao, $sqlBusca1);
             
             while ($produtos = mysqli_fetch_assoc($resultado1)):
             // foreach ($lista_tarefas as $produtos) :
          ?>

          <div class="col-6 col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <form action='index_home.php' method='post'>
            <div class="row pic-projeto shadow-lg">
              <div class="icon col-12 col-md-4" style="">
                <img src="img/produto/<?php echo $produtos['imagem_produto']; ?>" alt="" class="projeto-pic">
              </div>

              <div class="col-12 col-md-8 py-4 text-center" style="" class="">
                <h4 class="title"><a href="#!"><?php echo $produtos['nome_produto']; ?></a></h4>
                <p class="description">
                  <span>Preço: <b> <?php echo $produtos['valor_venda']; ?> </b> kz</span>
                  <br>
                  <span>Marca: <b> <?php echo $produtos['marca']; ?></b></span>
                  <br>
                  <a href="#!?add" class="d-none"><i class="fa fa-shopping-cart"></i><b> Add</b></a>
                  <button type='submit' name='add' class='btn btn-sm btn-dafault my-3'>Add <i class='fa fa-shopping-cart'></i> </button>
             
                  <br>
                  <input type='hidden' name='id_produto' value='<?php echo $produtos['id_produto']; ?>'>
                </p>
              </div>
            </div>
          </form>
          </div>

          <?php
              //endforeach; 
             endwhile; 
          ?>

        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Clients Section
    ============================-->

    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeIn">
      <div class="container text-center">
        <img src="img/produto/femea3.png" alt="">
        <h3>O Melhor Pra Si</h3>
        <p>Seu dejeso é nossa missão</p>
        <a class="cta-btn" href="#" data-bs-toggle="modal" data-bs-target="#cadPro">Visitar Loja</a>
      </div>
    </section><!-- call-to-action -->


    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Produtos em destaques </h3>
        </header>

        <div class="container d-none">
          <div class="nav-scroller py-1 mb-2">
            <ul id="portfolio-flters" class="nav d-flex justify-content-between">
              <li data-filter="*" class="filter-active">Todos</li>
              <li data-filter=".filter-jardinagem">eletronicos </li>
              <li data-filter=".filter-limpeza">Mobiliarios </li>
              <li data-filter=".filter-desinfeta">Vestuario</li>
              <li data-filter=".filter-paisagem">Alimentos</li>
              <li data-filter=".filter-copa">Diversos</li>
              <li data-filter=".filter-copa">Moda</li>
              <li data-filter=".filter-copa">tabacaria </li>


            </ul>
          </div>
        </div>


        <div class="row portfolio-container">
        <?php
              foreach ($lista_tarefas as $produtos) :
          ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-jardinagem wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/produto/<?php echo $produtos['imagem_produto']; ?>" class="img-fluid" alt="" style="">
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
              <div class="text-center my-2">
                <button type="submit" class="rounded-pill" id='ver-mas'>Ver mais</button>
              </div>
      </div>
    </section><!-- #portfolio -->
