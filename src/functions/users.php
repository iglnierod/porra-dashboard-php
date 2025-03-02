<?php
require_once '../../database.php';

// Obtener todos los usuarios
function getUsers()
{
  return supabaseRequest("users", "GET");
}

// Obtener un usuario por ID
function getUserById($id)
{
  return supabaseRequest("users?id=eq.$id", "GET")[0] ?? null;
}

// Crear un nuevo usuario
function createUser($name, $image_url, $points)
{
  $data = ["name" => $name, "image_url" => $image_url, "points" => $points];
  return supabaseRequest("users", "POST", $data);
}

// Actualizar un usuario
function updateUser($id, $name, $image_url, $points)
{
  $data = ["name" => $name, "image_url" => $image_url, "points" => $points];
  return supabaseRequest("users?id=eq.$id", "PATCH", $data);
}

// Eliminar un usuario
function deleteUser($id)
{
  return supabaseRequest("users?id=eq.$id", "DELETE");
}
function addPointsToUsers($predictions, $match)
{
  // Verificar que `$predictions` sea un array antes de iterar
  if (!is_array($predictions)) {
    return false;
  }

  foreach ($predictions as $prediction) {
    $userId = $prediction["user_id"];
    $points = calculatePredictionPoints($match, $prediction);

    // Obtener los puntos actuales del usuario
    $user = getUserById($userId);
    if (!isset($user["points"])) {
      echo "<pre>Error: No se encontraron puntos para el usuario $userId.</pre>";
      continue;
    }

    $newPoints = $user["points"] + $points;

    updateUserPoints($userId, $newPoints);
  }

  return true;
}


function updateUserPoints($userId, $newPoints)
{
  $data = [
    "points" => $newPoints
  ];

  return supabaseRequest("users?id=eq.$userId", "PATCH", $data);
}
