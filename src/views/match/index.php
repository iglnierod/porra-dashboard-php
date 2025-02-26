<?php
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/match.php");

if (isset($_GET["matchday_id"])) {
  $matchdayId = is_numeric($_GET["matchday_id"]) ? (int)$_GET["matchday_id"] : null;
  if ($matchdayId) {
    $matches = getMatchesViewByMatchdayId($_GET["matchday_id"]);
  }
}
?>

<div class="container mt-4">
  <!-- Centrar el formulario -->
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card p-4">
        <h4 class="text-center mb-3">Buscar Partidos</h4>
        <form action="index.php" method="GET">
          <div class="mb-3">
            <input type="number" name="matchday_id" class="form-control" placeholder="Matchday ID" min="0" max="100" required>
          </div>
          <div class="d-grid">
            <input type="submit" class="btn btn-success" value="Buscar">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Tabla de partidos -->
  <div class="row mt-4">
    <div class="col-md-10 mx-auto">
      <div class="card p-3">
        <div class="table-responsive">
          <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Equipo Local</th>
                <th>L. Goles</th>
                <th>V. Goles</th>
                <th>Equipo Visitante</th>
                <th>ID Jornada</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (isset($matches)) {
                foreach ($matches as $match): ?>
                  <tr>
                    <td><?= $match["match_id"] ?></td>
                    <td><?= $match["local_team"] ?></td>
                    <td><?= $match["local_goals"] ?></td>
                    <td><?= $match["away_goals"] ?></td>
                    <td><?= $match["away_team"] ?></td>
                    <td><?= $match["matchday_id"] ?></td>
                    <td>
                      <a title="Editar" href="edit_match.php?match_id=<?= $match["match_id"] ?>" class="btn btn-outline-secondary"><i class="bi bi-pencil-square"></i></a>
                      <a title="Eliminar" href="delete_match.php?match_id=<?= $match["match_id"] ?>&matchday_id=<?= $matchdayId ?>"
                        class="btn btn-outline-danger"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar este partido?');">
                        <i class="bi bi-x-square"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach;
              } else { ?>
                <tr>
                  <td colspan="7" class="text-muted">No hay partidos disponibles</td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="7">
                  <a href="add_match.php?matchday_id=<?= isset($matchdayId) ? $matchdayId : '' ?>" class="btn btn-primary">Añadir partido</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("../../includes/footer.php"); ?>