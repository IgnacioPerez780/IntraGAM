<?php
error_reporting(E_ALL);

include('plantillas/cabecera_dash.php');

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

<body>
  <link rel="stylesheet" href="libreri/css/tema.css">

  </style>
  <h1>Bienvenidos al sistema Intra GAM</h1>
  <br>
  <h2>Menu inicio</h2>
  <div class="row">
    <div class="col-lg-4">
      <div class="bs-component">
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">×</font>
            </font>
          </button>
          <strong>
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">Consultor! </font>
            </font>
          </strong> <a href="consultor.php" class="alert-link">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">Pagina principal consultor</font>
            </font>
          </a>
          <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"> Da click para iniciar.
            </font>
          </font>
        </div>
      </div>
    </div>

    <?php

    if (1 == $_SESSION['rol']) {
      echo '<div class="col-lg-4"> <div class="bs-component"> <div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button> <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pagina de Agente </font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">:) </font></font><a href="agente.php" class="alert-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Da click para iniciar </font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> . </font></font></div> </div> </div>';
    }
    ?>

    <?php if (3 == $_SESSION['rol'] || 1 == $_SESSION['rol']) {
      echo '
              <div class="col-lg-4">
                <div class="bs-component">
                  <div class="alert alert-dismissible alert-info">
                    <button type="button" class="close" data-dismiss="alert"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                    <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Jefa del área Operaciones </font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">,</font></font><a href="registro.php" class="alert-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Da click  para iniciar sesión</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">  
                  </font></font></div>
                </div>
              </div>';
    }
    ?>

  </div>
  </div>


  <br><br><br><br><br><br><br><br><br><br><br><br><br>
  <?php include('plantillas/pie-pagina.php'); ?>

</body>

</html>