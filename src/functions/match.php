<?php
require("../database.php");

function getMatchesView()
{
  return supabaseRequest("match_view", "GET");
}

function getMatchesViewByMatchdayId($matchdayId)
{
  return supabaseRequest("match_view?matchday_id=eq.$matchdayId", "GET");
}

function getMatches()
{
  return supabaseRequest("match", "GET");
}

function getMatchById($id)
{
  return supabaseRequest("match?id=eq.$id", "GET");
}

function updateMatch($id, $idLocal, $idAway, $localGoals, $awayGoals, $matchdayId)
{
  $data = [
    "id_local" => $idLocal,
    "id_away" => $idAway,
    "local_goals" => $localGoals,
    "away_goals" => $awayGoals,
    "matchday_id" => $matchdayId
  ];

  return supabaseRequest("match?id=eq.$id", "PATCH", $data);
}

function deleteMatch($id)
{
  return supabaseRequest("match?id=eq.$id", "DELETE");
}
