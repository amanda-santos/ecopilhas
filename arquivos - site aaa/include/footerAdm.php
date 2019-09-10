      <br>
      
      </div>
      <!-- /.container-fluid -->

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

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><?php echo $footer;?></span>
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
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
  <script src="bootstrap-validator-master\dist\validator.js"></script>
  <script src="js\buscaSocio.js"></script>
  <script src="js\mascara.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>

  <!--idioma pt-br-->
  <script>
  $(document).ready(function(){
      $('#dataTable').DataTable({
          "language": {
            "sProcessing":   "Carregando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Nenhum resultado foi encontrado",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
            "sInfoPostFix":  "",
            "sSearch":       "Procurar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
          }
        });
  });
  </script>

  <!-- table export 
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
   
  <script type="text/javascript">
      $(document).ready(function() {
      $('#dataTable').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5',
              'excelHtml5',
              'csvHtml5',
              'pdfHtml5'
          ]
      } );
  } );
  </script>-->

  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" integrity="sha256-arMsf+3JJK2LoTGqxfnuJPFTU4hAK57MtIPdFpiHXOU=" crossorigin="anonymous"></script>
  -->
  <script src="js/validator.min.js"></script>

  <script src="js\mascara.js"></script>
  <script src="js\buscaCep.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor-admin-website/jquery/jquery.min.js"></script>
  <script src="vendor-admin-website/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor-admin-website/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor-admin-website/chart.js/Chart.min.js"></script>
  <script src="vendor-admin-website/datatables/jquery.dataTables.js"></script>
  <script src="vendor-admin-website/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/chart-pie-ativos-inativos.js"></script>
  <script src="js/chart-pie-situacao.js"></script>
</body>

</html>
