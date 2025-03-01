<?php
ob_start(); // Inicia el buffer de salida
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/matchday.php");

if (isset($_POST["addMatchday"])) {
  $name = $_POST["name"];
  $status = $_POST["status"];

  addMatchday($name, $status);
  header("Location: index.php");
  exit();
  ob_end_flush(); // Envía el contenido acumulado
}
?>

<div class="d-flex flex-column align-items-center mt-5">
  <form action="add_matchday.php" method="POST" class="card p-4 shadow-lg" style="width: 500px;">
    <h1 class="text-center mb-4">Añadir Jornada</h1>
    <input class="form-control mb-4" type="text" name="name" placeholder="Nombre" />
    <select name="status" class="form-select mb-4">
      <option value="-1" disabled selected>Seleccionar estado</option>
      <option value="0">Abierta</option>
      <option value="1">Cerrada</option>
      <option value="2">Jugada</option>
    </select>
    <div class="d-flex">
      <input type="submit" name="addMatchday" class="btn btn-success mx-2 w-50" value="Añadir" />
      <a href="index.php" class="btn btn-secondary w-50">Cancelar</a>
    </div>
  </form>
</div>

<?php
?>