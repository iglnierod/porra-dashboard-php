<?php
ob_start(); // Inicia el buffer de salida
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/match.php");
include("../../functions/team.php");
include("../../functions/matchday.php");

if (isset($_POST["addMatch"])) {
  $addMatchdayId = $_POST["matchday"];
  $addLocalTeamId = $_POST["localTeam"];
  $addAwayTeamId = $_POST["awayTeam"];
  if (empty($addLocalTeamId) || empty($addAwayTeamId)) {
    throw new Exception("Error: No se ha seleccionado alguno de los equipos.");
    exit();
  }
  if ($addLocalTeamId !== $addAwayTeamId) {
    addMatch($addLocalTeamId, $addAwayTeamId, $addMatchdayId);
  } else {
    throw new Exception("Error: El equipo local y el equipo visitante son el mismo equipo. LOCAL: $addLocalTeamId VISTANTE: $addAwayTeamId");
    exit();
  }
  header("Location: index.php?matchday_id=$addMatchdayId");
  exit();
}

if (isset($_GET["matchday_id"])) {
  $selectedMatchday = $_GET["matchday_id"];
}

$matchdays = getMatchdays();
$teams = getTeams();

?>
<div class="d-flex flex-column align-items-center mt-5">
  <h1 class="text-center mb-4">Añadir partido</h1>

  <form action="add_match.php" method="POST" class="card p-4 shadow-lg" style="width: 600px;">
    <!-- MATCHDAY SELECT -->
    <div class="mb-3">
      <label for="matchday" class="form-label">Jornada</label>
      <select name="matchday" id="matchday" class="form-select" required>
        <option value="-1" disabled selected>Seleccionar jornada</option>
        <?php foreach ($matchdays as $matchday): ?>
          <option value="<?= $matchday["id"] ?>"
            <?= (isset($selectedMatchday) && $matchday["id"] == $selectedMatchday) ? 'selected' : '' ?>>
            <?= htmlspecialchars($matchday["name"]) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- CONTENEDOR DE EQUIPOS -->
    <div class="d-flex justify-content-between mb-4">
      <!-- LOCAL TEAM SELECT -->
      <div class="w-45">
        <label for="localTeam" class="form-label">Equipo Local</label>
        <select name="localTeam" id="localTeam" class="form-select" required>
          <option value="-1" disabled selected>Seleccionar Equipo Local</option>
          <?php foreach ($teams as $team): ?>
            <option value="<?= $team["id"] ?>"><?= htmlspecialchars($team["name"]) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- AWAY TEAM SELECT -->
      <div class="w-45">
        <label for="awayTeam" class="form-label">Equipo Visitante</label>
        <select name="awayTeam" id="awayTeam" class="form-select" required>
          <option value="-1" disabled selected>Seleccionar Equipo Visitante</option>
          <?php foreach ($teams as $team): ?>
            <option value="<?= $team["id"] ?>"><?= htmlspecialchars($team["name"]) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- BOTONES -->
    <div class="text-center mt-2 w-100 d-flex justify-content-center">
      <button type="submit" name="addMatch" class="btn btn-success mx-2 w-50">Añadir</button>
      <a href="index.php?matchday_id=<?= isset($selectedMatchday) ? $selectedMatchday : '' ?>"
        class="btn btn-secondary w-50">Cancelar</a>
    </div>
  </form>
</div>
<?php include("../../includes/footer.php");
ob_end_flush(); // Envía el contenido acumulado
?>