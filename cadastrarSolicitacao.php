<?php
  include("include/header.php");
?>

<!-- Page Content -->
    <br>
    <div class="container">
        <h1>Solicite um coletor ou uma palestra na sua instituição</h1>

        <!-- formulario -->
        <div class="row">
          <div class="col-lg-12">
            <form data-toggle="validator" action="inserirSolicitacao.php" method="post">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Nome completo</label>
                  <input maxlength="200" name="nome" class="form-control" type="text" placeholder="Nome" required="required" data-validation-required-message="Por favor, digite o seu nome completo.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Endereço de E-mail</label>
                  <input maxlength="200" name="email" class="form-control" type="email" placeholder="Endereço de E-mail" required="required" data-validation-required-message="Por favor, digite o seu endereço de e-mail.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Telefone</label>
                  <input maxlength="20" id="telefone" name="telefone" class="form-control" type="tel" placeholder="Telefone" required="required" data-validation-required-message="Por favor, digite o seu telefone.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>O que você deseja?</label>
                  <select name="tipo" class="form-control" required="required" data-validation-required-message="Por favor, informe o que você deseja.">
                      <option value="1">Coletor de pilhas</option>
                      <option value="2">Palestra</option>
                  </select>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Instituição ou local</label>
                  <input maxlength="200" name="local" class="form-control" type="text" placeholder="Instituição ou local" required="required" data-validation-required-message="Por favor, digite a instituição ou local.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Observações</label>
                  <textarea maxlength="500" name="observacao" class="form-control" rows="5" placeholder="Observações"></textarea>
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
    <!-- /.container -->
    <br>
<?php
  include("include/footer.php");
?>