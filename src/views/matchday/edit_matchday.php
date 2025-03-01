<?php
ob_start(); // Inicia el buffer de salida
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/matchday.php");

if (isset($_POST["editMatchday"])) {
  $editId = $_POST["matchdayId"];  // Ahora sí está disponible
  $editName = $_POST["name"];
  $editStatus = $_POST["status"];

  if (empty($editName)) {
    throw new Exception("El nombre de la jornada está vacío.");
  }

  $updatedMatchday = updateMatchday($editId, $editName, $editStatus);
}

if (isset($_GET["matchday_id"])) {
  $matchdayId = $_GET["matchday_id"];
  $matchday = getMatchdayById($matchdayId)[0];
}

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

<div class="d-flex flex-column align-items-center mt-5">
  <form action="edit_matchday.php?matchday_id=<?= $matchday["id"] ?>" method="POST" class="card p-4 shadow-lg" style="width: 500px;">
    <h1 class="text-center mb-4">Editar Jornada</h1>
    <input type="hidden" name="matchdayId" value="<?= $matchdayId ?>">
    <!-- Input para el nombre de la jornada -->
    <input class="form-control mb-4" type="text" name="name" placeholder="Nombre" value="<?= htmlspecialchars($matchday["name"]) ?>" />

    <!-- Select para el estado de la jornada -->
    <select name="status" class="form-select mb-4">
      <option value="-1" disabled>Seleccionar estado</option>
      <option value="0" <?= ($matchday["status"] == 0) ? "selected" : "" ?>>Abierta</option>
      <option value="1" <?= ($matchday["status"] == 1) ? "selected" : "" ?>>Cerrada</option>
      <option value="2" <?= ($matchday["status"] == 2) ? "selected" : "" ?>>Jugada</option>
    </select>

    <!-- Botones -->
    <div class="d-flex">
      <input type="submit" name="editMatchday" class="btn btn-success mx-2 w-50" value="Editar" />
      <a href="index.php" class="btn btn-secondary w-50">Cancelar</a>
    </div>
  </form>
</div>


<?php
ob_end_flush(); // Envía el contenido acumulado
?>