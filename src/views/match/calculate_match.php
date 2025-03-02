<?php
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/match.php");
include("../../functions/team.php");
include("../../functions/users.php");
include("../../functions/prediction.php");

// Verificar si hay `match_id` en GET o POST
if (isset($_GET["match_id"]) || isset($_POST["match_id"])) {
  $matchId = $_GET["match_id"] ?? $_POST["match_id"];
  $match = getMatchById($matchId)[0];
  $localTeam = getTeamById($match["id_local"])[0];
  $awayTeam = getTeamById($match["id_away"])[0];
  $predictions = getPredictionsByMatchId($matchId);
}

// Validar que `$predictions` sea un array antes de usarlo
if (!isset($predictions) || !is_array($predictions)) {
  $predictions = []; // Si no hay predicciones, definimos un array vacío
}

// Si se presiona el botón "Sumar Puntos"
if (isset($_POST["calculatePoints"])) {
  addPointsToUsers($predictions, $match);
  echo '<div class="alert alert-success text-center">Puntos actualizados correctamente</div>';
}
?>



<h1 class="text-center">Calcular puntos</h1>
<div class="container mt-5 d-flex justify-content-center">
  <div class="card shadow-lg p-4" style="width: 600px;">
    <h2 class="text-center mb-4">Resultado del Partido</h2>
    <h6 class="text-center mb-4">Matchday <?= htmlspecialchars($match["matchday_id"]) ?></h6>

    <div class="d-flex align-items-center justify-content-center gap-4">
      <!-- Equipo Local -->
      <div class="text-center" style="width: 180px;">
        <img src="<?= htmlspecialchars($localTeam["logo_url"]) ?>" alt="Equipo local logo" class="img-fluid" style="width: 80px; height: 80px;">
        <h4 class="mt-2 text-truncate"><?= htmlspecialchars($localTeam["name"]) ?></h4>
      </div>

      <!-- Resultado del Partido -->
      <div class="d-flex align-items-center gap-2">
        <span class="fs-3 border p-2 rounded bg-light"><?= htmlspecialchars($match["local_goals"]) ?></span>
        <span class="fs-3">-</span>
        <span class="fs-3 border p-2 rounded bg-light"><?= htmlspecialchars($match["away_goals"]) ?></span>
      </div>

      <!-- Equipo Visitante -->
      <div class="text-center" style="width: 180px;">
        <img src="<?= htmlspecialchars($awayTeam["logo_url"]) ?>" alt="Equipo visitante logo" class="img-fluid" style="width: 80px; height: 80px;">
        <h4 class="mt-2 text-truncate"><?= htmlspecialchars($awayTeam["name"]) ?></h4>
      </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Match Id</th>
          <th>Id</th>
          <th>Usuario</th>
          <th>G. Local</th>
          <th>G. Visitante</th>
          <th>Puntos</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($predictions as $prediction):
          $user = getUserById($prediction["user_id"]);
          $points = calculatePredictionPoints($match, $prediction);

          // Definir el color de fondo según los puntos
          $bgColor = "";
          if ($points === 3) {
            $bgColor = "bg-success"; // Morado clarito
          } elseif ($points === 1) {
            $bgColor = "bg-primary"; // Verde clarito
          } elseif ($points === 0) {
            $bgColor = "bg-danger"; // Rojo clarito
          }
        ?>
          <tr>
            <td><?= $prediction["match_id"] ?></td>
            <td><?= $prediction["id"] ?></td>
            <td><?= htmlspecialchars($user["name"]) ?></td>
            <td><?= $prediction["goals_local_prediction"] ?></td>
            <td><?= $prediction["goals_away_prediction"] ?></td>
            <td class="<?= $bgColor ?>"><strong><?= $points ?></strong></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Botón para calcular y actualizar los puntos -->
    <form method="POST" class="text-center mt-4">
      <input type="hidden" name="match_id" value="<?= htmlspecialchars($matchId) ?>">
      <button type="submit" name="calculatePoints" class="btn btn-primary w-100">Sumar Puntos a los Usuarios</button>
    </form>
  </div>
</div>