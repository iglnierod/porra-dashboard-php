<?php
ob_start();

include("../../database.php");
include("../../functions/matchday.php");

if (isset($_GET["matchday_id"])) {
  $matchdayId = $_GET["matchday_id"];
  deleteMatchday($matchdayId);
}

header("Location: index.php");
exit();
ob_end_flush();
