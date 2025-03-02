<?php
require_once "../../database.php";

function getMatchdays()
{
  return supabaseRequest("matchday?order=id.asc", "GET");
}

function getMatchdayById($id)
{
  return supabaseRequest("matchday?id=eq.$id", "GET");
}

function addMatchday($name, $status)
{
  $data = [
    "name" => $name,
    "status" => $status
  ];
  return supabaseRequest("matchday", "POST", $data);
}

function updateMatchday($id, $name, $status)
{
  $data = [
    "name" => $name,
    "status" => $status,
  ];

  return supabaseRequest("matchday?id=eq.$id", "PATCH", $data);
}

function deleteMatchday($id)
{
  return supabaseRequest("matchday?id=eq.$id", "DELETE");
}
