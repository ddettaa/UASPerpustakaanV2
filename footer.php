
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b></b>
    </div>
    <strong>&copy;2024 Sistem Informasi Perpustakaan</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="adminlte310/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte310/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="adminlte310/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte310/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="adminlte310/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="adminlte310/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="adminlte310/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="adminlte310/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="adminlte310/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="adminlte310/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="adminlte310/plugins/jszip/jszip.min.js"></script>
<script src="adminlte310/plugins/pdfmake/pdfmake.min.js"></script>
<script src="adminlte310/plugins/pdfmake/vfs_fonts.js"></script>
<script src="adminlte310/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="adminlte310/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="adminlte310/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="adminlte310/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="adminlte310/dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
