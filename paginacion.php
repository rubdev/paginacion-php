<?php
  include '../funciones.php';

  $conexion = abrirConexion();
  $consulta = "SELECT * FROM producto";
  $productos = mysqli_query($conexion,$consulta);

  if ($productos) { // productos

    $num_productos = mysqli_num_rows($productos);

    if ($num_productos > 0) {
      $paginacion = 10;
      $pagina = false;
    }

    if (isset($_GET['pagina'])) {
      $pagina = $_GET['pagina'];
    }

    if (!$pagina) {
      $inicio = 0;
      $pagina = 1;
    } else {
      $inicio = ($pagina - 1) * $paginacion;
    }

    $consulta_mostrar = "SELECT * FROM producto LIMIT $inicio,$paginacion";
    $mostrar = mysqli_query($conexion,$consulta_mostrar);

    if ($mostrar) { // mostrar

      while ($fila = mysqli_fetch_array($mostrar,MYSQLI_ASSOC)) {
        echo "<p>$fila[nombre] -> $fila[uso]</p>";
      }

    } // mostrar

  } // productos

  mysqli_close($conexion);

 ?>
<?php
  echo "<ul>
          <li><a href='paginacion.php?pagina=".($pagina - 1)."'>Anterior</a></li>
          <li><a href='paginacion.php?pagina=".($pagina + 1)."'>Siguiente</a></li>
        </ul>";
 ?>
