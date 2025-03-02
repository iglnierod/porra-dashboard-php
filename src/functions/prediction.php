<?php
require_once "../../database.php";

function getPredictionsByMatchId($matchId)
{
  $result = supabaseRequest("prediction?match_id=eq.$matchId", "GET");

  if (!is_array($result)) {
    return []; // Retorna array vacío en caso de error
  }

  return $result;
}


function getPredictionsByUserAndMatchId($userId, $matchId)
{
  return supabaseRequest("prediction?user_id=eq.$userId&match_id=eq.$matchId");
}

function calculatePredictionPoints($match, $prediction)
{
  $matchWinner = getMatchWinner($match);

  // Crear un array para simular un partido basado en la predicción del usuario
  $predictedMatch = [
    "local_goals" => (int) $prediction["goals_local_prediction"],
    "away_goals" => (int) $prediction["goals_away_prediction"]
  ];
  $predWinner = getMatchWinner($predictedMatch);

  // 3 Puntos: Acertar resultado exacto
  if ($match["local_goals"] === $predictedMatch["local_goals"] && $match["away_goals"] === $predictedMatch["away_goals"]) {
    return 3;
  }

  // 1 Punto: Acertar solo el ganador
  if ($matchWinner === $predWinner) {
    return 1;
  }

  // 0 Puntos: No acertar ganador
  return 0;
}

function getMatchWinner($match)
{
  $localGoals = (int) $match["local_goals"];
  $awayGoals = (int) $match["away_goals"];

  if ($localGoals > $awayGoals) return 1; // Gana Local
  if ($localGoals < $awayGoals) return 2; // Gana Visitante
  return 0; // Empate
}
