<?php
include("../includes/head.php");
include("../includes/navbar.php");
include("../database.php");
?>

<main class="mx-4 col-9">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Equipo Local</th>
        <th>L. Goles</th>
        <th>V. Goles</th>
        <th>Equipo Visitante</th>
        <th>ID Jornada</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $matches = getMatches();
      foreach ($matches as $match):
      ?>
        <tr>
          <td><?= $match["match_id"] ?></td>
          <td><?= $match["local_team"] ?></td>
          <td><?= $match["local_goals"] ?></td>
          <td><?= $match["away_goals"] ?></td>
          <td><?= $match["away_team"] ?></td>
          <td><?= $match["matchday_id"] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php
include("../includes/footer.php"); ?>