<!-- Footer -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Sair" abaixo se você está pronto(a) para encerrar a sua sessão atual.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="logout.php">Sair</a>
          </div>
        </div>
      </div>
    </div>

    <!--início do modal para edição de dados de redes sociais-->
    <div class="modal fade bd-example-modal-sm" id="editarRedeSocial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Redes Sociais</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <?php
            $sqlFacebook = "SELECT nome, link, mostrar FROM redesocial WHERE idRedeSocial = 1;";
            $resultFacebook = $con->query($sqlFacebook);
            if ($resultFacebook->num_rows > 0){
              while ($exibirFacebook = $resultFacebook->fetch_assoc()){

                // facebook

                $nomeF = $exibirFacebook["nome"];
                $linkF = $exibirFacebook["link"];
                $mostrarF = $exibirFacebook["mostrar"];

              } //fim while
            } //fim if

            $sqlTwitter = "SELECT r.nome, r.link, r.mostrar FROM redesocial AS r WHERE r.idRedeSocial = 2;";
            $resultTwitter = $con->query($sqlTwitter);
            if ($resultTwitter->num_rows > 0){
              while ($exibirTwitter = $resultTwitter->fetch_assoc()){

                // twitter
                $nomeTw = $exibirTwitter["nome"];
                $linkTw = $exibirTwitter["link"];
                $mostrarTw = $exibirTwitter["mostrar"];

              } //fim while
            } //fim if

            $sqlGoogle = "SELECT r.nome, r.link, r.mostrar FROM redesocial AS r WHERE r.idRedeSocial = 3;";
            $resultGoogle = $con->query($sqlGoogle);
            if ($resultGoogle->num_rows > 0){
              while ($exibirGoogle = $resultGoogle->fetch_assoc()){

                // google +
                $nomeG = $exibirGoogle["nome"];
                $linkG = $exibirGoogle["link"];
                $mostrarG = $exibirGoogle["mostrar"];

              } //fim while
            } //fim if

            $sqlTumblr = "SELECT r.nome, r.link, r.mostrar FROM redesocial AS r WHERE r.idRedeSocial = 4;";
            $resultTumblr = $con->query($sqlTumblr);
            if ($resultTumblr->num_rows > 0){
              while ($exibirTumblr = $resultTumblr->fetch_assoc()){

                // tumblr
                $nomeTu = $exibirTumblr["nome"];
                $linkTu = $exibirTumblr["link"];
                $mostrarTu = $exibirTumblr["mostrar"];

              } //fim while
            } //fim if

            $sqlInstagram = "SELECT r.nome, r.link, r.mostrar FROM redesocial AS r WHERE r.idRedeSocial = 5;";
            $resultInstagram = $con->query($sqlInstagram);
            if ($resultInstagram->num_rows > 0){
              while ($exibirInstagram = $resultInstagram->fetch_assoc()){

                // instagram
                $nomeI = $exibirInstagram["nome"];
                $linkI = $exibirInstagram["link"];
                $mostrarI = $exibirInstagram["mostrar"];

              } //fim while
            } //fim if
          ?>
                    
            <form class="form-horizontal" action="atualizarRedeSocial.php" method="post" data-toggle="validator"> 
              
              <!--facebook-->
              <label class="control-label col-sm-12" for="nomeF"><b><?php echo $nomeF; ?></b></label>

              <div class="form-group">
                <label class="control-label col-sm-12" for="linkF">Link:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="linkF" name="linkF" placeholder="Ex.: https://www.google.com.br" value="<?php echo $linkF;?>"></input>
                </div>
              </div>

              <div class="form-check">
                <div class="col-sm-12">
                  <?php 
                    if ($mostrarF){
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarF" id="mostrarF" checked="checked">
                  <?php 
                    }else{
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarF" id="mostrarF">
                  <?php 
                    }
                  ?>
                  <label class="form-check-label" for="mostrarF">Exibir</label>
                </div>
              </div>

              <br>

              <!--twitter-->
              <label class="control-label col-sm-12" for="nomeTw"><b><?php echo $nomeTw; ?></b></label>

              <div class="form-group">
                <label class="control-label col-sm-12" for="linkTw">Link:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="linkTw" name="linkTw" placeholder="Ex.: https://www.google.com.br" value="<?php echo $linkTw;?>"></input>
                </div>
              </div>

              <div class="form-check">
                <div class="col-sm-12">
                  <?php 
                    if ($mostrarTw){
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarTw" id="mostrarTw" checked="checked">
                  <?php 
                    }else{
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarTw" id="mostrarTw">
                  <?php 
                    }
                  ?>
                  <label class="form-check-label" for="mostrarTw">Exibir</label>
                </div>
              </div>

              <br>

              <!--google +-->
              <label class="control-label col-sm-12" for="nomeG"><b><?php echo $nomeG; ?></b></label>

              <div class="form-group">
                <label class="control-label col-sm-12" for="linkG">Link:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="linkG" name="linkG" placeholder="Ex.: https://www.google.com.br" value="<?php echo $linkG;?>"></input>
                </div>
              </div>

              <div class="form-check">
                <div class="col-sm-12">
                  <?php 
                    if ($mostrarG){
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarG" id="mostrarG" checked="checked">
                  <?php 
                    }else{
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarG" id="mostrarG">
                  <?php 
                    }
                  ?>
                  <label class="form-check-label" for="mostrarG">Exibir</label>
                </div>
              </div>

              <br>

              <!--tumblr-->
              <label class="control-label col-sm-12" for="nomeTu"><b><?php echo $nomeTu; ?></b></label>

              <div class="form-group">
                <label class="control-label col-sm-12" for="linkTu">Link:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="linkTu" name="linkTu" placeholder="Ex.: https://www.google.com.br" value="<?php echo $linkTu;?>"></input>
                </div>
              </div>

              <div class="form-check">
                <div class="col-sm-12">
                  <?php 
                    if ($mostrarTu){
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarTu" id="mostrarTu" checked="checked">
                  <?php 
                    }else{
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarTu" id="mostrarTu">
                  <?php 
                    }
                  ?>
                  <label class="form-check-label" for="mostrarTu">Exibir</label>
                </div>
              </div>

              <br>

              <!--instagram-->
              <label class="control-label col-sm-12" for="nomeI"><b><?php echo $nomeI; ?></b></label>

              <div class="form-group">
                <label class="control-label col-sm-12" for="linkI">Link:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="linkI" name="linkI" placeholder="Ex.: https://www.google.com.br" value="<?php echo $linkI;?>"></input>
                </div>
              </div>

              <div class="form-check">
                <div class="col-sm-12">
                  <?php 
                    if ($mostrarI){
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarI" id="mostrarI" checked="checked">
                  <?php 
                    }else{
                  ?>
                      <input type="checkbox" class="form-check-input" name="mostrarI" id="mostrarI">
                  <?php 
                    }
                  ?>
                  <label class="form-check-label" for="mostrarI">Exibir</label>
                </div>
              </div>

              <br>
             
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Atualizar" name = "atualizar"></input>
        </div>

        </form>

      </div>
      </div>
    </div>
    <!--fim do modal para edição de dados de redes sociais pendentes-->

    <!--início do modal para edição do sobre-->
    <div class="modal fade bd-example-modal-sm" id="editarSobre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

      <?php
          $sqlSobre = "SELECT nome, conteudo FROM itemsite WHERE idItemSite = 2;";
          $resultSobre = $con->query($sqlSobre);
          if ($resultSobre->num_rows > 0){
            while ($exibirSobre = $resultSobre->fetch_assoc()){

              $conteudo = $exibirSobre["conteudo"];
              $nome = $exibirSobre["nome"];

            } //fim while
          } //fim if
        ?>

      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel"><?php echo $nome; ?></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form class="form-horizontal" action="atualizarSobre.php" method="post" data-toggle="validator">

              <div class="form-group">
                <label class="control-label col-sm-12" for="nome">Título:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o título" value="<?php echo $nome;?>"></input>
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-sm-12" for="conteudo">Texto:</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="conteudo" name="conteudo" placeholder="Insira o texto de apresentação"><?php echo $conteudo;?></textarea> 
                </div>
              </div>
             
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Atualizar" name = "atualizar"></input>
        </div>

        </form>

      </div>
      </div>
    </div>
    <!--fim do modal para edição do sobre-->

    <!--início do modal para edição do footer-->
    <div class="modal fade bd-example-modal-sm" id="editarFooter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

      <?php
          $sqlFooter = "SELECT conteudo FROM itemsite WHERE idItemSite = 3;";
          $resultFooter = $con->query($sqlFooter);
          if ($resultFooter->num_rows > 0){
            while ($exibirFooter = $resultFooter->fetch_assoc()){
              $footer = $exibirFooter["conteudo"];
            } //fim while
          } //fim if
        ?>

      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Editar</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form class="form-horizontal" action="atualizarFooter.php" method="post" data-toggle="validator">

              <div class="form-group">
                <label class="control-label col-sm-12" for="conteudoFooter">Texto:</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="conteudoFooter" name="conteudoFooter" placeholder="Insira o texto"><?php echo $footer;?></textarea> 
                </div>
              </div>
             
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Atualizar" name = "atualizar"></input>
        </div>

        </form>

      </div>
      </div>
    </div>
    <!--fim do modal para edição do footer-->

    <footer class="page-footer font-small footerAaa" style="background-color: #1C2331;">

        <div style="background-color: #285da0;">
          <div class="container">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

              <!-- Grid column -->
              <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                <h6 class="mb-0">Acesse também as nossas redes sociais! </h6>

                <?php
                if (isset($_SESSION['login'])){

                  if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
                ?>
                      <i><a href="" data-toggle="modal" data-target="#editarRedeSocial"><i class="far fa-edit"></i> Editar</i></a>
                <?php    
                  }
                }
                ?>
                
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-6 col-lg-7 text-center text-md-right">

                <?php 
                  if ($mostrarF){
                ?>
                    <!-- Facebook -->
                    <a target="_blank" href="<?php echo $linkF; ?>" class="fb-ic">
                      <i class="fa fa-facebook white-text mr-4"> </i>
                    </a>
                <?php 
                  }
                ?>

                <?php 
                  if ($mostrarTw){
                ?>
                    <!-- Twitter -->
                    <a target="_blank" href="<?php echo $linkTw; ?>" class="tw-ic">
                      <i class="fa fa-twitter white-text mr-4"> </i>
                    </a>
                <?php 
                  }
                ?>

                <?php 
                  if ($mostrarG){
                ?>
                    <!-- Google +-->
                    <a target="_blank" href="<?php echo $linkG; ?>" class="gplus-ic">
                      <i class="fa fa-google-plus white-text mr-4"> </i>
                    </a>
                <?php 
                  }
                ?>

                <?php 
                  if ($mostrarTu){
                ?>
                    <!--Tumblr -->
                    <a target="_blank" href="<?php echo $linkTu; ?>" class="li-ic">
                      <i class="fa fa-tumblr white-text mr-4"> </i>
                    </a>
                <?php 
                  }
                ?>

                <?php 
                  if ($mostrarI){
                ?>
                    <!--Instagram-->
                    <a target="_blank" href="<?php echo $linkI; ?>" class="ins-ic">
                      <i class="fa fa-instagram white-text"> </i>
                    </a>
                <?php 
                  }
                ?>

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row-->

          </div>
        </div>

        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">

          <!-- Grid row -->
          <div class="row mt-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

              <!-- Content -->
              <h6 class="text-uppercase font-weight-bold"><?php echo $nome;?> 

                <?php
                if (isset($_SESSION['login'])){

                  if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
                ?>
                      <i><a href="" data-toggle="modal" data-target="#editarSobre">  <i class="far fa-edit"></i> </i></a>
                <?php    
                  }
                }
                ?>

              </h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="text-align: justify; width: 60px;">
              <p><?php echo $conteudo;?></p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

              <?php
                $sqlEndereco = "SELECT endereco, telefone, email FROM contato WHERE idContato = 1;";
                $resultEndereco = $con->query($sqlEndereco);
                if ($resultEndereco->num_rows > 0){
                  while ($exibirEndereco = $resultEndereco->fetch_assoc()){
                    $endereco = $exibirEndereco["endereco"];
                    $telefone = $exibirEndereco["telefone"];
                    $email = $exibirEndereco["email"];
                  } //fim while
                } //fim if
              ?>

              <!-- Links -->
              <h6 class="text-uppercase font-weight-bold">Contato</h6>
              <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p>
                <i class="fa fa-home mr-3"></i> <?php echo $endereco; ?> </p>
              <p>
                <i class="fa fa-envelope mr-3"></i> <?php echo $email; ?> </p>
              <p>
                <i class="fa fa-phone mr-3"></i> <?php echo $telefone; ?> </p>

              <br>

            </div>
            <!-- Grid column -->

          </div>
          <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div style="background-color: #285da0;" class="footer-copyright text-center py-3"><?php echo $footer;?></a> 
          <?php
            if (isset($_SESSION['login'])){

              if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
            ?>
                  <i><a href="" data-toggle="modal" data-target="#editarFooter"><i class="far fa-edit"></i> </i></a>
            <?php    
              }
            }
          ?>
        </div>
        <!-- Copyright -->

      </footer>
      <!-- Footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor-main-website/jquery/jquery.min.js"></script>
    <script src="vendor-main-website/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
