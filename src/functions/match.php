<?php
require_once "../../database.php";

function getMatchesView()
{
  return supabaseRequest("match_view?order=match_id.asc", "GET");
}

function getMatchesViewByMatchdayId($matchdayId)
{
  return supabaseRequest("match_view?matchday_id=eq.$matchdayId&order=match_id.asc", "GET");
}

function getMatches()
{
  return supabaseRequest("match", "GET");
}

function getMatchById($id)
{
  return supabaseRequest("match?id=eq.$id", "GET");
}

function addMatch($idLocal, $idAway, $matchdayId)
{
  $data = [
    "id_local" => $idLocal,
    "id_away" => $idAway,
    "local_goals" => 0,
    "away_goals" => 0,
    "matchday_id" => $matchdayId
  ];

  return supabaseRequest("match", "POST", $data);
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
