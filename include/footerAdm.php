      <br>
      
      </div>
      <!-- /.container-fluid -->

      <!-- footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright: EcoPilhas 2019</span>
                <i><a href="" data-toggle="modal" data-target="#editarFooter"><i class="far fa-edit"></i> </i></a>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- botão para rolar para cima -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModal">Deseja realmente sair?</h5>
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

  <script src="js/validator.min.js"></script>

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
  <script src="js/chart-pie-marcas.js"></script>
  <script src="js/chart-pie-pesos.js"></script>
</body>

</html>

