<?php
ob_start(); // Inicia el buffer de salida

include("../../database.php");
include("../../functions/match.php");

if (isset($_GET["match_id"]) && isset($_GET["matchday_id"])) {
  $matchId = $_GET["match_id"];
  deleteMatch($matchId);
  $matchdayId = $_GET["matchday_id"];
}
header("Location: index.php?matchday_id=$matchdayId");
exit();
ob_end_flush(); // Envía el contenido acumulado
