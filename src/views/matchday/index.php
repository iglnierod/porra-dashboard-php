<?php
include("../../includes/head.php");
include("../../includes/navbar.php");
include("../../database.php");
include("../../functions/matchday.php");

$matchdays = getMatchdays();
?>

<div class="container mt-4">
  <h1 class="text-center">Jornadas</h1>
  <!-- Tabla de partidos -->
  <div class="row mt-4">
    <div class="col-md-10 mx-auto">
      <div class="card p-3">
        <div class="table-responsive">
          <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (isset($matchdays)) {
                foreach ($matchdays as $matchday): ?>
                  <tr>
                    <td><?= $matchday["id"] ?></td>
                    <td><?= $matchday["name"] ?></td>
                    <td><?= $matchday["status"] ?></td>
                    <td>
                      <a title="Ver partidos" href="../match/index.php?matchday_id=<?= $matchday["id"] ?>" class="btn btn-outline-info"><i class="bi bi-arrow-up-right-square"></i></a>
                      <a title="Editar" href="edit_matchday.php?matchday_id=<?= $matchday["id"] ?>" class="btn btn-outline-secondary"><i class="bi bi-pencil-square"></i></a>
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
                  <td colspan="4" class="text-muted">No hay jornadas disponibles</td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="4">
                  <!-- <a href="add_match.php?matchday_id=<?= isset($matchdayId) ? $matchdayId : '' ?>" class="btn btn-primary">Añadir jornada</a> -->
                  <a href="add_matchday.php" class="btn btn-primary">Añadir jornada</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("../../includes/footer.php") ?>