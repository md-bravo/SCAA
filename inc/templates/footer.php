   <!-- Scripts -->
     <script type="text/javascript" src="js/vendor/jquery-3.4.1.min.js"></script>
     <script type="text/javascript" src="js/vendor/bootstrap.bundle.min.js"></script>
     <script type="text/javascript" src="js/vendor/sweetalert2.min.js"></script>
     <script type="text/javascript" src="DataTables/datatables.min.js"></script>
     
     
    <?php 
      $actual = obtenerPaginaActual();
      if ($actual != 'login') {
        echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
      }
      switch ($actual) {
        case 'login':
          echo '<script type="text/javascript" src="js/formulario-login.js"></script>';
          break;
        case 'index':
          // echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
          break;
        case 'registro':
          echo '<script type="text/javascript" src="js/formulario-registro.js"></script>';
          // echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
          break;
        case 'reporte':
          // echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
          break;
        default:
          break;
      }
      // if ($actual === 'login') {
      //   echo '<script type="text/javascript" src="js/formulario-login.js"></script>';
      // } elseif ($actual === 'index') {
      //   echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
      // } elseif ($actual === 'registro') {
      //   echo '<script type="text/javascript" src="js/formulario-registro.js"></script>';
      //   echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
      // } elseif ($actual === 'reporte') {
      //   echo '<script type="text/javascript" src="js/script.js?v=1"></script>';
      // }
    ?>
</body>

</html>