<?php
include("include/header.php"); // incluir arquivo com header do site
?>

<!-- Page Content -->
<div class="container">

  <h2 class="my-4">EcoPilhas</h2>

  <!-- seções de páginas -->

  <?php

    $sqlSecaoPaginasIndex = "SELECT idSecaoPaginas, titulo 
                              FROM SecaoPaginas 
                              WHERE exibir = 1";

    $resultSecaoPaginasIndex = $con->query($sqlSecaoPaginasIndex);

    if ($resultSecaoPaginasIndex->num_rows > 0) { // Exibindo cada linha retornada com a consulta
      while ($exibirSecaoPaginasIndex = $resultSecaoPaginasIndex->fetch_assoc()){
        $idSecaoPaginasIndex = $exibirSecaoPaginasIndex["idSecaoPaginas"];
        $nomeSecaoPaginasIndex = ucwords($exibirSecaoPaginasIndex["titulo"]);
    ?>
        <h3><?php echo $nomeSecaoPaginasIndex; ?></h3><br>
      
        <div class="row">
          
          <?php

            $sqlPaginaIndex = "SELECT idPagina, nome, conteudo 
                                FROM Pagina 
                                WHERE exibir = 1 
                                AND SecaoPaginas_idSecaoPaginas = " . $idSecaoPaginasIndex;

            $resultPaginaIndex = $con->query($sqlPaginaIndex);

            if ($resultPaginaIndex->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibirPaginaIndex = $resultPaginaIndex->fetch_assoc()){
                $idPaginaIndex = $exibirPaginaIndex["idPagina"];
                $nomePaginaIndex = ucwords($exibirPaginaIndex["nome"]);
                $conteudoPaginaIndex = $exibirPaginaIndex["conteudo"];
          ?>

                <div class="col-lg-4 mb-4">
                  <div class="card h-100">
                    <h4 class="card-header"><?php echo $nomePaginaIndex; ?></h4>
                    <div class="card-body">
                      <p style="padding-top: -50px;" class="card-text"><?php echo limitarTexto($conteudoPaginaIndex, $limite=200);?></p>
                    </div>
                    <div class="card-footer">
                      <a href="pagina.php?id=<?php echo $idPaginaIndex; ?>" class="btn btn-primary">Saiba Mais</a>
                    </div>
                  </div>
                </div>

          <?php
              } // fim while pagina
            } // fim if pagina
          ?>
          
        </div>
        <!-- /.row -->
        <hr>

    <?php
      } // fim while SecaoPaginas
    } // fim if SecaoPaginas
    ?>

    <!-- fim seções de páginas -->

          <!-- seções de postagens -->

      <?php
        
        $sqlSecaoPosts = "SELECT idSecaoPosts,titulo FROM ecopilhas.SecaoPosts WHERE exibir = 1;";

        $resultSecaoPosts = $con->query($sqlSecaoPosts);

        if ($resultSecaoPosts->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPosts = $resultSecaoPosts->fetch_assoc()){
            $idSecao = $exibirSecaoPosts["idSecaoPosts"];
            $tituloSecao = $exibirSecaoPosts["titulo"];
      ?>
            <hr>

            <div class="row">
              <div class="col-lg-8 col-sm-6 ">
                <h2><?php echo $tituloSecao;?></h2>
              </div>
              <div class="col-lg-4 col-sm-6">
                <a class="float-right" href="postagens.php?id=<?php echo $idSecao;?>">Ver todas as postagens</a>
              </div>
            </div>

            <div class="row">

            <?php

              $sqlPosts = "SELECT idPost, titulo, conteudo, img FROM ecopilhas.Post WHERE cadastro = 1 AND idSecaoPosts = " . $idSecao . " ORDER BY dataAprovacao DESC LIMIT 3;";

              $resultPosts = $con->query($sqlPosts);

              if ($resultPosts->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibirPosts = $resultPosts->fetch_assoc()){
                  $idPost = $exibirPosts["idPost"];
                  $titulo = $exibirPosts["titulo"];
                  $conteudo = $exibirPosts["conteudo"];
                  $img = $exibirPosts["img"];
            ?>
                  <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                      <a href="post.php?id=<?php echo $idPost; ?>">
                        <img class="card-img-top crop-image-post-index" src="upload/img-post/<?php echo $img; ?>" alt="">
                      </a>
                      <div class="card-body">
                        <h4 class="card-title">
                          <a href="post.php?id=<?php echo $idPost; ?>"><?php echo $titulo; ?></a>
                        </h4>
                        <p class="card-text"><?php echo limitarTexto($conteudo, $limite=270); ?></p>
                      </div>
                      <div class="card-footer">
                        <a href="post.php?id=<?php echo $idPost; ?>" class="btn btn-primary">Saiba Mais</a>
                      </div>
                    </div>
                  </div>

            <?php

                } // fim while
              } // fim if

            ?>
                  
        </div>
        <!-- /.row -->

      <?php

          } // fim while
        } // fim if

      ?>

      <!-- fim seções de postagens -->


  <!-- Portfolio Section -->
  <div class="row">
    <div class="col-lg-8 col-sm-6 ">
      <h2>Atividades</h2>
    </div>
    <div class="col-lg-4 col-sm-6">
      <a class="float-right" href="postagens.php">Ver todas as postagens</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Exemplo</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Saiba Mais</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Exemplo</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Saiba Mais</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Exemplo</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia recusandae vero vel quam!</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Saiba Mais</a>
        </div>
      </div>
    </div>

  </div>
  <!-- /.row-->

  <hr>

  <!-- Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">

      <!-- Contact Section Heading -->
      <h2 class="page-section-heading mb-0">Solicite um Coletor ou uma Palestra</h2>
      <br>
      <!-- Contact Section Form -->
      <div class="row">
        <div class="col-lg-12">
          <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
          <form data-toggle="validator" action="" method="post">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Nome</label>
                <input class="form-control" type="text" placeholder="Nome" required="required" data-validation-required-message="Por favor, digite o seu nome.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Endereço de E-mail</label>
                <input class="form-control" type="email" placeholder="Endereço de E-mail" required="required" data-validation-required-message="Por favor, digite o seu endereço de e-mail.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Telefone</label>
                <input class="form-control" type="tel" placeholder="Telefone" required="required" data-validation-required-message="Por favor, digite o seu telefone.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Observações</label>
                <textarea class="form-control" rows="5" placeholder="Observações"></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-xl" name="solicitar">Solicitar</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </section>

  <hr>

  <div id="#map">

    <h2>Mapa de Coletores de Pilhas</h2>

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14947.28259302994!2d-43.7131314!3d-20.5135773!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe019c5fcdb31b181!2sInstituto%20Federal%20de%20Minas%20Gerais%2C%20Campus%20Ouro%20Branco!5e0!3m2!1spt-BR!2sbr!4v1568054194783!5m2!1spt-BR!2sbr" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

  </div>

</div>
<!-- /.container -->

<br>

<?php
include("include/footer.php");
?>