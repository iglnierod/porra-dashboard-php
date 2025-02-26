<?php
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/match.php");
include("../../functions/team.php");

if (isset($_POST["editMatch"])) {
  $editMatchId = $_POST["matchId"];
  $editLocalId = $_POST["localId"];
  $editLocalGoals = $_POST["localGoals"];
  $editAwayGoals = $_POST["awayGoals"];
  $editAwayId = $_POST["awayId"];
  $editMatchdayId = $_POST["matchdayId"];

  $updatedMatch = updateMatch($editMatchId, $editLocalId, $editAwayId, $editLocalGoals, $editAwayGoals, $editMatchdayId);
  echo "<pre> ASD";
  print_r($updatedMatch);
  echo "</pre>";
}

if (isset($_GET["match_id"])) {
  $matchId = is_numeric($_GET["match_id"]) ? (int)$_GET["match_id"] : null;
  if (!is_null($matchId)) {
    $match = getMatchById($matchId)[0]; // Obtener el partido
    $localTeamId = $match["id_local"];
    $awayTeamId = $match["id_away"];
    $localTeam = getTeamById($localTeamId)[0];
    $awayTeam = getTeamById($awayTeamId)[0];
  } else {
    echo "<div class='alert alert-danger'>ID de partido no válido.</div>";
    exit;
  }
} else {
  echo "<div class='alert alert-danger'>No se recibió un ID de partido.</div>";
  exit;
}


?>

<div class="container mt-5 d-flex justify-content-center">
  <div class="card shadow-lg p-4" style="width: 600px;">
    <h2 class="text-center mb-4">Editar Resultado del Partido</h2>
    <h6 class="text-center mb-4">Matchday <?= htmlspecialchars($match["matchday_id"]) ?></h6>

    <form action="edit_match.php?match_id=<?= $matchId ?>" method="POST" class="d-flex flex-column align-items-center">
      <!-- INPUTS PARA LA PETICION POST -->
      <input type="hidden" name="matchId" value="<?= htmlspecialchars($matchId) ?>">
      <input type="hidden" name="localId" value="<?= htmlspecialchars($localTeamId) ?>" />
      <input type="hidden" name="awayId" value="<?= htmlspecialchars($awayTeamId) ?>" />
      <input type="hidden" name="matchdayId" value="<?= htmlspecialchars($match["matchday_id"]) ?>" />

      <div class="d-flex align-items-center justify-content-center gap-4">
        <!-- Equipo Local -->
        <div class="text-center" style="width: 180px;">
          <img src="<?= htmlspecialchars($localTeam["logo_url"]) ?>" alt="Equipo local logo" class="img-fluid" style="width: 80px; height: 80px;">
          <h4 class="mt-2 text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <?= htmlspecialchars($localTeam["name"]) ?>
          </h4>
        </div>

        <!-- Inputs de Resultado -->
        <div class="d-flex align-items-center gap-2">
          <input type="number" name="localGoals" class="form-control text-center fs-4"
            style="width: 60px; height: 60px;" min="0" max="99"
            value="<?= htmlspecialchars($match["local_goals"]) ?>" placeholder="0" required>
          <span class="fs-3">-</span>
          <input type="number" name="awayGoals" class="form-control text-center fs-4"
            style="width: 60px; height: 60px;" min="0" max="99"
            value="<?= htmlspecialchars($match["away_goals"]) ?>" placeholder="0" required>
        </div>

        <!-- Equipo Visitante -->
        <div class="text-center" style="width: 180px;">
          <img src="<?= htmlspecialchars($awayTeam["logo_url"]) ?>" alt="Equipo visitante logo" class="img-fluid" style="width: 80px; height: 80px;">
          <h4 class="mt-2 text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <?= htmlspecialchars($awayTeam["name"]) ?>
          </h4>
        </div>
      </div>

      <!-- Botones -->
      <div class="text-center mt-4 w-100 d-flex justify-content-center">
        <button type="submit" name="editMatch" class="btn btn-success mx-2 w-50">Editar</button>
        <a href="index.php?matchday_id=<?= htmlspecialchars($match["matchday_id"]) ?>" class="btn btn-secondary w-50">Cancelar</a>
      </div>
    </form>
  </div>
</div>




<?php include("../../includes/footer.php"); ?>