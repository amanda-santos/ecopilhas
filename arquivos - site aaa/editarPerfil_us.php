<html>

    <?php

    require __DIR__ . '/vendor/autoload.php';

    include 'conexao.php';

    include 'menu.php';



    $login = $_SESSION['login'];

    $sql = "select u.nome, u.senha FROM usuario as u WHERE login='" . $login . "';";

    $result = $con->query($sql);



    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $usuario = ucwords($row['nome']);

            $senha = $row['senha'];

        }

    }

    ?>



    <body>

        <div class="container-fluid">

            <div class="row">

                <main class="span-8 col-sm-8 offset-sm-3 col-md-10 offset-md-2 pt-3 dashboard">

                    <h1>Editar Senha:</h1>

                    <hr>

                    <form class="form-horizontal" enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarPerfil_us.php" method="post">



                        <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <div class="form-group col-12 col-sm-12 col-md-6  col-lg-6 col-xl-6">

                                    <label class="control-label  col-12 col-sm-3 col-md-3  col-lg-3 col-xl-3" for="usuario">Nome:  <span title="obrigatório"></span> 

                                    </label>

                                    <div class="input-group  col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">

                                        <input  type="text" id="usuario" readonly required="required" name="usuario" maxlength="240" value="<?php echo $usuario; ?>" class="form-control">

                                    </div>

                                </div>



                                <div class="form-group  col-12 col-sm-12 col-md-6  col-lg-6 col-xl-6">

                                    <label class="control-label  col-12 col-sm-3 col-md-3  col-lg-3 col-xl-3" for="login">Usuário:  <span title="obrigatório"></span> 

                                    </label>

                                    <div class="input-group  col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">

                                        <input  type="text" id="login" readonly required="required" name="login" maxlength="240" value="<?php echo $login; ?>"  class="form-control">

                                    </div>

                                </div>

                                <div class="form-group  col-12 col-sm-12 col-md-6  col-lg-6 col-xl-6">
                                    <label class="control-label col-12 col-sm-3 col-md-3  col-lg-3 col-xl-3" for="atual">Digite sua senha atual:</label>
                                    <div class="input-group  col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">
                                      <input type="password" class="form-control" id="atual" name="atual" required>
                                    </div> <!--fim col-sm-5-->
                                </div> <!--fim form-group-->
                                
                                <div class="form-group  col-12 col-sm-12 col-md-6  col-lg-6 col-xl-6">
                                    <label class="control-label col-12 col-sm-3 col-md-3  col-lg-3 col-xl-3" for="nova">Digite sua nova senha:</label>
                                    <div class="input-group  col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">
                                      <input type="password" class="form-control" id="nova" name="nova" data-minlength="6" required>
                                      <span class="help-block">Mínimo de seis (6) digitos</span>
                                    </div> <!--fim col-sm-5-->
                                </div> <!--fim form-group-->

                                <div class="form-group  col-12 col-sm-12 col-md-6  col-lg-6 col-xl-6">
                                    <label class="control-label col-12 col-sm-3 col-md-3  col-lg-3 col-xl-3" for="confSenha">Confirme sua senha:</label>
                                    <div class="input-group  col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">
                                      <input type="password" class="form-control" id="confSenha" name="senhaConfirma" data-match="#nova" data-match-error="Atenção! As senhas não estão iguais." required>
                                      <div class="help-block with-errors"></div>
                                    </div> <!--fim col-sm-5-->
                                </div> <!--fim form-group-->

                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">        

                                    <div>

                                        <button type="submit" class="btn btn-primary" name="atualizePerfil"><span class="glyphicon glyphicon-save"></span> Alterar</button>

                                    </div>

                                </div>

                        </div>



                    </form>

            </div>

        </div>



    </form>

</main>

</div>

</div>

</body>

</html>

