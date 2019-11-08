   <!-- Scripts -->
     <script src="js/vendor/jquery-3.4.1.min.js"></script>
     <script src="js/vendor/bootstrap.bundle.min.js"></script>
     <script src="js/vendor/sweetalert2.min.js"></script>
     
     
    <?php 
      $actual = obtenerPaginaActual();
      if ($actual === 'login') {
        echo '<script src="js/formulario-login.js"></script>';
      } elseif ($actual === 'index') {
        echo '<script src="js/script.js?v=1"></script>';
      }
    ?>
</body>

</html>