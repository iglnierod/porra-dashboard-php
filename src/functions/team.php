<?php
require_once "../../database.php";

function getTeams()
{
  return supabaseRequest("team", "GET");
}

function getTeamById($id)
{
  return supabaseRequest("team?id=eq.$id", "GET");
}

function getTeamsById($idLocal, $idAway)
{
  return supabaseRequest("team?or=(id.eq.$idLocal,id.eq.$idAway)", "GET");
}


function updateTeam($id, $logoUrl, $name)
{
  $data = [
    "id" => $id,
    "logo_url" => $logoUrl,
    "name" => $name
  ];

  return supabaseRequest("team?id=eq.$id", "PATCH", $data);
}

function deleteTeam($id)
{
  return supabaseRequest("team?id=eq.$id", "DELETE");
}
